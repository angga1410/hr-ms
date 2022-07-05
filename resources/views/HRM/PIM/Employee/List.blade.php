@extends('layouts.app', [
'class' => '',
'elementActive' => 'pim'
])

@section('content')
<style>

</style>
<link rel="stylesheet" href='{{ asset("/css/jquery.dataTables.min.css") }}' type="text/css" />
<link rel="stylesheet" href='{{ asset("/css/listEmp.css") }}' type="text/css" />
<div class="content">
    <div class="row">
    
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Employee List</h4>
                    <h4 class="card-title text-right"> <a href="{{url('/pim/add-employee')}}"><button class="btn btn-info" title="Add !"><i class="nc-icon nc-simple-add"></i></button> </a></h4>
                </div>

                <div class="card-body">
                <!-- <div class="accordion indicator-plus-before round-indicator" id="accordionH" aria-multiselectable="true">
				<div class="card m-b-0">
					<div class="card-header collapsed" role="tab" id="headingThreeH" href="#collapseThreeH" data-toggle="collapse" data-parent="#accordionH" aria-expanded="false" aria-controls="collapseThreeH">
						<a class="card-title">Click to filter and search</a>
					</div>
					<div class="collapse" id="collapseThreeH" role="tabpanel" aria-labelledby="headingThreeH">
						<div class="card-body">
                        <div class="row">
                        <div class="col-sm-3">
                        <div class="form-group">
                                <label for="password1">Job Title</label>
                                <select class="form-control select2 " style="width: 100%;" name="emp_job_title">
                      <option>All</option>
                      @foreach ($jobtitle as $title)
                      <option value="{{$title->id}}">{{$title->job_title}}</option>
                      @endforeach
                    </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                        <div class="form-group">
                                <label for="password1">Departement</label>
                                <select class="form-control select2 " style="width: 100%;" name="emp_job_ctg">
                      <option>All</option>
                      @foreach ($jobcategory as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                    </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="password1">Employee Status</label>
                                <select class="form-control select2 " style="width: 100%;" name="emp_status">
                      <option>All</option>
                      @foreach ($employeestatus as $status)
                      <option value="{{$status->id}}">{{$status->name}}</option>
                      @endforeach
                    </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="password1">Location</label>
                                <select class="form-control select2 " style="width: 100%;" name="emp_location">
                      <option>All</option>
                      @foreach ($location as $loc)
                      <option value="{{$loc->id}}">{{$loc->name}} - {{$loc->city}}</option>
                      @endforeach
                    </select>
                            </div>
                        </div>
                    </div>
                  
                    <div class="row">
                        <div class="col-sm-4">
                            <button class="btn btn-info" title="Add !"><i class="nc-icon nc-zoom-split"></i> Search</button>
                            <button class="btn btn-success" title="Add !">Reset</button>
                        </div>
                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-4">

                        </div>
                    </div>
						</div>
					</div>
				</div>
			</div>	 -->
             
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
                    <table class="table table-bordered table-hover table-sm" id="table">
           <thead>
              <tr>
                 <th> ID </th>
          
                                 <th>Name</th>
                                 <th>Job Title</th>
                                 <th>Departement</th>
                                 <th>Employment Status</th>
                                 <!-- <th>Supervisor</th> -->
                                 <th>Location</th>
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
<link href="{{ asset('paper') }}/css/select2.min.css" rel="stylesheet" />
<script src="{{asset('js/select2.min.js')}}"></script>
    <script type="text/javascript" src='{{ asset("/js/dataTables.buttons.min.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/buttons.flash.min.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/jszip.min.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/pdfmake.min.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/vfs_fonts.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/buttons.html5.min.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/buttons.print.min.js") }}'></script>
<script type="text/javascript">
   $(function() {
        //Initialize Select2 Elements
        $('.select2').select2({

        })
    })
load();
         function load(){
            $('#table').DataTable({
               processing: true,
               serverSide: true,
            dom: 'Bfrtip',
            scrollY: 380,
            sScrollX: 80,
            "sScrollXInner": "100%",
        "bScrollCollapse": true,
            paging: false,
            oLanguage: {
   "sSearch": "Quick Search"
 },
 
    buttons: [
             'csv', 'pdf'
        ],
               ajax: "{{ route('data_employee') }}",
               "order": [[ 3, "asc" ]],
               columns: [   
                {data :'emp_num', name: 'emp_num'},
               { data: 'first_name', name: 'first_name'} ,
               { data: 'job_title', name: 'job_title'} ,
               { data: 'departement', name: 'departement'} ,
               { data: 'emp_status', name: 'emp_status'} ,
            //    { data: 'emp_supervisor', name: 'emp_supervisor'} ,
               { data: 'location', name: 'location'} ,
								 			

                     ]
            });
         }

 

</script>
@endpush
