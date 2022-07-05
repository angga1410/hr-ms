@extends('layouts.app', [
'class' => '',
'elementActive' => 'leave'
])

@section('content')

<div class="content">
<form action="{{ route('save_entitlement_contract') }}" method="post" enctype="multipart/form-data">
          {!! csrf_field() !!}
     
        <div class="row">
        <div class="col-md-4">
        <div class="form-group">
           

              <select class="form-control" id="" name="leave_type" required>
              <option>Select Leave Type</option>
            @foreach ($leave_type as $get)
                <option value="{{$get->id}}">{{$get->name}}</option>
                @endforeach
            </select>

              </div>
        </div>
        <input type="hidden" class="form-control" value="{{ now()->year }}" name="leave_period">
        <div class="col-md-2">
              <div class="form-group">
             
                <input class="form-control" type="number" placeholder="Add Balance" name="leave_balance" required>

              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-4">
         
<div class="input-group">
            <!-- <input type="number" class="form-control" placeholder="Type the year" min="2020" name="to_date" id="to_date"> -->
           
    <span class="input-group-btn">
    <a class="btn btn-secondary" onclick="load()">Check Entitlement by Employee Contract</a>
    </span>
</div>
            </div>
            <!-- <div class="col-md-4">
            <button type="submit" class="btn btn-warning btn-sm">Submit</button>
       
            </div> -->
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h6>{{ __('Add Entitlement ') }} {{ now()->year }}</h6>
                    </div>
                  
                      
                        <div class="card-body">
                           

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" id="table">
                                            <thead>
                                            <tr>
                                           
                 <th> ID </th>
          
                                 <th>Name</th>
                                 <th>Job Title</th>
                                 <th>Departement</th>
                                 
                                 <!-- <th>Supervisor</th> -->
                                 <th>Location</th>
                                 <th>Join Date</th>
                                 <th></th>
                               
              </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                            <br>


                        </div>
                        <div class="card-footer">
                        
          <button type="" class="btn btn-secondary btn-lg float-right">Submit</button>
                        </div>
                </div>

</form>
            </div>
        </div>
 
</div>
@endsection


@push('scripts')
<script src="{{asset('js/jquery-3.5.1.js')}}"></script>
<script src="{{asset('js/typeahead.bundle.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<link href="{{ asset('paper') }}/css/select2.min.css" rel="stylesheet" />
<script src="{{asset('js/select2.min.js')}}"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2({

        })
    })

    function load(){
        $('#table').DataTable().clear().destroy();
            $('#table').DataTable({
               processing: true,
               serverSide: true,
            dom: 'Bfrtip',
            scrollY: 400,
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
               ajax: "{{ route('get') }}",
               "order": [[ 5, "asc" ]],
               columns: [   
              
                {data :'emp_num', name: 'emp_num'},
               { data: 'first_name', name: 'first_name'} ,
               { data: 'job_title', name: 'job_title'} ,
               { data: 'departement', name: 'departement'} ,
             
            //    { data: 'emp_supervisor', name: 'emp_supervisor'} ,
               { data: 'location', name: 'location'} ,
               { data: 'emp_status', name: 'emp_status'} ,
               {data :'emp_id', name: 'emp_id'},
            
								 			

                     ]
            });
         }
</script>
@endpush