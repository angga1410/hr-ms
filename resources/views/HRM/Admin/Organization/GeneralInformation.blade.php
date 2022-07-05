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
                    
                        <img src="{{ asset('paper/img/gspelogo.png') }}" style="width: 100%;">
                   
                    <!-- <div class="card-body">
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
                    </div> -->
                    <div class="card-footer">
                        <hr>
                        <div class="button-container">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-6 ml-auto">
                                    <h5>{{ __('12') }}
                                        <br>
                                        <small>{{ __('Location') }}</small>
                                    </h5>
                                </div>
                                <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                                    <h5>{{ __('211') }}
                                        <br>
                                        <small>{{ __('Number of Employee') }}</small>
                                    </h5>
                                </div>
                                <!-- <div class="col-lg-3 mr-auto">
                                    <h5>{{ __('24,6$') }}
                                        <br>
                                        <small>{{ __('Spent') }}</small>
                                    </h5>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('About') }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled team-members">
                            <li>
                                <div class="row">
                                   
                                    <div class="col-md-9 col-9">
                                    <p class="description text-left">
                            {{ __('Established in 1996, GSPE has been a leading provider of power supply components to Indonesian telecommunication companies ranging from commercial to industrial products') }}
                        
                        </p>
                                    </div>
                                    <div class="col-md-3 col-3 text-right">
                                        <button class="btn btn-sm btn-outline-success btn-round btn-icon"><i
                                                class="fa fa-pencil"></i></button>
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
                            <h5 class="title">{{ __('General Information') }}</h5>
                        </div>
                        <div class="card-body">
                    
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Organization Name</label>
                <input type="text" class="form-control" name="org_name">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Tax ID</label>

                <input type="text" class="form-control" name="tax_id">

              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Number of Employee</label>

                <input type="text" class="form-control" name="number_emp">

              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Contact Phone</label>
                <input type="text" class="form-control float-right"  name="contact_phone">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Contact Tax</label>
                <input type="text" class="form-control float-right" name="contact_tax">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Contact Email</label>
                <input type="text" class="form-control float-right" name="contact_email">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          
            <!-- /.col -->
          </div>
 <hr>
   
                      
                    </div>
                </form>
                <form class="col-md-12" action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card">
                     
                        <div class="card-body">
                        <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>City</label>
                    <input type="text" class="form-control float-right" name="contact_city">
                  </div>
                  <!-- /.form-group -->

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label> Province </label>
                    <input type="text" class="form-control float-right" name="contact_prov">
                  </div>
                  <!-- /.form-group -->

                </div>


              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Country</label>
                    <input type="text" class="form-control float-right" name="contact_country">
                  </div>
                  <!-- /.form-group -->

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Zipcode</label>
                    <input type="text" class="form-control float-right" name="contact_zipcode">
                  </div>
                  <!-- /.form-group -->

                </div>


              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Address 1</label>
                    <textarea type="text" class="form-control float-right" name="contact_address1"></textarea>
                  </div>
                  <!-- /.form-group -->

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Address 2 </label>
                    <textarea type="text" class="form-control float-right" name="contact_address2"></textarea>
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