@extends('layouts.app', [
'class' => '',
'elementActive' => 'leave'
])

@section('content')
<link rel="stylesheet" href='{{ asset("/css/jquery.dataTables.min.css") }}' type="text/css" />
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Leave List</h4>
                    <h4 class="card-title text-right"> <a href="{{url('/leave/assign-leave')}}"><button class="btn btn-info" title="Add !"><i class="nc-icon nc-simple-add"></i></button> </a></h4>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="email1">Employee Name</label>
                                <select class="form-control select2" id="emp_id" >
                                <option value="0">All</option>
            @foreach ($emp as $get)
                <option value="{{$get->id}}">{{$get->first_name}} {{$get->middle_name}} {{$get->last_name}}</option>
                @endforeach
            </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="password1">Leave Type</label>

                                <select class="form-control" id="type" name="leave_type" >
                                <option value="0">All</option>
            @foreach ($type as $get)
                <option value="{{$get->id}}">{{$get->name}}</option>
                @endforeach
            </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="password1">Status</label>
                                <select class="form-control" id="status">
                                    <option value="All">All</option>
                                    <option value="0">Pending Approval</option>
                                    <option value="1">Rejected</option>
                                    <option value="2">Scheduled</option>
                                    <option value="3">Taken</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="email1">From</label>
                                <input type="date" class="form-control" id="from" aria-describedby="emailHelp" placeholder="Type for hint">

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="password1">To</label>

                                <input type="date" class="form-control" id="to" aria-describedby="emailHelp" placeholder="Type for hint">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <button class="btn btn-info" id="filter"><i class="nc-icon nc-zoom-split"></i> Search</button>
                            <button class="btn btn-success" id="refresh">Reset</button>
                        </div>
                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-4">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="container">

            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"></h4>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>Employee </th>

                                    <th>Leave Type</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Number Of Date</th>
                                    <th>Comments</th>
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
<script src="{{asset('js/jquery-3.5.1.js')}}"></script>
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

        })
    })
load()

    function load(emp_id = '', type = '' , status = '', dept = '', to = '', from = '') {
        $('#table').DataTable().clear().destroy();
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',

            buttons: [
                'csv', 'pdf'
            ],
            ajax: {
                   url:"{{ route('data_leave') }}",
               data:{emp_id:emp_id, type:type , status:status , dept:dept , to:to , from:from}
            },
            columns: [{
                    data: 'emp_first',
                    name: 'emp_first',
                    render: function(data, type, row) {
                        return row.emp_first + '&nbsp' + row.emp_middle + '&nbsp' + row.emp_last
                    }
                },
                {
                    data: 'leave_type',
                    name: 'leave_type'
                },
                {
                    data: 'from_date',
                    name: 'from_date'
                },
                {
                    data: 'to_date',
                    name: 'to_date'
                },
                {
                    data: 'number',
                    name: 'number'
                },
                {
                    data: 'comment',
                    name: 'comment'
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
</script>
@endpush