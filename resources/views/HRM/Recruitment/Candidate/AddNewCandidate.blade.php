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
        <h4> <i class="nc-icon nc-badge"></i> &nbsp&nbsp Add New Candidate </h4>

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
        <form action="{{ route('save_candidate') }}" method="post" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <div class="form-group row">
            <div class="col-md-2">
              <div class="form-group">
                <div class="box">
                  <div class="js--image-preview"></div>
                  <div class="upload-options">
                    <label>
                      <input type="file" class="image-upload form-control" accept="image/*" name="picture" />

                    </label>

                  </div>
                </div>
              </div>
            </div>


          </div>
          <small id="fileHelp" class="form-text text-muted"><i>*Please upload a valid image file. Size of image should not be more than 2MB.</i></small>
          <br>
          <br>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" name="first_name">
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
                <input type="text" class="form-control float-right requested" name="last_name">
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input class="form-control" style="width: 100%;" name="email">

              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Whatsapp Number </label>
                <input class="form-control" style="width: 100%;" name="contact_phone">

              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Facebook </label>
                <input class="form-control" style="width: 100%;" name="facebook">

              </div>
              <!-- /.form-group -->

            </div>

            <!-- /.col -->

            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Twitter/Instagram </label>
                <input class="form-control" style="width: 100%;" name="twitter">

              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Linkedin </label>
                <input class="form-control" style="width: 100%;" name="linkedin">

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
            <div class="col-md-6">
              <div class="form-group">
                <label>Job Vacancy</label>
                <select class="form-control select2" style="width: 100%;" name="vacancy_id">
                  <option>-</option>
                  @foreach ($vacancy as $nat)
                  <option value="{{$nat->id}}">{{$nat->vacancy_name}} - {{$nat->location->name}}</option>
                  @endforeach
                </select>
              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Date of Application</label>
                <input type="date" class="form-control" style="width: 100%;" name="date_apply">
              </div>
              <!-- /.form-group -->

            </div>

          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Comment</label>
                <input type="text" class="form-control" style="width: 100%;" name="note">
              </div>
              <!-- /.form-group -->

            </div>
            <div class="col-md-6">

              <label>Resume</label>
              <br>
              <input type="file" max-file-size="2048" accept=".pdf" name="attachment">
              <small id="fileHelp" class="form-text text-muted"><i>*Please upload a valid PDF file. Size of image should not be more than 2MB.</i></small>

              <!-- /.form-group -->

            </div>

          </div>

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

<script src="{{asset('js/select2.min.js')}}"></script>
<script src="{{asset('js/imgupload.js')}}"></script>
<script>
  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2({

    })
  })
</script>
@endpush