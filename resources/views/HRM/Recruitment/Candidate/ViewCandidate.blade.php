@extends('layouts.app', [
'class' => '',
'elementActive' => 'recruitment'
])

@section('content')
<link href="{{ asset('paper') }}/css/imgupload.css" rel="stylesheet" />
<section class="content">
  <div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-info">
      <div class="card-header">
        <h4> <i class="nc-icon nc-badge"></i> &nbsp&nbsp Candidate </h4>

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
       
          <div class="form-group row">
          
          <div class="col-md-2">
          <img style="height: 200px;"  src="{{ asset($data->picture) }}" alt="..." onclick="enlargeImg()"
        id="img1">
          </div>
          <div class="col-md-10">
          <div class="table-responsive">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>Performed Date</th>
                                    <th>Description</th>
                                   
                                </tr>
                            </thead>
                        </table>
                    </div>
          </div>
          

          </div>
       
          <br>
          <br>
      
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Name</label>
                <input type="hidden" value="{{$data->id}}" name="id">
                <input type="text" class="form-control" value="{{$data->first_name}} {{$data->middle_name}} {{$data->last_name}}" name="first_name" disabled>
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input class="form-control" style="width: 100%;" value="{{$data->email}}" name="email" disabled>

              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label>Whatsapp Number </label>
                <input class="form-control" style="width: 100%;" value="{{$data->contact_phone}}" name="contact_phone" disabled>

              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Facebook </label>
                <input class="form-control" style="width: 100%;" value="{{$data->facebook}}" name="facebook" disabled>

              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
           
            <!-- /.col -->
          </div>
          <div class="row">
         
         
           
            <!-- /.col -->
          
            <!-- /.col -->
          </div>
          <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label>Twitter/Instagram </label>
                <input class="form-control" style="width: 100%;"  value="{{$data->twitter}}"name="twitter" disabled>

              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Linkedin </label>
                <input class="form-control" style="width: 100%;" value="{{$data->linkedin}}" name="linkedin" disabled>

              </div>
              <!-- /.form-group -->

            </div>
           
            <!-- /.col -->
          
            <!-- /.col -->
          </div>
          <div class="row">
           
          


          </div>
<hr>
<div class="row">
@if($data->status == 0)
            <div class="col-md-6">
              <div class="form-group">
                <label>Status</label>
                <input type="text" class="form-control" style="width: 100%;" value="Application Initiated" name="note" disabled>
              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Action</label>
                <select class="form-control select2" style="width: 100%;" name="vacancy_id" >
                <option>Select Action</option>
      <option>Shortlist</option>
      <option>Reject</option>
       </select>
              </div>
              <!-- /.form-group -->

            </div>
            @elseif($data->status == 1)
            <div class="col-md-6">
              <div class="form-group">
                <label>Status</label>
                <input type="text" class="form-control" style="width: 100%;" value="Shorlisted" name="note" disabled>
              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Action</label>
                <select class="form-control select2" style="width: 100%;" name="vacancy_id" >
                <option>Select Action</option>
      <option>Scheduled Interview</option>
      <option>Reject</option>
       </select>
              </div>
              <!-- /.form-group -->

            </div>
            @elseif($data->status == 2)
            <div class="col-md-6">
              <div class="form-group">
                <label>Status</label>
                <input type="text" class="form-control" style="width: 100%;" value="Interview Scheduled" name="note" disabled>
              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Action</label>
                <select class="form-control select2" style="width: 100%;" name="vacancy_id" >
                <option>Select Action</option>
      <option>Mark Interview Passed</option>
      <option>Mark Interview Failed</option>
      <option>Reject</option>
       </select>
              </div>
              <!-- /.form-group -->

            </div>
            @endif
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Job Vacancy</label>
                <select class="form-control select2" style="width: 100%;" name="vacancy_id" disabled>
              
                  @foreach( $vacancy as $get )
                          @if( $get->id == $data->vacancy_id)
                          <option value="{{ $get->id }}" selected="">{{$get->vacancy_name}} - {{$get->location->name}}}</option>
                          @else
                          <option value="{{ $get->id }}"> {{$get->vacancy_name}} - {{$get->location->name}}</option>
                          @endif
                          @endforeach
                </select>
              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Date of Application</label>
                <input type="date" class="form-control" style="width: 100%;" value="{{$data->date_apply}}" name="date_apply" disabled>
              </div>
              <!-- /.form-group -->

            </div>

          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Comment</label>
                <input type="text" class="form-control" style="width: 100%;" value="{{$data->note}}" name="note" disabled>
              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">
             
                <label>Resume</label>
                <br>
                <a href="{{url('/recruitment/resume/')}}/{{$data->id}}">
               <button class="btn btn-secondary btn-sm">
                   Download
               </button></a>
             
              <!-- /.form-group -->

            </div>

          </div>
    
       <a href="{{url('/recruitment/candidate-list')}}">   <button  class="btn btn-default btn-lg">Back</button></a>
          <button type="" class="btn btn-warning btn-lg float-right">Update</button>

 
      </div>
    </div>
    <!-- /.container-fluid -->
</section>
@endsection

@push('scripts')
<link href="{{ asset('paper') }}/css/select2.min.css" rel="stylesheet" />
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<link rel="stylesheet" href='{{ asset("/css/buttons.dataTables.min.css") }}' type="text/css" />
<script src="{{asset('js/select2.min.js')}}"></script>
<script src="{{asset('js/imgupload.js')}}"></script>
<script>
   $(function() {
        //Initialize Select2 Elements
        $('.select2').select2({

        })
    })
    let id = $("input[name=id]").val();
load(id)
console.log(id)
    function load() {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            paging: false,
            info: false,
            searching : false,
            "aaSorting": [0,'desc'],
            scrollY: 120,
   

            ajax:{url: "{{ route('candidate_perform') }}",
            data: {
                    id: id}},
                  
            columns: [{
                    data: 'perform_date',
                    name: 'perform_date'

                },
                {
                    data: 'action',
                    name: 'action'

                },
            ]
        });
    }

</script>
@endpush