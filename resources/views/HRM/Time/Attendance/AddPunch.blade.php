@extends('layouts.app', [
'class' => '',
'elementActive' => 'leave'
])

@section('content')
<link rel="stylesheet" href='{{ asset("/css/jquery.dataTables.min.css") }}' type="text/css" />
<style>


</style>

<section class="content">

  <div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-info">
      <div class="card-header">
        <h4> <i class="nc-icon nc-badge"></i> &nbsp&nbsp Punch In/Out </h4>
     


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
     
        <form action="{{ route('save_assign_leave') }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        
        <!-- <div class="form-group">
            <label for="email1">Time Now</label>
            <input type="text" readonly  class="form-control" value="{{ date('H:i:s') }}" name="year">
          </div>
         -->
    

         
        

          <!-- /.row -->

          <!-- /.row -->

          <!-- /.row -->



          <button type="submit" class="btn btn-info btn-lg">Punch In</button>
      

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