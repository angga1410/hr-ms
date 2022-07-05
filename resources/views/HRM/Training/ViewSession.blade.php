@extends('layouts.app', [
'class' => '',
'elementActive' => 'training'
])

@section('content')
<link rel="stylesheet" href='{{ asset("/css/jquery.dataTables.min.css") }}' type="text/css" />

<div class="content">
<div class="row">
</div>
    <div class="row">
        <div class="col-md-12">
        
<a href="{{url('/training/session-list')}}"><button class="btn btn-secondary">Back</button></a>
        <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Session Detail</h4>
                </div>


                <div class="card-body">
                   <div class="row">
                   <div class="col-sm-3">
                   <h6>Session Name</h6>
                   </div>
                   <div class="col-sm-3">
                   <p>: {{$session->name}}</p>
                   </div>
                   <div class="col-sm-3">
                   <h6>Trainer</h6>
                   </div>
                   <div class="col-sm-3">
                   <p>: {{$session->trainers}}</p>
                   </div>
                   </div>

                   <div class="row">
                   <div class="col-sm-3">
                   <h6>Scheduled Date</h6>
                   </div>
                   <div class="col-sm-3">
                   <p>: {{$session->start_date}}</p>
                   </div>
                   <div class="col-sm-3">
                   <h6>Submission Due Date</h6>
                   </div>
                   <div class="col-sm-3">
                   <p>: {{$session->end_date}}</p>
                   </div>
                   </div>

                   <div class="row">
                   <div class="col-sm-3">
                   <h6>Delivery Method</h6>
                   </div>
                   <div class="col-sm-3">
                   <p>: {{$session->delivery_method}}</p>
                   </div>
                   <div class="col-sm-3">
                   <h6>Location</h6>
                   </div>
                   <div class="col-sm-3"> 
                   <p>: {{$session->location}}</p>
                   </div>
                   </div>

                   <div class="row">
                   <div class="col-sm-3">
                   <h6>Description</h6>
                   </div>
                   <div class="col-sm-3">
                   <p>: {{$session->desc_session}}</p>
                   </div>
                   <div class="col-sm-3">
                   <h6>Status</h6>
                   </div>
                   <div class="col-sm-3"> 
                  <select>
                  <option>Scheduled</option>
                  </select>
                   </div>
                   </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Course Detail</h4>
                </div>


                <div class="card-body">
                   <div class="row">
                   <div class="col-sm-3">
                   <h6>Title</h6>
                   </div>
                   <div class="col-sm-3">
                   <p>: {{$session->course->title}}</p>
                   </div>
                   <div class="col-sm-3">
                   <h6>Departement</h6>
                   </div>
                   <div class="col-sm-3">
                   <p>: {{$session->course->dept->name}}</p>
                   </div>
                   </div>

                   <div class="row">
                   <div class="col-sm-3">
                   <h6>Duration</h6>
                   </div>
                   <div class="col-sm-3">
                   <p>: {{$session->course->duration}} H</p>
                   </div>
                   <div class="col-sm-3">
                   <h6>Coordinator</h6>
                   </div>
                   <div class="col-sm-3">
                   <p>: {{$session->course->emp->first_name}} {{$session->course->emp->middle_name}} {{$session->course->emp->last_name}}</p>
                   </div>
                   </div>

                   <div class="row">
                   <div class="col-sm-3">
                   <h6>Description</h6>
                   </div>
                   <div class="col-sm-3">
                   <p>: {{$session->course->desc_course}}</p>
                   </div>
                   <div class="col-sm-3">
                   <h6>Organization</h6>
                   </div>
                   <div class="col-sm-3"> 
                   <p>: {{$session->course->org_course}}</p>
                   </div>
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