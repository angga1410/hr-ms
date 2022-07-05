@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'admin'
])

@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-12">
            <div class="container">
 
</div>

<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Create User Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="ajaxform">
                <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-body">
        <div class="row">
        <div class="col-md-6">
        <div class="form-group">
                <label>Employee</label>
                <select class="form-control select2" style="width: 100%;" name="emp_id" >
            @foreach ($emp as $get)
                <option value="{{$get->id}}">{{$get->first_name}} {{$get->middle_name}} {{$get->last_name}}</option>
                @endforeach
            </select>
              </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="password1">Username</label>
            <input type="text" class="form-control" name="name" >
          </div>
        </div>
        </div>

        <!-- <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="email1">ESS Role</label>
            <input type="email" class="form-control" id="email1" aria-describedby="emailHelp" >
            
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="password1">Supervisor Role</label>
            <input type="text" class="form-control" id="password1" >
          </div>
        </div>
        </div> -->

        <!-- <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="email1">Admin Role</label>
            <input type="email" class="form-control" id="email1" aria-describedby="emailHelp" >
          
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="password1">Status</label>
            <input type="text" class="form-control" id="password1" >
          </div>
        </div>
        </div> -->

        <div class="row">
        <div class="col-md-6">
        <div class="form-group">
            <label for="password1">Email</label>
            <input type="text" class="form-control" name="email" >
          </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
            <label for="email1">Password</label>
            <input type="password" class="form-control" name="password">
            <small id="emailHelp" class="form-text text-muted"><i>*password must be at least 6 characters</i></small>
          </div>
        </div>
        </div>
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
        <button class="btn btn-secondary save-data" data-dismiss="modal" id="btnupdate">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> User List</h4><h4 class="card-title text-right">  <button class="btn btn-info" data-toggle="modal" data-target="#form" title="Add User!"><i class="nc-icon nc-simple-add"></i></button> </h4>
                    </div>
          
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table">
                                <thead class=" text-primary">
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                       Email
                                    </th>
                                    <th>
                                        Password
                                    </th>
                                    <!-- <th>
                                        Status
                                    </th>
                                    <th>
                                        Action
                                    </th> -->
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    load();
    function refreshdata(){
        $('#name').val('');
        $('#table').DataTable().clear().destroy();
        load();
    }
    function closing() {
        $('#form').modal('hide');
    }
     function load(){
            $('#table').DataTable({
               processing: true,
               serverSide: true,
               scrollY: 200,
               info:false,
            dom: 'Bfrtip',
    paging: false,
               ajax: "{{ route('data_user') }}",
               columns: [  
                { data: 'emp_first', name: 'emp_first', render: function(data,type,row){
                                        return row.emp_first+'&nbsp'+row.emp_middle+'&nbsp'+row.emp_last
                                     } },
               { data: 'email', name: 'email' },
               { data: 'password', name: 'password' },
              
             
                     ]
            });
         }
  
      $(function() {
    //Initialize Select2 Elements
    $('.select2').select2({

    })
  })
  $(".save-data").click(function(event) {
        event.preventDefault();

        let name = $("input[name=name]").val();
        let email = $("input[name=email]").val();
        let emp_id = $("select[name=emp_id]").val();
        let password = $("input[name=password]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('save_new_user') }}", 
            type: "POST",
            data: {
                name: name,
                email : email,
                emp_id: emp_id,
                password: password,
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

    function updatestatus(id) {
        $('#form2').modal('show');
        $("input[name=idstatus]").val(id);

    }
    $(".save-update").click(function(event) {
        event.preventDefault();

        let id = $("input[name=idstatus]").val();
        let status = $("select[name=updatedstatus]").val();

        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('update_jobcategory') }}",
            type: "POST",
            data: {
                id: id,
                status: status,
                _token: _token
            },
            success: function(response) {

                if (response) {
                    $('.success').text(response.success);
                    $("#ajaxform")[0].reset();
                }
            },
        });
        refreshdata()

    });
</script>
@endpush
