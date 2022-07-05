@extends('layouts.app', [
'class' => '',
'elementActive' => 'time'
])

@section('content')
<link rel="stylesheet" href='{{ asset("/css/jquery.dataTables.min.css") }}' type="text/css" />

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">My Leave List</h4>
                   
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table" id="table">
           <thead>
              <tr>
                 <th>Date </th>
          
                                 <th>Punch In</th>
                                 <th>Punch Out</th>
                                 <!-- <th>Note</th> -->
                              
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
            "aaSorting":[0,'desc'],
            ajax: "{{ route('my_record_data') }}",
            columns: [  {data :'date', name: 'date'},
               { data: 'punch_in', name: 'punch_in'} ,
               { data: 'punch_out', name: 'punch_out'} ,
            //    { data: 'note', name: 'note'} ,
            //    { data: 'number', name: 'number'} ,
            //    { data: 'status', name: 'status'} ,
            //    { data: 'comment', name: 'comment'} ,

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