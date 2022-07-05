@extends('layouts.app', [
'class' => '',
'elementActive' => 'leave'
])

@section('content')
<link rel="stylesheet" href='{{ asset("/css/jquery.dataTables.min.css") }}' type="text/css" />
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Apply Leave</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @if ($leave_blc == null)
      <form id="ajaxform">
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">
       
      
       
        <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="email1">Leave Type</label>
            <select class="form-control" id=""   name="leave_type" >
            </select>
            
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="password1">Leave Balance</label>
            <input type="text" readonly class="form-control" value="Insufficient leave balance !" >
          </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="email1">From Date</label>
            <input type="date" class="form-control" readonly name="from_date">
            
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="password1">To Date</label>
            <input type="date" class="form-control" readonly name="to_date" >
          </div>
        </div>
        </div>


        <div class="form-group">
            <label for="email1">Note</label>
            <textarea class="form-control" name="comment" readonly></textarea>
           
          </div>
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
        <button class="btn btn-success save-data" data-dismiss="modal" disabled id="btnupdate">Submit</button>
        </div>
      </form>
@else
      <form id="ajaxform">
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">
        <div class="form-group">
            <label for="email1">Leave Period</label>
            <input type="text" readonly  class="form-control" value="{{ now()->year }}" name="year">
          </div>
        <div class="row">
        
        <div class="col-md-6">
          <div class="form-group">
            <label for="email1">Leave Type</label>
            <select class="form-control type" id="" name="leave_type" >
            <option>-</option>
            @foreach ($leave_type as $get)
          
                <option value="{{$get->type->id}}" data="{{$get->leave_balance}}">{{$get->type->name}}</option>
                @endforeach
            </select>
            
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="password1">Leave Balance</label>
            <input type="text" readonly class="form-control blc"  >
          </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="email1">From Date</label>
            <input type="date" class="form-control" name="from_date">
            
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="password1">To Date</label>
            <input type="date" class="form-control" name="to_date" >
          </div>
        </div>
        </div>


        <div class="form-group">
            <label for="email1">Note</label>
            <textarea class="form-control" name="comment" ></textarea>
           
          </div>
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
        <button class="btn btn-success save-data" data-dismiss="modal" id="btnupdate">Submit</button>
        </div>
      </form>
      @endif
    </div>
  </div>
            </div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">My Leave Usage</h4>
                    <h4 class="card-title text-right"> <button class="btn btn-info" data-toggle="modal" data-target="#form" title="Add !"><i class="nc-icon nc-simple-add"></i></button> </h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table" id="table">
           <thead>
              <tr>
               
          
                                 <th>Leave Type</th>
                                 <th>Leave Entitlement (Days)</th>
                                 <th>Leave Pending Approval (Days)</th>
                                 <th>Leave Scheduled (Days)</th>
                                 <th>Leave Balance (Days)</th>
                                
                               
              
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
	$(function(){
	
  $(".type").on("change",function(){
  $('.blc').val('');
  var blc = $(this).find('option:selected').attr('data');
  $(".blc").val(blc);
  });
  });
    load();

    function refreshdata() {
        $('#name').val('');
        $('#table').DataTable().clear().destroy();
        load();
    }

    function closing() {
        $('#form').modal('hide');
    }

    function load() {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            scrollY: 400,
            info: false,
            dom: 'Bfrtip',
            paging: false,
            ajax: "{{ route('data_my_leave_report') }}",
            columns: [  
               
               { data: 'leave_type', name: 'leave_type'} ,
               { data: 'entitlement', name: 'entitlement'} ,
               { data: 'pending', name: 'pending'} ,
               { data: 'scheduled', name: 'scheduled'} ,
               { data: 'balance', name: 'balance'} ,

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

        let leave_type = $("select[name=leave_type]").val();
        let from_date = $("input[name=from_date]").val();
        let to_date = $("input[name=to_date]").val();
        let year = $("input[name=year]").val();
        let comment = $("textarea[name=comment]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('save_my_leave') }}", 
            type: "POST",
            data: {
                leave_type: leave_type,
                from_date: from_date,
                to_date: to_date,
                year: year,
                comment: comment,
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