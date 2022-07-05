@extends('layouts.app', [
'class' => '',
'elementActive' => 'discipline'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="container">

            </div>

            <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title" id="exampleModalLabel">Create Disciplinary Action</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="ajaxform">
<meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">
      
      
          <div class="form-group">
            <label for="email1">Name</label>
            <input type="email" class="form-control "  name="name" >
           
          </div>
        
      
          <div class="form-group">
            <label for="password1">Description</label>
            <textarea type="text" class="form-control "  name="description" ></textarea>
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
                    <h4 class="card-title"> Disciplinary Action List</h4>
                    <h4 class="card-title text-right"> <button class="btn btn-info" data-toggle="modal" data-target="#form" title="Add User!"><i class="nc-icon nc-simple-add"></i></button> </h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead class=" text-primary">
                                <th>
                                 Name
                                </th>
                                <th>
                             Description
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
    <script src="{{asset('js/jquery-3.5.1.js')}}"></script>
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
               ajax: "{{ route('config_action_data') }}",
               columns: [   {data :'name', name: 'name'},
               { data: 'desc', name: 'desc' },
             
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

        let name = $("input[name=name]").val();
        let description = $("textarea[name=description]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('save_discipline_action') }}", 
            type: "POST",
            data: {
                name: name,
                description: description,  
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
</script>
@endpush
