@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'admin'
])

@section('content')
<link rel="stylesheet" href='{{ asset("/css/jquery.dataTables.min.css") }}' type="text/css" />

    <div class="content">
        <div class="row">
            <div class="col-md-12">
            <div class="container">
 
</div>
<div class="modal fade" id="form2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Location Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="ajaxform">
                <meta name="csrf-token" content="{{ csrf_token() }}" />
                <div class="modal-body">


                    <div class="form-group">
                        <input type="hidden" name="idstatus">
                        <label for="email1">Status</label>
                        <select class="form-control select2" style="width: 100%;" name="updatedstatus">
                            <option value="0">Active</option>
                            <option value="1">Archived</option>
                        </select>

                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button class="btn btn-secondary save-update" data-dismiss="modal" id="btnupdate">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="form" tabindex="-1" role="dialog" name="form" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Create Location</h5>
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
            <label for="email1">Name</label>
            <input type="email" class="form-control" id="email1" name="name">
           
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="password1">Country</label>
            <select  class="form-control select2 " style="width: 100%;" name="country" >
                @foreach ($national as $data)
                <option value="{{$data->name}}">{{$data->code}}  {{$data->name}}</option>
                @endforeach
            </select>
          </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="email1">State/Province</label>
            <input type="email" class="form-control" id="email1" name="province" >
            
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="password1">City</label>
            <input type="text" class="form-control" name="city" >
          </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="email1">Zip/Postal Code</label>
            <input type="email" class="form-control" id="email1" name="zipcode" >
          
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="password1">Phone</label>
            <input type="text" class="form-control" name="phone" >
          </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="email1">Fax</label>
            <input type="email" class="form-control" name="fax" >
          
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="password1">Note</label>
            <input type="text" class="form-control" name="note" >
          </div>
        </div>
        </div>

       
        <div class="form-group">
            <label for="password1">Address</label>
            <textarea type="text" class="form-control" name="address" ></textarea>
          </div>
        </div>
       
        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button class="btn btn-success save-data"  data-dismiss="modal"  id="btnupdate">Submit</button>
        
        </div>
      </form>
    </div>
  </div>
</div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Location List</h4><h4 class="card-title text-right">  <button class="btn btn-info" data-toggle="modal" data-target="#form" title="Add User!"><i class="nc-icon nc-simple-add"></i></button> </h4>
                    </div>
          
                    <div class="card-body">
                        <div class="">
                            <table class="table" id="table">
                            <thead class="text-primary">
                                <tr>
                                <th>
                                        Name
                                    </th>
                                    <th>
                                        Country
                                    </th>
                                    <th>
                                       Province
                                    </th>
                                    <th>
                                       City
                                    </th>
                                    <th>
                                     Phone
                                    </th>
                                    <th>
                                     Status
                                    </th>

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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    load();
    function refreshdata(){
     
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
               ajax: "{{ route('data_location') }}",
               columns: [   {data :'name', name: 'name'},
               { data: 'country', name: 'country' },
               { data: 'province', name: 'province' },
               { data: 'city', name: 'city' },
               { data: 'phone', name: 'phone' },
               { data: 'status', name: 'status' },

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
        let country = $("select[name=country]").val();
        let province = $("input[name=province]").val();
        let city = $("input[name=city]").val();
        let zipcode = $("input[name=zipcode]").val();
        let phone = $("input[name=phone]").val();
        let fax = $("input[name=fax]").val();
        let number_emp = $("input[name=number_emp]").val();
        let address = $("textarea[name=address]").val();
        let note = $("input[name=note]").val();
     
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('save_location') }}", 
            type: "POST",
            data: {
                name: name,
                country: country,
                province: province,
                city: city,
                zipcode: zipcode,
                phone: phone,
                fax: fax,
                number_emp: number_emp,
                address: address,
                note:note,
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
            url: "{{ route('update_location') }}",
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
