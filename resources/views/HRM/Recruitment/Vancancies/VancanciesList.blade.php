@extends('layouts.app', [
'class' => '',
'elementActive' => 'recruitment'
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
                <h5 class="modal-title" id="exampleModalLabel">Create Vacancy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="ajaxform">
                <meta name="csrf-token" content="{{ csrf_token() }}" />
                <div class="modal-body">


                    <div class="form-group">
                        <label for="email1">Vacancy Name</label>
                        <input type="email" class="form-control" id="name" name="vacancy_name">

                    </div>
                    <div class="form-group">
                        <label for="email1">Departement</label>
                        <select class="form-control select2 document_no" style="width: 100%;" name="sub_unit_id">
                            <option>-</option>
                            @foreach ($jobcategory as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="email1">Job Title</label>
                        <select class="form-control select2 document_no" style="width: 100%;" name="job_title_id">
                            <option>-</option>
                            @foreach ($jobtitle as $title)
                            <option value="{{$title->id}}">{{$title->job_title}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="email1">Location</label>
                        <select class="form-control select2 document_no" style="width: 100%;" name="location_id">
                            <option>-</option>
                            @foreach ($location as $loc)
                            <option value="{{$loc->id}}">{{$loc->name}} - {{$loc->city}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="email1">Number of Position</label>
                        <input type="number" class="form-control" id="name" name="number_pos">

                    </div>
                    <div class="form-group">
                        <label for="email1">Hiring Manager</label>
                        <select class="form-control select2" style="width: 100%;" name="hiring_manager">
                            <option value="0">-</option>
                            @foreach ($emp as $super)
                            <option value="{{$super->id}}">{{$super->first_name}} {{$super->middle_name}} {{$super->last_name}}</option>
                            @endforeach
                        </select>

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
                    <h4 class="card-title">Vacancies List</h4>
                    <h4 class="card-title text-right"> <button class="btn btn-info" data-toggle="modal" data-target="#form" title="Add !"><i class="nc-icon nc-simple-add"></i></button> </h4>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="email1">Job Title</label>
                                <select class="form-control select2 document_no" style="width: 100%;" name="job_title_id">
                                    <option>All</option>
                                    @foreach ($jobtitle as $title)
                                    <option value="{{$title->id}}">{{$title->job_title}}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="password1">Location</label>

                                <select class="form-control select2 document_no" style="width: 100%;" name="location_id">
                                    <option>All</option>
                                    @foreach ($location as $loc)
                                    <option value="{{$loc->id}}">{{$loc->name}} - {{$loc->city}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="password1">Hiring Manager</label>

                                <select class="form-control select2" id="supervisor" style="width: 100%;" name="hiring_manager">
                                    <option value="0">All</option>
                                    @foreach ($emp as $super)
                                    <option value="{{$super->id}}">{{$super->first_name}} {{$super->middle_name}} {{$super->last_name}}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="password1">Status</label>
                                <select class="form-control select2" id="status">
                                    <option value="All">All</option>
                                    <option value="0">Active</option>
                                    <option value="1">Inactive</option>


                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-4">
                            <button class="btn btn-info" id="filter"><i class="nc-icon nc-zoom-split"></i> Search</button>
                            <button class="btn btn-success" id="refresh">Reset</button>
                        </div>
                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-4">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="container">

            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"></h4>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>Vacancy Name </th>
                                    <th>Job Title</th>
                                    <th>Departement</th>
                                    <th>Number of Position</th>
                                    <th>Hiring Manager</th>
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
            scrollY: 280,
            sScrollX: 80,
            "sScrollXInner": "100%",
            "bScrollCollapse": true,
            paging: false,
            oLanguage: {
                "sSearch": "Quick Search"
            },
            ajax: {
                url: "{{ route('vacancies_data') }}",
                //    data:{emp_id:emp_id, type:type , status:status , dept:dept , to:to , from:from}
            },
            columns: [{
                    data: 'vacancy_name',
                    name: 'vacancy_name'
                },
                {
                    data: 'job_title',
                    name: 'job_title'
                },
                {
                    data: 'departement',
                    name: 'departement'
                },

                {
                    data: 'number_pos',
                    name: 'number_pos'
                },
                {
                    data: 'emp_first',
                    name: 'emp_first',
                    render: function(data, type, row) {
                        return row.emp_first + '&nbsp' + row.emp_middle
                    }
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

        let vacancy_name = $("input[name=vacancy_name]").val();
        let job_title_id = $("select[name=job_title_id]").val();
        let location_id = $("select[name=location_id]").val();
        let sub_unit_id = $("select[name=sub_unit_id]").val();
        let number_pos = $("input[name=number_pos]").val();
        let hiring_manager = $("select[name=hiring_manager]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('save_vacancy') }}",
            type: "POST",
            data: {
                vacancy_name: vacancy_name,
                job_title_id: job_title_id,
                location_id: location_id,
                sub_unit_id: sub_unit_id,
                number_pos: number_pos,
                hiring_manager: hiring_manager,
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