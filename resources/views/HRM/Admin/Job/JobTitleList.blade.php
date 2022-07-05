@extends('layouts.app', [
'class' => '',
'elementActive' => 'admin'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="container">

            </div>

            <div class="modal fade" id="form2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Job Title Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="ajaxform">
                <meta name="csrf-token" content="{{ csrf_token() }}" />
                <div class="modal-body">


                    <div class="form-group">
                        <input type="hidden" name="idstatus">
                        <label for="email1">Status</label>
                        <select class="form-control select2" style="width: 100%;" name="updatedstatus">
                            <option value="0">Active</option>
                            <option value="1">Archived</option>
                        </select>

                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button class="btn btn-secondary save-update" data-dismiss="modal" id="btnupdate">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

            <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title" id="exampleModalLabel">Create Job Title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="ajaxform">
<meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">
      
      
          <div class="form-group">
            <label for="email1">Job Title</label>
            <input type="email" class="form-control " id="job_title" name="job_title" >
           
          </div>
        
      
          <div class="form-group">
            <label for="password1">Job Description</label>
            <textarea type="text" class="form-control " id="job_desc" name="job_desc" ></textarea>
          </div>
       
          <div class="form-group">
            <label for="password1">Note</label>
            <textarea type="text" class="form-control " id="job_note" name="job_note" ></textarea>
          </div>

          <div class="form-group">
            <label for="password1">Click for add attachment</label>
            <input type="file" class="form-control " id="job_file" name="job_file" >
          </div>

        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
        <button class="btn btn-success save-data"  data-dismiss="modal"  id="btnupdate">Submit</button>
        </div>
      </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Job Title List</h4>
                    <h4 class="card-title text-right"> <button class="btn btn-info" data-toggle="modal" data-target="#form" title="Add User!"><i class="nc-icon nc-simple-add"></i></button> </h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead class=" text-primary">
                                <th>
                                  Job Title
                                </th>
                                <th>
                                  Job Description
                                </th>
                                <th>
                                  Status
                                </th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@push('scripts')

<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>


    load();
    function refreshdata(){
        $('#job_title').val('');
        $('#job_desc').val('');
        $('#job_note').val('');
        $('#job_file').val('');
        $('#table').DataTable().clear().destroy();
        load();
    }
    function closing() {
        $('#form').modal('hide');
    }
     function load(){
            $('#table').DataTable({
               processing: true,
               serverSide: true,
               scrollY: 200,
               info:false,
            dom: 'Bfrtip',
    paging: false,
               ajax: "{{ route('data_jobtitle') }}",
               columns: [   {data :'job_title', name: 'job_title'},
               { data: 'job_desc', name: 'job_desc' },
               { data: 'status', name: 'status' },
             
                     ]
            });
         }
  
      $(function() {
    //Initialize Select2 Elements
    $('.select2').select2({

    })
  })
  $(".save-data").click(function(event) {
        event.preventDefault();

        let job_title = $("input[name=job_title]").val();
        let job_desc = $("textarea[name=job_desc]").val();
        let job_note = $("textarea[name=job_note]").val();
        let job_file = $("textarea[name=job_file]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('save_jobtitle') }}", 
            type: "POST",
            data: {
                job_title: job_title,
                job_desc: job_desc,
                job_note: job_note,
                job_file: job_file,
                _token: _token
            },
            success: function(response) {
                console.log(response);
                if (response) {
                    $('.success').text(response.success);
                    $("#ajaxform")[0].reset();
                }
            },
        });
        refreshdata()
     
    });

    function updatestatus(id) {
        $('#form2').modal('show');
        $("input[name=idstatus]").val(id);

    }
    $(".save-update").click(function(event) {
        event.preventDefault();

        let id = $("input[name=idstatus]").val();
        let status = $("select[name=updatedstatus]").val();

        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('update_jobtitle') }}",
            type: "POST",
            data: {
                id: id,
                status: status,
                _token: _token
            },
            success: function(response) {

                if (response) {
                    $('.success').text(response.success);
                    $("#ajaxform")[0].reset();
                }
            },
        });
        refreshdata()

    });

  
</script>
@endpush
