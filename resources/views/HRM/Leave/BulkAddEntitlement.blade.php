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
        <h4> <i class="nc-icon nc-badge"></i> &nbsp&nbsp Bulk Add Entitlement </h4>

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
        <form action="{{ route('save_bulk_entitlement') }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
     
        
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Criteria</label>
                <select class="form-control select2" id="" name="dept_id" >
                <option value="">-</option>
                <option value="0">Contract over than 1 year</option>
                <option value="0">All</option>
         
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
                <input type="text" class="form-control float-right requested"  name="leave_period">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
              <label>Entitlement</label>
                <input class="form-control" type="number" style="width: 100%;" name="leave_balance">

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
          <button type="" class="btn btn-default btn-lg float-right">Cancel</button>

          <!-- /.card -->
        </form>
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

  

    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2({

        })
    })
   
</script>
@endpush