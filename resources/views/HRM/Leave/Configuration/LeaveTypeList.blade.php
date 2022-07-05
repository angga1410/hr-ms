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
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Leave Type</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="ajaxform">
<meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">
      
        <input type="hidden" name="idstatus">
          <div class="form-group">
            <label for="email1">Name</label>
            <input type="email" class="form-control name"  name="name" >
           
          </div>
          <div class="form-group">
            <label for="email1">Note</label>
            <textarea type="email" class="form-control note"  name="note" ></textarea>
           
          </div>
          <div class="form-group">
            <label for="email1">Is Entitlement Situational (*) 

</label>
           
            <select class="form-control" name="is_entitlement" >
            <option value="1">Yes</option>
            <option value="0">No</option>
            </select>
           
          </div>
        
          <br>
                                        <small>{{ __('*These leave will be excluded from reports unless there is some activity. E.g. maternity leave, jury duty leave.') }}</small>
      
        
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
        <button class="btn btn-secondary update-data"  data-dismiss="modal"  id="btnupdate">Update</button>
        </div>
      </form>
                    </div>
    </div>
</div>
            <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title" id="exampleModalLabel">Create Leave Type</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="ajaxform">
<meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">
      
      
          <div class="form-group">
            <label for="email1">Name</label>
            <input type="email" class="form-control"  name="savename" >
           
          </div>
          <div class="form-group">
            <label for="email1">Note</label>
            <textarea type="email" class="form-control"  name="savenote" ></textarea>
           
          </div>
          <div class="form-group">
            <label for="email1">Is Entitlement Situational (*) 

</label>
           
            <select class="form-control" name="saveis_entitlement" >
            <option value="0">Yes</option>
            <option value="1">No</option>
            </select>
           
          </div>
        
          <br>
                                        <small>{{ __('*These leave will be excluded from reports unless there is some activity. E.g. maternity leave, jury duty leave.') }}</small>
      
        
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
                    <h4 class="card-title"> Leave Type List</h4>
                    <h4 class="card-title text-right"> <button class="btn btn-info" data-toggle="modal" data-target="#form" title="Add !"><i class="nc-icon nc-simple-add"></i></button> </h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead class=" text-primary">
                                <th>
                                Name
                                </th>
                                <th>
                                Note
                                </th>
                                <th>
                                Is Entitlement Situational
                                </th>
                                <th>
                                
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
   function updatevacancies(id) {
    $('.name').val('');
              $('.note').val('');
        $('#form2').modal('show');
        $("input[name=idstatus]").val(id);
        $.ajax({
          type: "get",
          url: "/leave/leave-type/"+ id,
          success: function(data) {
            console.log(data);
            $.each(data, function(index, datum) {
              $('.name').val(data.name);
              $('.note').val(data.note);
            });
          }
        });

    }
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
               ajax: "{{ route('data_leave_type') }}",
               columns: [  
               { data: 'name', name: 'name' },
               { data: 'note', name: 'note' },
               { data: 'is_entitlement', name: 'is_entitlement' },
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

        let name = $("input[name=savename]").val();
        let note = $("textarea[name=savenote]").val();
        let is_entitlement = $("select[name=saveis_entitlement]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('save_leave_type') }}", 
            type: "POST",
            data: {
                name: name,
                note: note,
                is_entitlement: is_entitlement,
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
    $(".update-data").click(function(event) {
        event.preventDefault();

        let name = $("input[name=name]").val();
        let id = $("input[name=idstatus]").val();
        let note = $("textarea[name=note]").val();
        let is_entitlement = $("select[name=is_entitlement]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('update_leave_type') }}", 
            type: "POST",
            data: {
                id : id,
                name: name,
                note: note,
                is_entitlement: is_entitlement,
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
