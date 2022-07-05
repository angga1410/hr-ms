@extends('layouts.app', [
'class' => '',
'elementActive' => 'pim'
])

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{asset('css/emp.css')}}" rel="stylesheet" />
<div class="content">
<p class="card-title text-right"> <button data-toggle="modal" data-target="#formTerminate" class="btn btn-secondary" title="Add !">Termination of employment</button> </p>
  @if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
  @endif
  @if (session('password_status'))
  <div class="alert alert-success" role="alert">
    {{ session('password_status') }}
  </div>
  @endif
  <div class="modal fade" id="formImg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="exampleModalLabel">Update Profile Picture</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('update_img') }}" method="post" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <div class="modal-body">


            <div class="form-group">

              <div class="box">
                <div class="js--image-preview"></div>
                <div class="upload-options">
                  <label>
                    <input type="file" class="image-upload form-control" accept="image/*" name="emp_pic_new" />

                  </label>

                </div>
              </div>

            </div>
            @if($data->emp_pic == null)
            <div class="form-group">
              <input type="hidden" class="form-control" name="emp_pic" value="0" />
            </div>
            @else
            <div class="form-group">
              <input type="hidden" class="form-control" name="emp_pic" value="{{$data->emp_pic}}" />
            </div>
            @endif
            <div class="form-group">
              <input type="hidden" class="form-control" name="id" value="{{$data->id}}" />
            </div>




          </div>
          <div class="modal-footer border-top-0 d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Upload</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="formTerminate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="exampleModalLabel">Warning !</h5>
          </br>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        
        </div>
        <form action="{{ route('update_img') }}" method="post" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <div class="modal-body">


            <div class="form-group">
<label>Confirm Password</label>
            <input type="password" class="form-control" name="id"  />

            </div>
        
          </div>
          <div class="modal-footer border-top-0 d-flex justify-content-center">
          </br>
          <i><small>By clicking the submit button below, I agree to and accept the terminate this employee</small></i>
            <button type="submit" class="btn btn-danger">Terminate</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="row">
  
    <div class="col-md-4">
      <div class="card card-user">
      
        <div class="image">
          <!-- <img src="{{ asset('paper/img/damir-bosnjak.jpg') }}" alt="..."> -->
        </div>
        <div class="card-body">
          <div class="author">

            @if($data->emp_pic == null)
            <img class="avatar" src="{{ asset('DataEmp/EmpPic/user.png') }}" alt="..." onclick="enlargeImg()" id="img1">
            @else
            <img class="avatar" src="{{ asset($data->emp_pic) }}" alt="...">

            @endif
            </br>
            <button data-toggle="modal" data-target="#formImg" class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-pencil"></i></button>
            <a href="#">

              <h5 class="title">{{$data->first_name}} {{$data->middle_name}} {{$data->last_name}} </h5>
            </a>

            <p class="description">
              {{$data->job->job_title}} -  {{$data->departement->name}}

            </p>
          </div>

          <p class="description text-center">
            <!-- {{ __('I like the way you work it') }}
                            <br> {{ __('No diggity') }}
                            <br> {{ __('I wanna bag it up') }} -->
          </p>
        </div>
        <div class="card-footer">
          <hr>
          <div class="button-container">
            <div class="row">

            </div>
          </div>
        </div>
      </div>
      @if($data->supervisor == null)
      @else
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{ __('Supervisor') }}</h4>
        </div>
        <div class="card-body">
          <ul class="list-unstyled team-members">
            <li>
              <div class="row">
                <div class="col-md-2 col-2">
                  <div class="avatar">


                    @if($data->supervisor->emp_pic == null)
                    <img src="{{ asset('DataEmp/EmpPic/user.png') }}" alt="Circle Image" class="img-circle img-no-padding img-responsive">

                    @else
                    <img src="{{ asset($data->supervisor->emp_pic) }}" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                    @endif

                  </div>

                </div>
                <div class="col-md-7 col-7">
                  {{$data->supervisor->first_name}} {{$data->supervisor->middle_name}} {{$data->supervisor->last_name}}
                  <br />


                </div>
                <div class="col-md-3 col-3 text-right">

                </div>
              </div>
            </li>


          </ul>
        </div>
      </div>
      @endif

    </div>
    <div class="col-md-8 text-center">

      <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" href="#description" role="tab" aria-controls="description" aria-selected="true">Personal Details</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#deals" role="tab" aria-controls="deals" aria-selected="false">Job </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#qualification" role="tab" aria-controls="qualification" onclick="refreshdata()" aria-selected="false">Qualifications </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#account" role="tab" aria-controls="deals" aria-selected="false">Account Details</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#history" role="tab" aria-controls="history" aria-selected="false">Contact Details</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="#family" role="tab" aria-controls="deals" aria-selected="false">Family Members </a>
            </li>
          
           
          </ul>
        
        </div>
        <div class="card-body">


          <div class="tab-content mt-3">
            <div class="tab-pane active" id="description" role="tabpanel">


              <div class="card-header">
                <h5 class="title">{{ __('Personal Details') }}</h5>
              </div>
              <div class="card-body">
                <form id="ajaxform">
                  <meta name="csrf-token" content="{{ csrf_token() }}" />

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="first_name" value="{{$data->first_name}}">
                      </div>
                      <!-- /.form-group -->

                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Middle Name</label>

                        <input type="text" class="form-control" name="middle_name" value="{{$data->middle_name}}">

                      </div>
                      <!-- /.form-group -->

                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control float-right" name="last_name" value="{{$data->last_name}}">
                      </div>
                      <!-- /.form-group -->

                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <div class="row">

                    <!-- /.col -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Place of Birth</label>
                        <input type="text" class="form-control float-right " name="emp_place_birth" value="{{$data->emp_place_birth}}">
                      </div>

                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Date of Birth </label>

                        <input type="date" class="form-control contact" name="emp_birth" value="{{$data->emp_birth}}">

                      </div>


                      <!-- /.form-group -->

                    </div>
                    <!-- /.col -->
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Employee ID</label>
                        <input type="text" class="form-control float-right " name="emp_num" value="{{$data->emp_num}}">
                      </div>
                      <!-- /.form-group -->

                      <!-- /.form-group -->
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>I.D Card Number</label>
                        <input type="text" class="form-control float-right " name="emp_other_id" value="{{$data->emp_other_id}}">
                      </div>
                      <!-- /.form-group -->

                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Meritial Status </label>
                        <select class="form-control document_no" style="width: 100%;" name="emp_marital">
                          @if ($data->emp_marital == 'Singel')
                          <option>-</option>
                          <option selected>Singel</option>
                          <option>Engaged</option>
                          <option>Married</option>
                          <option>Divorced</option>
                          @elseif ($data->emp_marital == 'Engaged')
                          <option>-</option>
                          <option>Singel</option>
                          <option selected>Engaged</option>
                          <option>Married</option>
                          <option>Divorced</option>
                          @elseif ($data->emp_marital == 'Married')
                          <option>-</option>
                          <option>Singel</option>
                          <option>Engaged</option>
                          <option selected>Married</option>
                          <option>Divorced</option>
                          @elseif ($data->emp_marital == 'Divorced')
                          <option>-</option>
                          <option>Singel</option>
                          <option>Engaged</option>
                          <option >Married</option>
                          <option selected>Divorced</option>
                          @else
                          <option selected>-</option>
                          <option>Singel</option>
                          <option>Engaged</option>
                          <option>Married</option>
                          <option >Divorced</option>
                          @endif
                        </select>
                      </div>
                      <!-- /.form-group -->

                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Gender </label>
                        <select class="form-control document_no" style="width: 100%;" name="emp_gender">
                          @if ($data->emp_gender == 'Male')
                          <option selected>Male</option>
                          <option>Female</option>
                          @else
                          <option>Male</option>
                          <option selected>Female</option>
                          @endif
                        </select>
                      </div>
                      <!-- /.form-group -->

                    </div>

                    <div class="form-group m-form__group" hidden>
                      <label for="exampleInputEmail1">Reference No.</label>
                      <input type="text" class="form-control m-input siteid id_employee" value="{{$data->id}}" name="id_employee">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nationality</label>
                        <select class="form-control select2 document_no" style="width: 100%;" name="emp_nationality">
                          @foreach( $national as $get )
                          @if( $get->id == $data->emp_nationality)
                          <option value="{{ $get->id }}" selected="">{{$get->code}} {{$get->name}}</option>
                          @else
                          <option value="{{ $get->id }}"> {{$get->code}} {{$get->name}}</option>
                          @endif
                          @endforeach
                        </select>
                      </div>
                      <!-- /.form-group -->

                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Driver's License Number </label>
                        <input type="text" class="form-control float-right requested" value="{{$data->emp_drive_license}}" name="emp_drive_license">
                      </div>
                      <!-- /.form-group -->

                    </div>


                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Blood Group</label>
                        <select class="form-control document_no" style="width: 100%;" name="emp_blood_grp">
                          @if ($data->emp_blood_grp == 'A')
                          <option>-</option>
                          <option selected>A</option>
                          <option>B</option>
                          <option>AB</option>
                          <option>O</option>
                          @elseif($data->emp_blood_grp == 'B')
                          <option>-</option>
                          <option>A</option>
                          <option selected>B</option>
                          <option>AB</option>
                          <option>O</option>
                          @elseif($data->emp_blood_grp == 'AB')
                          <option>-</option>
                          <option>A</option>
                          <option>B</option>
                          <option selected>AB</option>
                          <option>O</option>
                          @elseif($data->emp_blood_grp == 'O')
                          <option>-</option>
                          <option>A</option>
                          <option>B</option>
                          <option >AB</option>
                          <option selected>O</option>
                          @else
                          <option selected>-</option>
                          <option>A</option>
                          <option>B</option>
                          <option>AB</option>
                          <option >O</option>
                          @endif
                        </select>
                      </div>
                      <!-- /.form-group -->

                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Hobbies </label>
                        <input type="text" class="form-control float-right requested" value="{{$data->emp_hobbies}}" name="emp_hobbies">
                      </div>
                      <!-- /.form-group -->

                    </div>
                  </div>
                  <div class="card-footer ">
                    <div class="row">
                      <div class="col-md-12 text-center">
                        <button class="btn btn-info btn-round save-data-personal">{{ __('Save Changes') }}</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>

            </div>

            <div class="tab-pane" id="history" role="tabpanel" aria-labelledby="history-tab">
              <div class="card-header">
                <h5 class="title">{{ __('Contact Details') }}</h5>
              </div>
              <div class="card-body">
                <form id="ajaxform">
                  <meta name="csrf-token" content="{{ csrf_token() }}" />
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Address 1</label>
                        <textarea class="form-control" name="address1">{{$contact->address1}}</textarea>
                      </div>
                      <!-- /.form-group -->

                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Address 2</label>
                        <textarea class="form-control" name="address2">{{$contact->address2}}</textarea>
                      </div>
                      <!-- /.form-group -->

                    </div>
                    <!-- /.col -->
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control float-right" name="city" value="{{$contact->city}}">
                      </div>
                      <!-- /.form-group -->

                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">

                      <div class="form-group">
                        <label>Province</label>
                        <input type="text" class="form-control float-right" name="province" value="{{$contact->province}}">
                      </div>

                    </div>
                    <!-- /.col -->
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Zipcode</label>
                        <input type="text" class="form-control float-right" name="zipcode" value="{{$contact->zipcode}}">
                      </div>
                      <!-- /.form-group -->

                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Phone Number</label>

                        <input type="text" class="form-control contact" name="hp" value="{{$contact->hp}}">

                      </div>


                      <!-- /.form-group -->

                    </div>
                    <!-- /.col -->
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Whatsapp Number</label>

                        <input type="text" class="form-control contact" name="wa" value="{{$contact->wa}}">

                      </div>
                      <!-- /.form-group -->

                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Home Number</label>
                        <input type="text" class="form-control contact" name="home_tlp" value="{{$contact->home_tlp}}">

                      </div>
                      <!-- /.form-group -->

                    </div>


                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email</label>

                        <input type="text" class="form-control contact" name="email" value="{{$contact->email}}">

                      </div>
                      <!-- /.form-group -->

                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Work Email</label>
                        <input type="text" class="form-control float-right requested" value="{{$contact->work_email}}" name="work_email">
                      </div>
                      <!-- /.form-group -->

                    </div>

                  </div>
              </div>

              <h6> Emergency Contact </h6>



              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Emergency Contact Name</label>
                    <input type="text" class="form-control float-right" name="emc_contact_name" value="{{$contact->emc_contact_name}}">
                  </div>
                  <!-- /.form-group -->

                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Emergency Contact Phone</label>
                    <input type="text" class="form-control float-right" name="emc_contact_phone" value="{{$contact->emc_contact_phone}}">
                  </div>
                  <!-- /.form-group -->

                </div>
                <!-- /.col -->
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Relationship</label>
                    <input type="text" class="form-control float-right" name="relationship" value="{{$contact->relationship}}">
                  </div>
                  <!-- /.form-group -->

                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">

                </div>
                <!-- /.col -->
              </div>

              <div class="card-footer ">
                <div class="row">
                  <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-info btn-round save-data-contact">{{ __('Save Changes') }}</button>
                  </div>
                </div>
              </div>
              </form>

            </div>

            <div class="tab-pane" id="deals" role="tabpanel" aria-labelledby="deals-tab">
              <div class="card-header">
                <h5 class="title">{{ __('Job Details') }}</h5>
              </div>
              <div class="card-body">
                <form id="ajaxform">
                  <meta name="csrf-token" content="{{ csrf_token() }}" />

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Joined Date</label>
                        <input type="date" class="form-control float-right" name="emp_join_date" value="{{$data->emp_join_date}}">
                      </div>
                      <!-- /.form-group -->

                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label> Date of Permanency </label>
                        <input type="date" class="form-control float-right requested" value="{{$data->emp_date_permanency}}" name="emp_date_permanency">
                      </div>
                      <!-- /.form-group -->

                    </div>


                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Job Title</label>
                        <select class="form-control select2" style="width: 100%;" name="emp_job_title">
                          @foreach ($jobtitle as $get)
                          @if( $get->id == $data->emp_job_title)
                          <option value="{{ $get->id }}" selected="">{{$get->job_title}}</option>
                          @else
                          <option value="{{ $get->id }}">{{$get->job_title}}</option>
                          @endif
                          @endforeach
                        </select>
                      </div>
                      <!-- /.form-group -->

                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Employee Status </label>
                        <select class="form-control select2" style="width: 100%;" name="emp_status">
                          @foreach ($employeestatus as $get)
                          @if( $get->id == $data->emp_status)
                          <option value="{{ $get->id }}" selected="">{{$get->name}}</option>
                          @else
                          <option value="{{ $get->id }}">{{$get->name}}</option>
                          @endif
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
                        <select class="form-control select2" style="width: 100%;" name="emp_job_ctg">
                          @foreach ($jobcategory as $get)
                          @if( $get->id == $data->emp_job_ctg)
                          <option value="{{ $get->id }}" selected="">{{$get->name}}</option>
                          @else
                          <option value="{{ $get->id }}">{{$get->name}}</option>
                          @endif
                          @endforeach
                        </select>
                      </div>
                      <!-- /.form-group -->

                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Location</label>
                        <select class="form-control select2" style="width: 100%;" name="emp_location">
                          @foreach ($location as $loc)
                          @if( $loc->id == $data->emp_location)
                          <option value="{{$loc->id}}" selected>{{$loc->name}} - {{$loc->city}}</option>
                          @else
                          <option value="{{$loc->id}}">{{$loc->name}} - {{$loc->city}}</option>
                          @endif
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
                        <input type="text" class="form-control float-right" value="{{$data->bpjs_kej}}" name="bpjs_kej">
                      </div>
                      <!-- /.form-group -->

                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>BPJS Kesehatan</label>
                        <input type="text" class="form-control float-right" value="{{$data->bpjs_kes}}" name="bpjs_kes">
                      </div>
                      <!-- /.form-group -->

                    </div>


                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Work Shift</label>
                        <select class="form-control select2" style="width: 100%;" name="emp_work_shift">
                          @foreach ($workshift as $shift)
                          @if( $shift->id == $data->emp_work_shift)
                          <option value="{{$shift->id}}" selected="">{{$shift->name}} ({{$shift->from_hour}}-{{$shift->to_hour}})</option>
                          @else
                          <option value="{{$shift->id}}">{{$shift->name}} ({{$shift->from_hour}}-{{$shift->to_hour}})</option>
                          @endif
                          @endforeach
                        </select>
                      </div>
                      <!-- /.form-group -->

                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Effective From </label>
                        <input type="date" class="form-control float-right" value="{{$data->emp_effective_date}}" name="emp_effective_date">
                      </div>
                      <!-- /.form-group -->

                    </div>


                  </div>
             <div class="row">
             <div class="col-md-6">
                  <div class="form-group">
                    <label>Is Supervisor</label>
                    <select class="form-control" style="width: 100%;" name="is_supervisor">
                    @if ($data->is_supervisor == '0')
                      <option value="0" data="1">-</option>
                      <option value="1" data="0">Yes</option>
                      <option value="0" selected data="1">No</option>
                      @elseif($data->is_supervisor == '1')
                      <option value="0" data="1">-</option>
                      <option value="1" selected data="0">Yes</option>
                      <option value="0"  data="1">No</option>
                      @endif
                    </select>
                  </div>
                  <!-- /.form-group -->

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Supervisor</label>
                    <select class="form-control select2" id="supervisor" style="width: 100%;" name="emp_supervisor_id">

                    @if ($data->is_supervisor == '0')
                   
                      @foreach ($supervisor as $super)
                          @if( $super->id == $data->emp_supervisor_id)
                          <option selected value="{{$super->id}}">{{$super->first_name}} {{$super->middle_name}} {{$super->last_name}}</option>
                          @else
                          <option value="{{$super->id}}">{{$super->first_name}} {{$super->middle_name}} {{$super->last_name}}</option>
                          @endif
                          @endforeach
                      @elseif($data->is_supervisor == '1')
                      <option selected value="0">-</option>
                      @foreach ($supervisor as $super)
                          @if( $super->id == $data->emp_supervisor_id)
                          <option  value="{{$super->id}}">{{$super->first_name}} {{$super->middle_name}} {{$super->last_name}}</option>
                          @else
                          <option value="{{$super->id}}">{{$super->first_name}} {{$super->middle_name}} {{$super->last_name}}</option>
                          @endif
                          @endforeach
                      @endif
               
                     
                      
                    </select>
                  </div>
                  <!-- /.form-group -->

                </div>
             </div>

              </div>

              <div class="card-header">
                <h6> Employment Contract </h6>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Start Date</label>
                      <input type="date" class="form-control float-right" value="{{$data->emp_contract_start}}" name="emp_contract_start">
                    </div>
                    <!-- /.form-group -->

                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>End Date </label>
                      <input type="date" class="form-control float-right" value="{{$data->emp_contract_end}}" name="emp_contract_end">
                    </div>
                    <!-- /.form-group -->

                  </div>


                </div>
              </div>
              <div class="card-footer ">
                <div class="row">
                  <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-info btn-round save-data-job">{{ __('Save Changes') }}</button>
                  </div>
                </div>
              </div>
              </form>
            </div>
            <div class="tab-pane" id="qualification" role="tabpanel" aria-labelledby="deals-tab">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Work Experience</h5>
                  <h5 class="card-title text-right"> <a data-toggle="modal" data-target="#form" title="Add User!"><i class="nc-icon nc-simple-add"></i>Add</a> </h5>
                </div>

                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" id="tableExp">
                      <thead>
                        <tr>
                          <th> Company </th>

                          <th>Job Title</th>
                          <th>From</th>
                          <th>To</th>
                          <th></th>


                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Education</h5>
                  <h5 class="card-title text-right"> <a data-toggle="modal" data-target="#form2" title="Add User!"><i class="nc-icon nc-simple-add"></i>Add</a> </h5>
                </div>

                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" id="tableEdu">
                      <thead>
                        <tr>
                          <th> Level </th>
                          <th> School/University </th>
                          <th> Major </th>

                          <th>Year</th>
                          <th>GPA/Score</th>
                          <th></th>


                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Skill</h5>
                  <h5 class="card-title text-right"> <a data-toggle="modal" data-target="#form3" title="Add User!"><i class="nc-icon nc-simple-add"></i>Add</a> </h5>
                </div>

                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" id="tableSkill">
                      <thead>
                        <tr>
                          <th> Skill </th>

                          <th>Descriptions</th>
                          <th></th>


                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="family" role="tabpanel" aria-labelledby="deals-tab">
              <div class="card">
                <div class="card-header">
                <h5 class="title">{{ __('Family Member') }}</h5>
                  <h5 class="card-title text-right"> <a data-toggle="modal" data-target="#formFam" title="Add User!"><i class="nc-icon nc-simple-add"></i>Add</a> </h5>
                </div>

                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" id="tableFam">
                      <thead>
                        <tr>
                          <th> Name </th>

                          <th>Relationship</th>
                        
                          <th></th>


                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>

     

            </div>
            <div class="tab-pane" id="account" role="tabpanel" aria-labelledby="deals-tab">
              <div class="card">
                <div class="card-header">
                <h5 class="title">{{ __('Account Details') }}</h5>
                  <h5 class="card-title text-right"> <a data-toggle="modal" data-target="#formAcc" title="Add User!"><i class="nc-icon nc-simple-add"></i>Add</a> </h5>
                </div>

                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" id="tableAcc">
                      <thead>
                        <tr>
                          <th> Bank Name </th>
                          <th>Account Number</th>
                          <th>In Name</th>
                        
                          <th></th>


                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>

     

            </div>
          </div>
        </div>
      </div>



    </div>
  </div>
</div>
<div class="modal fade" id="formAcc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Add Bank Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="ajaxform">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">


          <div class="form-group">
            <label for="email1">Bank Name</label>
            <input type="text" class="form-control " name="bank_name">

          </div>


          <div class="form-group">
            <label for="email1">Account Number</label>
            <input type="text" class="form-control " name="account_number">

          </div>
          <div class="form-group">
            <label for="email1">In The Name</label>
            <input type="text" class="form-control " name="in_name">

          </div>

          
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button class="btn btn-success save-data-acc" data-dismiss="modal" id="btnupdate">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="formFam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Add Family Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="ajaxform">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">


          <div class="form-group">
            <label for="email1">Name</label>
            <input type="text" class="form-control " name="fam_name">

          </div>


          <div class="form-group">
            <label for="email1">Relationship</label>
            <input type="text" class="form-control " name="fam_relation">

          </div>

          
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button class="btn btn-success save-data-fam" data-dismiss="modal" id="btnupdate">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Add Work Experience</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="ajaxform">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">


          <div class="form-group">
            <label for="email1">Company</label>
            <input type="text" class="form-control " name="company_exp">

          </div>


          <div class="form-group">
            <label for="email1">Job Title</label>
            <input type="text" class="form-control " name="job_title_exp">

          </div>

          <div class="form-group">
            <label for="email1">From</label>
            <input type="date" class="form-control " name="from_date_exp">

          </div>
          <div class="form-group">
            <label for="email1">To</label>
            <input type="date" class="form-control " name="to_date_exp">

          </div>
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button class="btn btn-success save-data-exp" data-dismiss="modal" id="btnupdate">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="form2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Add Education</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="ajaxform">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">


          <div class="form-group">
            <label for="email1">Level</label>
            <select class="form-control select2" id="level" name="level" style="width: 100%;">
              @foreach ($education as $get)
              <option value="{{$get->name}}">{{$get->name}}</option>
              @endforeach
            </select>

          </div>


          <div class="form-group">
            <label for="email1">School/University</label>
            <input type="text" class="form-control " id="school" name="school">

          </div>
          <div class="form-group">
            <label for="email1">Majors</label>
            <input type="text" class="form-control " id="major" name="major">

          </div>
          <div class="form-group">
            <label for="email1">Year</label>
            <input type="text" class="form-control " id="year" name="year">

          </div>

          <div class="form-group">
            <label for="email1">GPA/Score</label>
            <input type="text" class="form-control " id="gpa" name="gpa">

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
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Add Skill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="ajaxform">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">


          <div class="form-group">
            <label for="email1">Skill</label>
            <select class="form-control select2" id="skill" name="skill" style="width: 100%;">
              @foreach ($skill as $get)
              <option value="{{$get->id}}">{{$get->name}} || {{$get->desc_skill}}</option>
              @endforeach
            </select>

          </div>

        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button class="btn btn-success save-data-skill" data-dismiss="modal" id="btnupdate">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!-- <script src="{{asset('js/emp.js')}}"></script> -->
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>

let id_emp = $("input[name=id_employee]").val();
  $('#bologna-list a').on('click', function(e) {
    e.preventDefault()
    $(this).tab('show')
  });

  loadExp();
  loadEdu();
  loadSkill();
  loadFam();
  loadAcc();

  function refreshdata() {
    // $('#name').val('');
    // $('#desc_skill').val('');
    $('#tableExp').DataTable().clear().destroy();
    $('#tableEdu').DataTable().clear().destroy();
    $('#tableSkill').DataTable().clear().destroy();
    $('#tableFam').DataTable().clear().destroy();
    $('#tableAcc').DataTable().clear().destroy();
    loadExp();
    loadEdu();
    loadSkill();
    loadFam();
    loadAcc();
  }

  function closing() {
    $('#form').modal('hide');
  }

  function loadExp() {
    $('#tableExp').DataTable({
      processing: true,
      serverSide: true,
      scrollY: 150,
      paging: false,
      searching: false,
      info: false,

      dom: 'Bfrtip',

      ajax: "{{ URL::to('pim/data-employeeexp') }}/" + id_emp,
      columns: [{
          data: 'company',
          name: 'company'
        },
        {
          data: 'job_title',
          name: 'job_title'
        },
        {
          data: 'from_date',
          name: 'from_date'
        },
        {
          data: 'to_date',
          name: 'to_date'
        },
        {
          data: 'action',
          name: 'action'
        },

      ]
    });
  }

  function loadEdu() {
    $('#tableEdu').DataTable({
      processing: true,
      serverSide: true,
      scrollY: 150,
      paging: false,
      searching: false,
      info: false,

      dom: 'Bfrtip',

      ajax: "{{ URL::to('pim/data-employeeedu') }}/" + id_emp,
      columns: [{
          data: 'level',
          name: 'level'
        },
        {
          data: 'school',
          name: 'school'
        },
        {
          data: 'major',
          name: 'major'
        },
        {
          data: 'year',
          name: 'year'
        },
        {
          data: 'gpa',
          name: 'gpa'
        },
        {
          data: 'action',
          name: 'action'
        },

      ]
    });
  }

  function loadSkill() {
    $('#tableSkill').DataTable({
      processing: true,
      serverSide: true,
      scrollY: 150,
      paging: false,
      searching: false,
      info: false,

      dom: 'Bfrtip',

      ajax: "{{ URL::to('pim/data-employeeskill') }}/" + id_emp,
      columns: [{
          data: 'skill',
          name: 'skill'
        },
        {
          data: 'desc',
          name: 'desc'
        },
        {
          data: 'action',
          name: 'action'
        },

      ]
    });
  }
  function loadFam() {
    $('#tableFam').DataTable({
      processing: true,
      serverSide: true,
      scrollY: 150,
      paging: false,
      searching: false,
      info: false,

      dom: 'Bfrtip',

      ajax: "{{ URL::to('pim/data-employeefam') }}/" + id_emp,
      columns: [{
          data: 'name',
          name: 'name'
        },
        {
          data: 'relationship',
          name: 'relationship'
        },
        {
          data: 'action',
          name: 'action'
        },

      ]
    });
  }

  function loadAcc() {
    $('#tableAcc').DataTable({
      processing: true,
      serverSide: true,
      scrollY: 150,
      paging: false,
      searching: false,
      info: false,

      dom: 'Bfrtip',

      ajax: "{{ URL::to('pim/data-employeeacc') }}/" + id_emp,
      columns: [
        {
          data: 'bank_name',
          name: 'bank_name'
        },
        {
          data: 'account_number',
          name: 'account_number'
        },

        {
          data: 'in_name',
          name: 'in_name'
        },

        {
          data: 'action',
          name: 'action'
        },

      ]
    });
  }

  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2({

    })
  })
  $(".save-data-exp").click(function(event) {
    event.preventDefault();

    let company = $("input[name=company_exp]").val();
    let job_title = $("input[name=job_title_exp]").val();
    let from_date = $("input[name=from_date_exp]").val();
    let to_date = $("input[name=to_date_exp]").val();

    let _token = $('meta[name="csrf-token"]').attr('content');
    console.log(name)

    $.ajax({
      url: "{{ route('save_employeeexp') }}",
      type: "POST",
      data: {
        emp_id: id_emp,
        company: company,
        job_title: job_title,
        from_date: from_date,
        to_date: to_date,
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
  $(".save-data-edu").click(function(event) {
    event.preventDefault();

    let level = $("select[name=level]").val();
    let school = $("input[name=school]").val();
    let major = $("input[name=major]").val();
    let year = $("input[name=year]").val();
    let gpa = $("input[name=gpa]").val();


    let _token = $('meta[name="csrf-token"]').attr('content');
    console.log(name)

    $.ajax({
      url: "{{ route('save_employeeedu') }}",
      type: "POST",
      data: {
        emp_id: id_emp,
        level: level,
        school: school,
        major: major,
        year: year,
        gpa: gpa,
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
  $(".save-data-skill").click(function(event) {
    event.preventDefault();

    let skill = $("select[name=skill]").val();
    let _token = $('meta[name="csrf-token"]').attr('content');
    console.log(name)

    $.ajax({
      url: "{{ route('save_employeeskill') }}",
      type: "POST",
      data: {
        emp_id: id_emp,
        skill: skill,
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
  $(".save-data-acc").click(function(event) {
    event.preventDefault();

    let bank_name = $("input[name=bank_name]").val();
    let account_number = $("input[name=account_number]").val();
    let in_name = $("input[name=in_name]").val();
    let _token = $('meta[name="csrf-token"]').attr('content');
    console.log(name)

    $.ajax({
      url: "{{ route('save_employeeacc') }}",
      type: "POST",
      data: {
        emp_id: id_emp,
        bank_name: bank_name,
        account_number: account_number,
        in_name: in_name,
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

  $(".save-data-fam").click(function(event) {
    event.preventDefault();

    let name = $("input[name=fam_name]").val();
    let relationship = $("input[name=fam_relation]").val();
    let _token = $('meta[name="csrf-token"]').attr('content');
    console.log(name)

    $.ajax({
      url: "{{ route('save_employeefam') }}",
      type: "POST",
      data: {
        emp_id: id_emp,
        name: name,
        relationship: relationship,
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
  $(".save-data-personal").click(function(event) {
    event.preventDefault();
    let emp_num = $("input[name=emp_num]").val();
    let first_name = $("input[name=first_name]").val();
    let middle_name = $("input[name=middle_name]").val();
    let last_name = $("input[name=last_name]").val();
    let emp_other_id = $("input[name=emp_other_id]").val();
    let emp_birth = $("input[name=emp_birth]").val();
    let emp_place_birth = $("input[name=emp_place_birth]").val();
    let emp_marital = $("select[name=emp_marital]").val();
    let emp_gender = $("select[name=emp_gender]").val();
    let emp_nationality = $("select[name=emp_nationality]").val();
    let emp_drive_license = $("input[name=emp_drive_license]").val();
    let emp_blood_grp = $("select[name=emp_blood_grp]").val();
    let emp_hobbies = $("input[name=emp_hobbies]").val();
    let _token = $('meta[name="csrf-token"]').attr('content');
    console.log(name)

    $.ajax({
      url: "{{ route('update_personal') }}",
      type: "POST",
      data: {
        emp_num:emp_num,
        id: id_emp,
        first_name: first_name,
        last_name: last_name,
        middle_name: middle_name,
        emp_other_id: emp_other_id,
        emp_birth: emp_birth,
        emp_place_birth: emp_place_birth,
        emp_marital: emp_marital,
        emp_gender: emp_gender,
        emp_nationality: emp_nationality,
        emp_drive_license: emp_drive_license,
        emp_blood_grp: emp_blood_grp,
        emp_hobbies: emp_hobbies,
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
    location.reload();

  });
  $(".save-data-job").click(function(event) {
    event.preventDefault();

    let emp_join_date = $("input[name=emp_join_date]").val();
    let emp_date_permanency = $("input[name=emp_date_permanency]").val();
    let bpjs_kes = $("input[name=bpjs_kes]").val();
    let bpjs_kej = $("input[name=bpjs_kej]").val();
    let emp_job_title = $("select[name=emp_job_title]").val();
    let emp_status = $("select[name=emp_status]").val();
    let emp_job_ctg = $("select[name=emp_job_ctg]").val();
    let emp_sub_unit = $("select[name=emp_sub_unit]").val();
    let emp_work_shift = $("select[name=emp_work_shift]").val();
    let emp_effective_date = $("input[name=emp_effective_date]").val();
    let emp_contract_start = $("input[name=emp_contract_start]").val();
    let emp_contract_end = $("input[name=emp_contract_end]").val();
    let emp_location = $("select[name=emp_location]").val();
    let is_supervisor = $("select[name=is_supervisor]").val();
    let emp_supervisor_id = $("select[name=emp_supervisor_id]").val();
    let _token = $('meta[name="csrf-token"]').attr('content');
    console.log(name)

    $.ajax({
      url: "{{ route('update_job') }}",
      type: "POST",
      data: {
        id: id_emp,
        emp_join_date: emp_join_date,
        emp_date_permanency: emp_date_permanency,
        emp_job_title: emp_job_title,
        emp_status: emp_status,
        emp_job_ctg: emp_job_ctg,
        emp_sub_unit: emp_sub_unit,
        bpjs_kes:bpjs_kes,
        bpjs_kej:bpjs_kej,
        emp_work_shift: emp_work_shift,
        emp_effective_date: emp_effective_date,
        emp_contract_start: emp_contract_start,
        emp_contract_end: emp_contract_end,
        emp_location: emp_location,
        is_supervisor:is_supervisor,
        emp_supervisor_id:emp_supervisor_id,
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
    location.reload();

  });
  $(".save-data-contact").click(function(event) {
    event.preventDefault();

    let address1 = $("textarea[name=address1]").val();
    let address2 = $("textarea[name=address2]").val();
    let city = $("input[name=city]").val();
    let province = $("input[name=province]").val();
    let zipcode = $("input[name=zipcode]").val();
    let hp = $("input[name=hp]").val();
    let wa = $("input[name=wa]").val();
    let home_tlp = $("input[name=home_tlp]").val();
    let email = $("input[name=email]").val();
    let work_email = $("input[name=work_email]").val();
    let emc_contact_name = $("input[name=emc_contact_name]").val();
    let emc_contact_phone = $("input[name=emc_contact_phone]").val();
    let relationship = $("input[name=relationship]").val();
    let _token = $('meta[name="csrf-token"]').attr('content');
    console.log(name)

    $.ajax({
      url: "{{ route('save_employeecontact') }}",
      type: "POST",
      data: {
        id: id_emp,
        address1: address1,
        address2: address2,
        city: city,
        province: province,
        zipcode: zipcode,
        hp: hp,
        wa: wa,
        home_tlp: home_tlp,
        email: email,
        work_email: work_email,
        emc_contact_name: emc_contact_name,
        emc_contact_phone: emc_contact_phone,
        relationship: relationship,
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
    location.reload();

  });
  $(".save-data-img").click(function(event) {
    event.preventDefault();

    let emp_pic_new = $("input[name=emp_pic_new]").val();
    let emp_pic = $("input[name=emp_pic]").val();
    let _token = $('meta[name="csrf-token"]').attr('content');

    console.log(emp_pic_new)
    $.ajax({
      url: "{{ route('update_img') }}",
      enctype: 'multipart/form-data',
      type: "POST",
      data: {
        id: id_emp,
        emp_pic_new: emp_pic_new,
        emp_pic: emp_pic,
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



  });

  function delExp($id) {
    var id = $id;
    confirm("Are you sure delete this ?");
    $.ajax({
      url: "{{ URL::to('pim/del-employeeexp') }}/" + id,
      type: "get",
    });
    refreshdata();
  }

  function delEdu($id) {
    var id = $id;
    confirm("Are you sure delete this ?");
    $.ajax({
      url: "{{ URL::to('pim/del-employeeedu') }}/" + id,
      type: "get",
    });
    refreshdata();
  }

  function delSkill($id) {
    var id = $id;
    console.log(id);
    confirm("Are you sure delete this ?");
    $.ajax({
      url: "{{ URL::to('pim/del-employeeskill') }}/" + id,
      type: "get",
    });
    refreshdata();
  }
  function delFam($id) {
    var id = $id;
    console.log(id);
    confirm("Are you sure delete this ?");
    $.ajax({
      url: "{{ URL::to('pim/del-employeefam') }}/" + id,
      type: "get",
    });
    refreshdata();
  }
  function delAcc($id) {
    var id = $id;
    console.log(id);
    confirm("Are you sure delete this ?");
    $.ajax({
      url: "{{ URL::to('pim/del-employeeacc') }}/" + id,
      type: "get",
    });
    refreshdata();
  }

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

  function initImageUpload(box) {
    let uploadField = box.querySelector(".image-upload");

    uploadField.addEventListener("change", getFile);

    function getFile(e) {
      let file = e.currentTarget.files[0];
      checkType(file);
    }

    function previewImage(file) {
      let thumb = box.querySelector(".js--image-preview"),
        reader = new FileReader();

      reader.onload = function() {
        thumb.style.backgroundImage = "url(" + reader.result + ")";
      };
      reader.readAsDataURL(file);
      thumb.className += " js--no-default";
    }

    function checkType(file) {
      let imageType = /image.*/;
      if (!file.type.match(imageType)) {
        throw "Datei ist kein Bild";
      } else if (!file) {
        throw "Kein Bild gewählt";
      } else {
        previewImage(file);
      }
    }
  }

  // initialize box-scope
  var boxes = document.querySelectorAll(".box");

  for (let i = 0; i < boxes.length; i++) {
    let box = boxes[i];
    initDropEffect(box);
    initImageUpload(box);
  }

  /// drop-effect
  function initDropEffect(box) {
    let area,
      drop,
      areaWidth,
      areaHeight,
      maxDistance,
      dropWidth,
      dropHeight,
      x,
      y;

    // get clickable area for drop effect
    area = box.querySelector(".js--image-preview");
    area.addEventListener("click", fireRipple);

    function fireRipple(e) {
      area = e.currentTarget;
      // create drop
      if (!drop) {
        drop = document.createElement("span");
        drop.className = "drop";
        this.appendChild(drop);
      }
      // reset animate class
      drop.className = "drop";

      // calculate dimensions of area (longest side)
      areaWidth = getComputedStyle(this, null).getPropertyValue("width");
      areaHeight = getComputedStyle(this, null).getPropertyValue("height");
      maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

      // set drop dimensions to fill area
      drop.style.width = maxDistance + "px";
      drop.style.height = maxDistance + "px";

      // calculate dimensions of drop
      dropWidth = getComputedStyle(this, null).getPropertyValue("width");
      dropHeight = getComputedStyle(this, null).getPropertyValue("height");

      // calculate relative coordinates of click
      // logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
      x = e.pageX - this.offsetLeft - parseInt(dropWidth, 10) / 2;
      y = e.pageY - this.offsetTop - parseInt(dropHeight, 10) / 2 - 30;

      // position drop and animate
      drop.style.top = y + "px";
      drop.style.left = x + "px";
      drop.className += " animate";
      e.stopPropagation();
    }
  }
  $(function() {


})
</script>
@endpush