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
        <h4> <i class="nc-icon nc-badge"></i> &nbsp&nbsp Add Employee Position (Purpose for Hierarchy) </h4>

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
      <form action="{{ route('save_hierarchy') }}" method="post" enctype="multipart/form-data">
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
              <label>Position</label>

              <select class="form-control select2" id="" name="hierarchy_id" >
              @foreach ($job as $get)
                <option value="{{$get->hierarchy_id}}">{{$get->name}}</option>
                @endforeach
            </select>

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
      <!-- <div class="row">
        <div class="col-md-12">
            <div class="container">

            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"></h4>
                 
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm" id="table">
           <thead>
              <tr>
                 <th> ID </th>
          
                                 <th>Name</th>
                                 <th>Position</th>
                                
                                 <th>Action</th>
              </tr>
           </thead>
        </table>
                    </div>
                </div>
            </div>
        </div>

    </div> -->
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


    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2({

        })
    })
    
//     load();
//          function load(){
//             $('#table').DataTable({
//                processing: true,
//                serverSide: true,
//             dom: 'Bfrtip',
//             scrollY: 300,
//             sScrollX: 80,
//             "sScrollXInner": "100%",
//         "bScrollCollapse": true,
//             paging: false,
//             oLanguage: {
//    "sSearch": "Quick Search"
//  },
 
//     buttons: [
//              'csv', 'pdf'
//         ],
//                ajax: "{{ route('data_employee_hierarchy') }}",
//                "order": [[ 3, "asc" ]],
//                columns: [   
//                 {data :'emp_num', name: 'emp_num'},
//                { data: 'first_name', name: 'first_name'} ,
//                { data: 'job_title', name: 'job_title'} ,
              
//             //    { data: 'emp_supervisor', name: 'emp_supervisor'} ,
//                { data: 'location', name: 'location'} ,
								 			

//                      ]
//             });
//          }


</script>
@endpush