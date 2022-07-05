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
                <h5 class="modal-title" id="exampleModalLabel">Course Status</h5>
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
                        <label for="email1">Title</label>
                        <input type="email" class="form-control" id="name" name="title">

                    </div>
                    <div class="form-group">
                        <label for="email1">Coordinator</label>
                        <select class="form-control select2 document_no" style="width: 100%;" name="coordinator_emp">
                            <option>-</option>
                            @foreach ($emp as $title)
                            <option value="{{$title->id}}">{{$title->first_name}} {{$title->middle_name}} {{$title->last_name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="email1">Departement</label>
                        <select class="form-control select2 document_no" style="width: 100%;" name="dept_id">
                            <option>-</option>
                            @foreach ($dept as $title)
                            <option value="{{$title->id}}">{{$title->name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="email1">Duration (Hour)</label>
                        <input type="number" step=".1" class="form-control" id="name" name="duration">

                    </div>
                    <div class="form-group">
                        <label for="email1">Organization</label>
                        <input class="form-control" id="name" name="org_course">

                    </div>
                    <div class="form-group">
                        <label for="email1">Description</label>
                        <textarea class="form-control" id="name" name="desc_course"></textarea>

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
                    <h4 class="card-title">Course List</h4>
                    <h4 class="card-title text-right"> <button class="btn btn-info" data-toggle="modal" data-target="#form" title="Add !"><i class="nc-icon nc-simple-add"></i></button> </h4>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>Course Title</th>
                                    <th>Description</th>
                                    <th>Coordinator</th>
                                    <th>Departement</th>
                                    <th>Duration</th>
                                    <th>Organization</th>
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
                url: "{{ route('course_data') }}",
                //    data:{emp_id:emp_id, type:type , status:status , dept:dept , to:to , from:from}
            },
            columns: [{
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'desc_course',
                    name: 'desc_course'
                },
                {
                    data: 'coordinator_emp_first',
                    name: 'coordinator_emp_first',
                    render: function(data, type, row) {
                        return row.coordinator_emp_first + '&nbsp' + row.coordinator_emp_middle + '&nbsp' + row.coordinator_emp_last
                    }
                },
                {
                    data: 'dept',
                    name: 'dept'
                },

                {
                    data: 'duration',
                    name: 'duration'
                },
                {
                    data: 'org_course',
                    name: 'org_course'
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

        let title = $("input[name=title]").val();
        let coordinator_emp = $("select[name=coordinator_emp]").val();
        let dept_id = $("select[name=dept_id]").val();
        let desc_course = $("textarea[name=desc_course]").val();
        let duration = $("input[name=duration]").val();
        let org_course = $("input[name=org_course]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('save_course') }}",
            type: "POST",
            data: {
                title: title,
                coordinator_emp: coordinator_emp,
                dept_id: dept_id,
                desc_course: desc_course,
                duration: duration,
                org_course: org_course,
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
            url: "{{ route('updateStatus_course') }}",
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