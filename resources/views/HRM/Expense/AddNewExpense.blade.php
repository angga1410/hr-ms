@extends('layouts.app', [
'class' => '',
'elementActive' => 'expense'
])

@section('content')
<style>

</style>
<section class="content">
  <div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Travel Request Information</h5>
                </div>


                <div class="card-body">
                   <div class="row">
                   <div class="col-sm-3">
                   <h6>Employee Id</h6>
                   </div>
                   <div class="col-sm-3">
                   <p>: {{$emp->emp_num}}</p>
                   </div>
                   <div class="col-sm-3">
                   <h6>Employee Name</h6>
                   </div>
                   <div class="col-sm-3">
                   <p>: {{$emp->first_name}} {{$emp->middle_name}} {{$emp->last_name}}</p>
                   </div>
                   </div>
                   <div class="row">
                   <div class="col-sm-3">
                   <h6>Departement</h6>
                   </div>
                   <div class="col-sm-3">
                   <p>: {{$emp->departement->name}}</p>
                   </div>
                   <div class="col-sm-3">
                   <h6>Job Title</h6>
                   </div>
                   <div class="col-sm-3">
                   <p>: {{$emp->job->job_title}}</p>
                   </div>
                   </div>

                  

                 
                </div>
            </div>
    <div class="card card-info">
      <div class="card-header">
      <h5 class="card-title">Travel Information</h5>
      <h4 class="card-title text-right"> <a data-toggle="modal" data-target="#form1" ><button class="btn btn-secondary" title="Add !"><i class="nc-icon nc-simple-add"></i></button> </a></h4>
        
      </div>

      <div class="card-body">
      

      
          {!! csrf_field() !!}
        
       
          <table class="table" id="tableExp">
                      <thead>
                        <tr>
                          <th>Main Destination </th>

                          <th>Travel Period From</th>
                          <th>Travel Period To</th>
                          <th>Preferred Departure Time</th>
                          <th>Destination Address</th>
                          <th></th>


                        </tr>
                      </thead>
                    </table>

         
          <!-- /.card -->
       
      </div>
    </div>
    <div class="card card-info">
      <div class="card-header">
      <h5 class="card-title">Travel Request Estimates</h5>
      <h4 class="card-title text-right"> <a data-toggle="modal" data-target="#form2" ><button class="btn btn-secondary" title="Add !"><i class="nc-icon nc-simple-add"></i></button> </a></h4>
        
      </div>

      <div class="card-body">
      

      
          {!! csrf_field() !!}
        
       
          <table class="table" id="tableExp">
                      <thead>
                        <tr>
                          <th> Expense Type </th>

                          <th>Foreign Currency Type</th>
                          <th>Estimated Expense</th>
                          <th>Estimated Expense (in BWP)</th>
                          <th>Paid By</th>
                          <th></th>


                        </tr>
                      </thead>
                    </table>

         
          <!-- /.card -->
       
      </div>
    </div>
    <div class="card card-info">
      <div class="card-header">
      <h5 class="card-title">Attachments</h5>
      <h4 class="card-title text-right"> <a data-toggle="modal" data-target="#form2" ><button class="btn btn-secondary" title="Add !"><i class="nc-icon nc-simple-add"></i></button> </a></h4>
        
      </div>

      <div class="card-body">
      

      
          {!! csrf_field() !!}
        
       
          <table class="table" id="tableExp">
                      <thead>
                        <tr>
                        

                          <th>Description</th>
                          <th>Document Date</th>
                          <th>Date Added</th>
                          <th>Added By</th>
                          <th>Download</th>
                          <th></th>


                        </tr>
                      </thead>
                    </table>

         
          <!-- /.card -->
       
      </div>
    </div>
    <div class="card card-info">
      <div class="card-header">
      <h5 class="card-title">Summary</h5>
   
      </div>

      <div class="card-body">
      

      
      <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Purpose</label>
            <div class="col-sm-10">
              <textarea type="text" class="form-control"  value="00111" name="emp_num"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Note</label>
            <div class="col-sm-10">
              <textarea type="text" class="form-control"  value="00111" name="emp_num"></textarea>
            </div>
          </div>
         
          <!-- /.card -->
          <button type="submit" class="btn btn-info btn-lg">Submit</button>
          <button type="" class="btn btn-default btn-lg float-right">Cancel</button>
      </div>
    </div>

    <div class="modal fade" id="form1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Travel Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="ajaxform">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">


          <div class="form-group">
            <label for="email1">Main Destination</label>
            <input type="text" class="form-control " id="school" name="school">
          </div>


          <div class="form-group">
            <label for="email1">Travel Period From</label>
            <input type="text" class="form-control " id="school" name="school">

          </div>
          <div class="form-group">
            <label for="email1">Travel Period To</label>
            <input type="text" class="form-control " id="major" name="major">

          </div>
      
          <div class='form-group date' id='datetimepicker3'>
          <label for="password1">   <i class="nc-icon nc-time-alarm"></i> Prefered Departure Time</label>
         
    <input type="text"  class="form-control timepicker" id="from_hour" placeholder=" Time " name="from_hour">


          
        </div>

          <div class="form-group">
            <label for="email1">Destination Address</label>
            <textarea type="text" class="form-control " id="gpa" name="gpa"></textarea>

          </div>

        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button class="btn btn-success save-data-edu" data-dismiss="modal" id="">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="form2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Travel Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="ajaxform">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">


          <div class="form-group">
            <label for="email1">Expense Type</label>
            <select  class="form-control " id="school" name="school">
            <option>-</option>
            @foreach ($type as $get)
            <option value="{{$get->id}}">{{$get->name}}</option>
            @endforeach
            </select>
          </div>


          <div class="form-group">
            <label for="email1">Amount (Rp)</label>
            <input type="number" class="form-control " id="school" name="">

          </div>
          <div class="form-group">
            <label for="email1">Paid By</label>
            <select  class="form-control " id="school" name="school">
            <option>-</option>
           
            <option value="1">Company</option>
            <option value="2">Staff</option>
            </select>

          </div>
      
        


        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button class="btn btn-success save-data-edu" data-dismiss="modal" id="">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="form3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Travel Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="ajaxform">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">


          <div class="form-group">
            <label for="email1">Expense Type</label>
            <select  class="form-control " id="school" name="school">
            <option>-</option>
            @foreach ($type as $get)
            <option value="{{$get->id}}">{{$get->name}}</option>
            @endforeach
            </select>
          </div>


          <div class="form-group">
            <label for="email1">Amount (Rp)</label>
            <input type="number" class="form-control " id="school" name="">

          </div>
          <div class="form-group">
            <label for="email1">Paid By</label>
            <select  class="form-control " id="school" name="school">
            <option>-</option>
           
            <option value="1">Company</option>
            <option value="2">Staff</option>
            </select>

          </div>
      
        


        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button class="btn btn-success save-data-edu" data-dismiss="modal" id="">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
    <!-- /.container-fluid -->
</section>
@endsection

@push('scripts')
<script src="{{asset('js/time.js')}}"></script>
<link rel="stylesheet" href='{{ asset("css/time.css") }}'  type="text/css"/>
<link href="{{ asset('paper') }}/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('paper') }}/css/imgupload.css" rel="stylesheet" />
<script src="{{asset('js/select2.min.js')}}"></script>
<script src="{{asset('js/imgupload.js')}}"></script>
<script>
  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2({

    })
  })


  $(document).ready(function(){
    $('.timepicker').mdtimepicker();
  });
</script>
@endpush