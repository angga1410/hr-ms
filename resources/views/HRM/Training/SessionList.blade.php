@extends('layouts.app', [
'class' => '',
'elementActive' => 'training'
])

@section('content')
<link rel="stylesheet" href='{{ asset("/css/jquery.dataTables.min.css") }}' type="text/css" />
<div class="modal fade" id="form2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Vacancies Status</h5>
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
                            <option value="1">Inactive</option>
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
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Create Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="ajaxform">
                <meta name="csrf-token" content="{{ csrf_token() }}" />
                <div class="modal-body">


                    <div class="form-group">
                        <label for="email1">Name</label>
                        <input type="email" class="form-control" id="name" name="name">

                    </div>
                    <div class="form-group">
                        <label for="email1">Course</label>
                        <select class="form-control select2 document_no" style="width: 100%;" name="course_id">
                            <option>-</option>
                            @foreach ($course as $title)
                            <option value="{{$title->id}}">{{$title->title}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="email1">Start Date</label>
                        <input type="date" class="form-control" id="name" name="start_date">
                    </div>

                    <div class="form-group">
                        <label for="email1">End Date</label>
                        <input type="date" class="form-control" id="name" name="end_date">

                    </div>
                    <div class="form-group">
                        <label for="email1">Location</label>
                        <input type="text" class="form-control" id="name" name="location">

                    </div>
                    <div class="form-group">
                        <label for="email1">Delivery Method</label>
                        <select class="form-control select2 document_no" style="width: 100%;" name="delivery_method">
                            <option>-</option>
                            <option>Room</option>
                            <option>Self-study</option>
                            <option>Zoom Meeting</option>
                            <option>Google Meet</option>
                            <option>Microsift Teams</option>
                            <option>Other</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="email1">Trainers</label>
                        <input type="text" class="form-control" id="name" name="trainers">

                    </div>
                    <div class="form-group">
                        <label for="email1">Description</label>
                        <textarea type="number" class="form-control" id="name" name="desc_session"></textarea>
                    </div>

                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button class="btn btn-success save-data" data-dismiss="modal" id="btnupdate">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="content">


    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Session List</h4>
                    <h4 class="card-title text-right"> <button class="btn btn-info" data-toggle="modal" data-target="#form" title="Add !"><i class="nc-icon nc-simple-add"></i></button> </h4>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>Name </th>
                                    <th>Course Title</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Delivery Method</th>
                                    <th>Location</th>
                                    <th>Trainers</th>
                                    <th>Description</th>
                                    <th>Status</th>
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
<link rel="stylesheet" href='{{ asset("/css/buttons.dataTables.min.css") }}' type="text/css" />

<script type="text/javascript" src='{{ asset("/js/dataTables.buttons.min.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/buttons.flash.min.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/jszip.min.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/pdfmake.min.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/vfs_fonts.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/buttons.html5.min.js") }}'></script>
<script type="text/javascript" src='{{ asset("/js/buttons.print.min.js") }}'></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2({
            minimumResultsForSearch: 2,
        })
    })
    load()

    function refreshdata() {

        $('#table').DataTable().clear().destroy();
        load();
    }

    function load(emp_id = '', type = '', status = '', dept = '', to = '', from = '') {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            scrollY: 480,
            sScrollX: 80,
            "sScrollXInner": "100%",
            "bScrollCollapse": true,
            paging: false,
            oLanguage: {
                "sSearch": "Quick Search"
            },
            ajax: {
                url: "{{ route('session_data') }}",
                //    data:{emp_id:emp_id, type:type , status:status , dept:dept , to:to , from:from}
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'course_id',
                    name: 'course_id'
                },
                {
                    data: 'start_date',
                    name: 'start_date'
                },
                {
                    data: 'end_date',
                    name: 'end_date'
                },
                {
                    data: 'delivery_method',
                    name: 'delivery_method'
                },
                {
                    data: 'location',
                    name: 'location'
                },

                {
                    data: 'trainers',
                    name: 'trainers'
                },
                {
                    data: 'desc_session',
                    name: 'desc_session'
                },
                {
                    data: 'status',
                    name: 'status'
                },



            ]
        });
    }

    $('#filter').click(function() {
        var emp_id = $('#emp_id').val();
        var type = $('#type').val();
        var status = $('#status').val();
        var dept = $('#dept').val();
        var to = $('#to').val();
        var from = $('#from').val();
        if (emp_id != '' && type != '' && status != '' && dept != '' && to != '' && from != '') {
            //    $('#price').DataTable().clear().destroy();
            load(emp_id, type, status, dept, to, from);
        } else {
            alert('Both Date is required');
        }
    });

    $('#refresh').click(function() {
        $('#emp_id').val('');
        $('#type').val('');
        $('#status').val('');
        $('#to').val('');
        $('#from').val('');
        $('#table').DataTable().clear().destroy();

    });

    $(".save-data").click(function(event) {
        event.preventDefault();

        let name = $("input[name=name]").val();
        let course_id = $("select[name=course_id]").val();
        let start_date = $("input[name=start_date]").val();
        let end_date = $("input[name=end_date]").val();
        let location = $("input[name=location]").val();
        let delivery_method = $("select[name=delivery_method]").val();
        let desc_session = $("textarea[name=desc_session]").val();
        let trainers = $("input[name=trainers]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('save_session') }}",
            type: "POST",
            data: {
                name: name,
                course_id: course_id,
                start_date: start_date,
                end_date: end_date,
                location: location,
                delivery_method: delivery_method,
                desc_session: desc_session,
                trainers: trainers,
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


    $(".save-update").click(function(event) {
        event.preventDefault();

        let id = $("input[name=idstatus]").val();
        let status = $("select[name=updatedstatus]").val();

        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('update_status') }}",
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


    function updatevacancies(id) {
        $('#form2').modal('show');
        $("input[name=idstatus]").val(id);

    }
</script>
@endpush