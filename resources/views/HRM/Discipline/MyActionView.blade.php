@extends('layouts.app', [
'class' => '',
'elementActive' => 'discipline'
])

@section('content')
<link rel="stylesheet" href='{{ asset("/css/jquery.dataTables.min.css") }}' type="text/css" />
<div class="modal fade" id="form2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title" id="exampleModalLabel">Vacancies Status</h5>
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
                      <option value="1">Inactive</option>
                    </select>
           
          </div>
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
        <button class="btn btn-secondary save-update"  data-dismiss="modal"  id="btnupdate">Update</button>
        </div>
      </form>
                    </div>
                </div>
            </div>
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title" id="exampleModalLabel">Create Disciplinary Case</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="ajaxform">
<meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">
      
      
          <div class="form-group">
            <label for="email1">Employee Name</label>
            <select class="form-control select2"  style="width: 100%;" name="emp_id">
                      <option value="0">-</option>
                      @foreach ($emp as $super)
                      <option value="{{$super->id}}">{{$super->first_name}} {{$super->middle_name}} {{$super->last_name}}</option>
                      @endforeach
                    </select>
           
          </div>
          <div class="form-group">
            <label for="email1">Case Name</label>
            <textarea type="email" class="form-control" id="name" name="case_name" ></textarea>
           
          </div>
          <div class="form-group">
            <label for="email1">Description</label>
            <textarea type="email" class="form-control" id="name" name="description" ></textarea>
           
          </div>
         
   

        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
        <button class="btn btn-success save-data"  data-dismiss="modal"  id="btnupdate">Submit</button>
        </div>
      </form>
                    </div>
                </div>
            </div>
<div class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="container">

            </div>
            <div class="card">
                <div class="card-header">
                <h4 class="card-title">Disciplinary Action</h4>
                    <h4 class="card-title text-right"> <button class="btn btn-info" data-toggle="modal" data-target="#form" title="Add !"><i class="nc-icon nc-simple-add"></i></button> </h4>
       

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>Employee </th>
                                    <th>Action</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th style="width: 300px">Description</th>
                                    <th>Created By</th>
                                    <th>Acted By</th>
                                    <th>Status</th>
                                </tr>
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
<link rel="stylesheet" href='{{ asset("/css/buttons.dataTables.min.css") }}' type="text/css" />

<script type="text/javascript" src='{{ asset("/js/dataTables.buttons.min.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/buttons.flash.min.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/jszip.min.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/pdfmake.min.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/vfs_fonts.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/buttons.html5.min.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/buttons.print.min.js") }}'></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
$(function() {
        //Initialize Select2 Elements
        $('.select2').select2({
            minimumResultsForSearch : 2,
        })
    })
load()
function refreshdata(){
      
        $('#table').DataTable().clear().destroy();
        load();
    }
    function load() {
        $('#table').DataTable({
            processing: true,
               serverSide: true,
            dom: 'Bfrtip',
            scrollY: 280,
            sScrollX: 80,
            "sScrollXInner": "100%",
        "bScrollCollapse": true,
            paging: false,
            oLanguage: {
   "sSearch": "Quick Search"
 },
            ajax: {
                   url:"{{ route('action_data') }}",
            //    data:{emp_id:emp_id, type:type , status:status , dept:dept , to:to , from:from}
            },
            columns: [
                {
                    data: 'first_name',
                    name: 'first_name',
                    render: function(data, type, row) {
                        return row.first_name + '&nbsp' + row.middle_name + '&nbsp' + row.last_name                           }
                },
                {
                    data: 'action_id',
                    name: 'action_id'
                },
                {
                    data: 'from_to',
                    name: 'from_to'
                },
                {
                    data: 'end_to',
                    name: 'end_to'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'first_name_emp',
                    name: 'first_name_emp',
                    render: function(data, type, row) {
                        return row.first_name_emp + '&nbsp' + row.middle_name_emp + '&nbsp' + row.last_name_emp }
                },
                {
                    data: 'first_name_act',
                    name: 'first_name_act',
                    render: function(data, type, row) {
                        return row.first_name_act + '&nbsp' + row.middle_name_act + '&nbsp' + row.last_name_act }
                },
               
               
                {
                    data: 'status',
                    name: 'status'
                },
             
               
            ]
        });
    }

    $('#filter').click(function(){
  var emp_id = $('#emp_id').val();
  var type = $('#type').val();
  var status = $('#status').val();
  var dept = $('#dept').val();
  var to = $('#to').val();
  var from = $('#from').val();
  if(emp_id != '' &&  type != '' &&  status != '' &&  dept != '' &&  to != '' &&  from != '')
  {
//    $('#price').DataTable().clear().destroy();
   load(emp_id, type, status,dept,to,from);
  }
  else
  {
   alert('Both Date is required');
  }
 });

 $('#refresh').click(function(){
  $('#emp_id').val('');
  $('#type').val('');
  $('#status').val('');
  $('#to').val('');
  $('#from').val('');
  $('#table').DataTable().clear().destroy();
 
 });

 $(".save-data").click(function(event) {
        event.preventDefault();

        let emp_id = $("select[name=emp_id]").val();
        let case_name = $("textarea[name=case_name]").val();
        let description = $("textarea[name=description]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('save_discipline') }}", 
            type: "POST",
            data: {
                emp_id: emp_id,
                case_name: case_name,
                description: description,
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

    
 $(".save-update").click(function(event) {
        event.preventDefault();

        let id = $("input[name=idstatus]").val();
        let status = $("select[name=updatedstatus]").val();
      
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('update_status') }}", 
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


    function updatevacancies(id){
        $('#form2').modal('show');
        $("input[name=idstatus]").val(id);
       
    }
</script>
@endpush