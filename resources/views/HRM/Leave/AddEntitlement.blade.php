@extends('layouts.app', [
'class' => '',
'elementActive' => 'leave'
])

@section('content')
<link rel="stylesheet" href='{{ asset("/css/jquery.dataTables.min.css") }}' type="text/css" />

<section class="content">
  <div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-info">
      <div class="card-header">
        <h4> <i class="nc-icon nc-badge"></i> &nbsp&nbsp Add Entitlement </h4>

        <!-- <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div> -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form action="{{ route('save_entitlement') }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
     
        
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Employee</label>
                <select class="form-control select2" id="" name="emp_id" >
            @foreach ($emp as $get)
                <option value="{{$get->id}}">{{$get->first_name}} {{$get->middle_name}} {{$get->last_name}}</option>
                @endforeach
            </select>
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
              <label>Leave Type</label>

              <select class="form-control" id="" name="leave_type" >
            @foreach ($leave_type as $get)
                <option value="{{$get->id}}">{{$get->name}}</option>
                @endforeach
            </select>

              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
              <label>Leave Period (Year)</label>
                <input class="form-control float-right requested" type="number" min="{{ now()->year }}"  name="leave_period">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
              <label>Entitlement</label>
                <input class="form-control" style="width: 100%;" name="leave_balance">

              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
         
          <div class="row">
          
         

          </div>


          <!-- /.row -->

          <!-- /.row -->

          <!-- /.row -->



          <button type="submit" class="btn btn-info btn-lg">Submit</button>
         
          <a href="{{url('/leave/list-entitlement')}}">  <label  class="btn btn-default btn-lg float-right">Cancel</label> </a>
          </form>
          <!-- /.card -->
       
      </div>
    </div>
    <!-- /.container-fluid -->
</section>
@endsection

@push('scripts')
<script src="{{asset('js/jquery-3.5.1.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
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
            scrollY: 200,
            info: false,
            dom: 'Bfrtip',
            paging: false,
            ajax: "{{ route('data_my_leave') }}",
            columns: [  {data :'date', name: 'date'},
               { data: 'leave_type', name: 'leave_type'} ,
               { data: 'from_date', name: 'from_date'} ,
               { data: 'to_date', name: 'to_date'} ,
               { data: 'status', name: 'status'} ,
               { data: 'comment', name: 'comment'} ,

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
        let comment = $("textarea[name=comment]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('save_my_leave') }}", 
            type: "POST",
            data: {
                leave_type: leave_type,
                from_date: from_date,
                to_date: to_date,
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