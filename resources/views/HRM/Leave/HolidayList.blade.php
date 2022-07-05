@extends('layouts.app', [
'class' => '',
'elementActive' => 'leave'
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
                <h5 class="modal-title" id="exampleModalLabel">Holiday Status</h5>
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
                            <h5 class="modal-title" id="exampleModalLabel">Create Holiday/Cuti Bersama</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="ajaxform">
<meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">
      
      
          <div class="form-group">
            <label for="email1">Date</label>
            <input type="date" class="form-control" id="name" name="date" >
           
          </div>
          <div class="form-group">
            <label for="email1">Info</label>
            <input type="text" class="form-control" id="name" name="info" >
           
          </div>
          <div class="form-group">
            <label for="email1">Type</label>
            <select class="form-control" id="name" name="type" >
            <option></option>
            <option value="0">Cuti Bersama</option>
            <option value="1">Libur Nasional</option>
            </select>
           
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
                    <h4 class="card-title"> Holiday/Cuti Bersama</h4>
                    <h4 class="card-title text-right"> <button class="btn btn-info" data-toggle="modal" data-target="#form" title="Add !"><i class="nc-icon nc-simple-add"></i></button> </h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead class=" text-primary">
                                <th>
                               Date
                                </th>
                                <th>
                                Info
                                </th>
                                <th>
                                Type
                                </th>
                                <th>
                                Action
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
        $('#name').val('');
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
               ajax: "{{ route('data_holiday') }}",
               columns: [  
               { data: 'date', name: 'date' },
               {data: 'info', name: 'info' },
               {data: 'type', name: 'type' },
               {data: 'status', name: 'status' },
             
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

        let date = $("input[name=date]").val();
        let info = $("input[name=info]").val();
        let type = $("select[name=type]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('save_holiday') }}", 
            type: "POST",
            data: {
                date: date,
                info: info,
                type: type,
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
            url: "{{ route('update_jobcategory') }}",
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
