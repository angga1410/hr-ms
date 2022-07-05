@extends('layouts.app', [
'class' => '',
'elementActive' => 'pim'
])

@section('content')
<style>

</style>
<section class="content">
  <div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-info">
      <div class="card-header">
        <h4> <i class="nc-icon nc-badge"></i> &nbsp&nbsp Add New Employee </h4>

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
        <form action="{{ route('save_employee') }}" method="post" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <div class="form-group row">
            <div class="col-md-3">
              <div class="form-group">
                <div class="box">
                  <div class="js--image-preview"></div>
                  <div class="upload-options">
                    <label>
                      <input type="file" class="image-upload form-control" accept="image/*" name="emp_pic" />

                    </label>

                  </div>
                </div>
              </div>
            </div>

          </div>
          <small id="fileHelp" class="form-text text-muted"><i>*Please upload a valid image file. Size of image should not be more than 2MB.</i></small>
          <br>
          <br>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Employee#</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Employee ID" value="" name="emp_num">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" name="first_name" required>
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Middle Name</label>

                <input type="text" class="form-control" name="middle_name">

              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control float-right requested" id="reservation" name="last_name">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Place of Birth</label>
                <input class="form-control" style="width: 100%;" name="emp_place_birth">

              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>KTP Number</label>
                <input type="text" class="form-control float-right requested" id="reservation" name="emp_other_id">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Date of Birth </label>

                <input type="date" class="form-control float-right requested" id="reservation" name="emp_birth">


              </div>


              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Meritial Status </label>
                <select class="form-control document_no" style="width: 100%;" name="emp_marital">
                  <option>-</option>

                  <option>Singel</option>
                  <option>Engaged</option>
                  <option>Married</option>
                  <option>Divorced</option>

                </select>
              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Gender </label>
                <select class="form-control document_no" style="width: 100%;" name="emp_gender">
                  <option>-</option>

                  <option>Male</option>
                  <option>Female</option>
                  <option>Other</option>

                </select>
              </div>
              <!-- /.form-group -->

            </div>


          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nationality</label>
                <select class="form-control select2" style="width: 100%;" name="emp_nationality">
                  <option>-</option>
                  @foreach ($national as $nat)
                  <option value="{{$nat->id}}">{{$nat->code}} {{$nat->name}}</option>
                  @endforeach
                </select>
              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Driver's License Number </label>
                <input type="text" class="form-control float-right requested" name="emp_drive_license">
              </div>
              <!-- /.form-group -->

            </div>


          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Blood Group</label>
                <select class="form-control document_no" style="width: 100%;" name="emp_blood_grp">
                  <option>-</option>
                  <option>A</option>
                  <option>AB</option>
                  <option>B</option>
                  <option>O</option>
                </select>
              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Hobbies </label>
                <input type="text" class="form-control float-right requested" id="reservation" name="emp_hobbies">
              </div>
              <!-- /.form-group -->

            </div>


          </div>



          <div class="card card-info">
            <div class="card-header">
              <h6> Employment Details </h6>

              <!-- <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div> -->
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Joined Date</label>
                    <input type="date" class="form-control float-right requested" id="reservation" name="emp_join_date" required>
                  </div>
                  <!-- /.form-group -->

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label> Date of Permanency </label>
                    <input type="date" class="form-control float-right requested" id="reservation" name="emp_date_permanency">
                  </div>
                  <!-- /.form-group -->

                </div>


              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Job Title</label>
                    <select class="form-control select2 document_no" style="width: 100%;" name="emp_job_title">
                    
                      @foreach ($jobtitle as $title)
                      <option value="{{$title->id}}">{{$title->job_title}}</option>
                      @endforeach
                    </select>
                  </div>
                  <!-- /.form-group -->

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Employee Status </label>
                    <select class="form-control select2 document_no" style="width: 100%;" name="emp_status">
                     
                      @foreach ($employeestatus as $status)
                      <option value="{{$status->id}}">{{$status->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <!-- /.form-group -->

                </div>


              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Department</label>
                    <select class="form-control select2 document_no" style="width: 100%;" name="emp_job_ctg">
                    
                      @foreach ($jobcategory as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <!-- /.form-group -->

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Location</label>
                    <select class="form-control select2 document_no" style="width: 100%;" name="emp_location">
                    
                      @foreach ($location as $loc)
                      <option value="{{$loc->id}}">{{$loc->name}} - {{$loc->city}}</option>
                      @endforeach
                    </select>
                  </div>
                  <!-- /.form-group -->

                </div>

              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>BPJS Ketenagakerjaan</label>
                    <input type="text" class="form-control float-right requested"  name="bpjs_kej" >
                  </div>
                  <!-- /.form-group -->

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label> BPJS Kesehatan </label>
                    <input type="text" class="form-control float-right requested"  name="bpjs_kes">
                  </div>
                  <!-- /.form-group -->

                </div>


              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Work Shift</label>
                    <select class="form-control select2 document_no" style="width: 100%;" name="emp_work_shift">
                     
                      @foreach ($workshift as $shift)
                      <option value="{{$shift->id}}">{{$shift->name}} ({{$shift->from_hour}}-{{$shift->to_hour}})</option>
                      @endforeach
                    </select>
                  </div>
                  <!-- /.form-group -->

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Effective From </label>
                    <input type="date" class="form-control float-right requested" id="reservation" name="emp_effective_date" required>
                  </div>
                  <!-- /.form-group -->

                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Is Supervisor</label>
                    <select class="form-control type" style="width: 100%;" name="is_supervisor">
                      <option value="0" data="1">-</option>
                      <option value="1" data="0">Yes</option>
                      <option value="0" data="1">No</option>
                    </select>
                  </div>
                  <!-- /.form-group -->

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Supervisor</label>
                    <select class="form-control select2" id="supervisor" style="width: 100%;" name="emp_supervisor" disabled>
                      <option value="0">-</option>
                      @foreach ($supervisor as $super)
                      <option value="{{$super->id}}">{{$super->first_name}} {{$super->middle_name}} {{$super->last_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <!-- /.form-group -->

                </div>

              </div>

            </div>


          </div>

          <div class="card card-info">
            <div class="card-header">
              <h6> Employment Contract </h6>

              <!-- <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div> -->
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" class="form-control float-right requested" id="reservation" name="emp_contract_start" >
                  </div>
                  <!-- /.form-group -->

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>End Date </label>
                    <input type="date" class="form-control float-right requested" id="reservation" name="emp_contract_end" >
                  </div>
                  <!-- /.form-group -->

                </div>


              </div>
            </div>
          </div>
          <div class="card card-info">
            <div class="card-header">
              <h6> Employment Note </h6>

              <!-- <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div> -->
            </div>

            <div class="card-body">

              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Note</label>
                <div class="col-sm-10">

                  <textarea class="form-control" name="emp_note"></textarea>
                </div>
              </div>
            </div>
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
  $(function() {

    $(".type").on("change", function() {
      var type = $(this).find('option:selected').attr('data');
      console.log(type);

      if (type != 0) {
        document.getElementById("supervisor").disabled = false;
      } else {
        document.getElementById("supervisor").disabled = true;
      }
    })
  })
</script>
@endpush