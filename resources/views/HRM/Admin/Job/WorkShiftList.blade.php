@extends('layouts.app', [
'class' => '',
'elementActive' => 'admin'
])

@section('content')
<style>
  .timepicker_div{ text-align:center; padding:40px;}

</style>

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="container">

            </div>
            <div class="modal fade" id="form2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Workshift Status</h5>
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
                            <h5 class="modal-title" id="exampleModalLabel">Create Work Shift</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="ajaxform">
<meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">
      
      
          <div class="form-group">
            <label for="email1">Work Shift</label>
            <input type="text" class="form-control"  name="name" >
           
          </div>
       
          <div class='form-group date' id='datetimepicker3'>
          <label for="password1">   <i class="nc-icon nc-time-alarm"></i> From</label>
         
    <input type="text"  class="form-control timepicker" id="from_hour" placeholder=" Time " name="from_hour">


          
        </div>
        <div class='form-group date' id='datetimepicker3'>
          <label for="password1">   <i class="nc-icon nc-time-alarm"></i> To</label>
          <input type="text"  class="form-control timepicker" id="to_hour" placeholder=" Hour " name="to_hour">
          
        </div>
        <div class='form-group'>
          <label for="password1"> Work Hour</label>
          <input type="number"  class="form-control" placeholder=" Hour " name="hour_per_day">
          
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
                    <h4 class="card-title"> Work Shift List</h4>
                    <h4 class="card-title text-right"> <button class="btn btn-info" data-toggle="modal" data-target="#form" title="Add User!"><i class="nc-icon nc-simple-add"></i></button> </h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead class=" text-primary">
                                <th>
                                Work Shift Name
                                </th>
                                <th>
                             From
                                </th>
                                <th>
                             To
                                </th>
                                <th>
                               Hour per Day
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
<!-- 
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
<link rel="stylesheet" href="https://rawgit.com/Eonasdan/bootstrap-datetimepicker/master/build/css/bootstrap-datetimepicker.min.css">
<script src="https://rawgit.com/Eonasdan/bootstrap-datetimepicker/master/build/js/bootstrap-datetimepicker.min.js"></script>

    <script>
     $('#datetimepicker3').datetimepicker({
    defaultDate: new Date(),
    format: 'DD/MM/YYYY H:mm:ss',
    sideBySide: true
}); -->

        </script>
@endsection

@push('scripts')
 
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script src="{{asset('js/time.js')}}"></script>
<link rel="stylesheet" href='{{ asset("css/time.css") }}'  type="text/css"/>
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
               ajax: "{{ route('data_workshift') }}",
               columns: [  
               { data: 'name', name: 'name' },
               { data: 'from_hour', name: 'from_hour' },
               { data: 'to_hour', name: 'to_hour' },
               { data: 'hour_per_day', name: 'hour_per_day' },
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

        let name = $("input[name=name]").val();
        let from_hour = $("input[name=from_hour]").val();
        let to_hour = $("input[name=to_hour]").val();
        let hour_per_day = $("input[name=hour_per_day]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('save_workshift') }}", 
            type: "POST",
            data: {
                name: name,
                from_hour: from_hour,
                to_hour: to_hour,
                hour_per_day: hour_per_day,
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
    $(document).ready(function(){
    $('.timepicker').mdtimepicker();
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
            url: "{{ route('update_workshift') }}",
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


