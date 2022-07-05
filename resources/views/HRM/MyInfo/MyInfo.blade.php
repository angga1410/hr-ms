@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content">
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
        <div class="row">
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="{{ asset('paper/img/damir-bosnjak.jpg') }}" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <a href="#">
                                <img class="avatar border-gray" src="{{ asset('paper/img/mike.jpg') }}" alt="...">

                                <h5 class="title">{{ __(auth()->user()->name)}}</h5>
                            </a>
                            <p class="description">
                            @ {{ __(auth()->user()->name)}}
                            </p>
                        </div>
                        <p class="description text-center">
                            {{ __('I like the way you work it') }}
                            <br> {{ __('No diggity') }}
                            <br> {{ __('I wanna bag it up') }}
                        </p>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="button-container">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-6 ml-auto">
                                    <h5>{{ __('12') }}
                                        <br>
                                        <small>{{ __('Files') }}</small>
                                    </h5>
                                </div>
                                <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                                    <h5>{{ __('2GB') }}
                                        <br>
                                        <small>{{ __('Used') }}</small>
                                    </h5>
                                </div>
                                <div class="col-lg-3 mr-auto">
                                    <h5>{{ __('24,6$') }}
                                        <br>
                                        <small>{{ __('Spent') }}</small>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                            <img src="{{ asset('paper/img/faces/ayo-ogunseinde-2.jpg') }}" alt="Circle Image"
                                                class="img-circle img-no-padding img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-7">
                                        {{ __('DJ Khaled') }}
                                        <br />
                                        <span class="text-muted">
                                            <small>{{ __('Offline') }}</small>
                                        </span>
                                    </div>
                                    <div class="col-md-3 col-3 text-right">
                                        <button class="btn btn-sm btn-outline-success btn-round btn-icon"><i
                                                class="fa fa-envelope"></i></button>
                                    </div>
                                </div>
                            </li>
                           
                        
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8 text-center">
                <form class="col-md-12" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('My Profile') }}</h5>
                        </div>
                        <div class="card-body">
                        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Employee#</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="DO Number" value="00111" name="do_num">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" name="do_num">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Middle Name</label>

                <input type="text" class="form-control" name="do_num">

              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control float-right requested" id="reservation" name="requested_by">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Location</label>
                <select class="form-control select2 document_no" style="width: 100%;" name="rfs_id">
                  <option>#</option>

                  <option></option>

                </select>
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Other ID</label>
                <input type="text" class="form-control float-right requested" id="reservation" name="requested_by">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Date of Birth </label>

                <input type="date" class="form-control contact" id="reservation">

              </div>


              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Meritial Status </label>
                <select class="form-control document_no" style="width: 100%;" name="rfs_id">
                  <option>#</option>

                  <option></option>

                </select>
              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Gender </label>
                <select class="form-control document_no" style="width: 100%;" name="rfs_id">
                  <option>#</option>

                  <option></option>

                </select>
              </div>
              <!-- /.form-group -->

            </div>

            <div class="form-group m-form__group" hidden>
              <label for="exampleInputEmail1">Reference No.</label>
              <input type="text" class="form-control m-input siteid" style="border: none;" required="true" name="site_id">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nationality</label>
                <select class="form-control select2 document_no" style="width: 100%;" name="rfs_id">
                  <option>#</option>

                  <option></option>

                </select>
              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Driver's License Number </label>
                <input type="text" class="form-control float-right requested" id="reservation" name="requested_by">
              </div>
              <!-- /.form-group -->

            </div>


          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Blood Group</label>
                <select class="form-control document_no" style="width: 100%;" name="rfs_id">
                  <option>#</option>

                  <option></option>

                </select>
              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Hobbies </label>
                <input type="text" class="form-control float-right requested" id="reservation" name="requested_by">
              </div>
              <!-- /.form-group -->

            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form class="col-md-12" action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('My Employment Details') }}</h5>
                        </div>
                        <div class="card-body">
                        <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Joined Date</label>
                    <input type="date" class="form-control float-right requested" id="reservation" name="requested_by">
                  </div>
                  <!-- /.form-group -->

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label> Date of Permanency </label>
                    <input type="date" class="form-control float-right requested" id="reservation" name="requested_by">
                  </div>
                  <!-- /.form-group -->

                </div>


              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Job Title</label>
                    <select class="form-control select2 document_no" style="width: 100%;" name="rfs_id">
                      <option>#</option>

                      <option></option>

                    </select>
                  </div>
                  <!-- /.form-group -->

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Employee Status </label>
                    <select class="form-control select2 document_no" style="width: 100%;" name="rfs_id">
                      <option>#</option>

                      <option></option>

                    </select>
                  </div>
                  <!-- /.form-group -->

                </div>


              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Job Category</label>
                    <select class="form-control select2 document_no" style="width: 100%;" name="rfs_id">
                      <option>#</option>

                      <option></option>

                    </select>
                  </div>
                  <!-- /.form-group -->

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Sub Unit </label>
                    <select class="form-control select2 document_no" style="width: 100%;" name="rfs_id">
                      <option>#</option>

                      <option></option>

                    </select>
                  </div>
                  <!-- /.form-group -->

                </div>


              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Work Shift</label>
                    <select class="form-control select2 document_no" style="width: 100%;" name="rfs_id">
                      <option>#</option>

                      <option></option>

                    </select>
                  </div>
                  <!-- /.form-group -->

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Effective From </label>
                    <input type="date" class="form-control float-right requested" id="reservation" name="requested_by">
                  </div>
                  <!-- /.form-group -->

                </div>


              </div>
                        </div>
                        <div class="card-footer ">
                         
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection