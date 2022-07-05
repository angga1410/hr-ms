@extends('layouts.app', [
'class' => '',
'elementActive' => 'performance'
])

@section('content')
<style>
::-webkit-input-placeholder {
   font-style: italic;
}
:-moz-placeholder {
   font-style: italic;  
}
::-moz-placeholder {
   font-style: italic;  
}
:-ms-input-placeholder {  
   font-style: italic; 
}
</style>
<link rel="stylesheet" href='{{ asset("/css/jquery.dataTables.min.css") }}' type="text/css" />

<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Performance Trackers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('save_tracker') }}" method="post" enctype="multipart/form-data">
              {!! csrf_field() !!}
                <meta name="csrf-token" content="{{ csrf_token() }}" />
                <div class="modal-body">


                    <div class="form-group">
                        <label for="email1">Tracker Name</label>
                        <input class="form-control" id="name" name="name">

                    </div>
            
                    <div class="form-group">
                        <label for="email1">Employee Name</label>
                        <select class="form-control select2 document_no" style="width: 100%;" name="emp_tracker">
                            <option>-</option>
                            @foreach ($emp as $get)
                <option value="{{$get->id}}">{{$get->first_name}} {{$get->middle_name}} {{$get->last_name}}</option>
                @endforeach
                        </select>
                    </div>
            </br>
                    <div class="form-group">
                    <label for="email1">Assign Reviewers </label>
                        <input class="form-control float-right" style="width: 470px;" id="searchProduct" type="text" dir="ltr" placeholder="Type employee name...">


                    </div>

                    <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" id="new_raw_qc">
                                                                            <thead>
                                                                                <tr>

                                                                                    <th>Reviewer Name</th>
                                                                                  

                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                            </tbody>
                                                                        </table>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button class="btn btn-success" type="submit">Submit</button>
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
                    <h4 class="card-title">Manage Performance Trackers</h4>
                    <h4 class="card-title text-right"> <button class="btn btn-info" data-toggle="modal" data-target="#form" title="Add !"><i class="nc-icon nc-simple-add"></i></button> </h4>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>Tracker Name </th>
                                    <th>Employee</th>
                                    <th>Added Date</th>
                                    <th>Modified Date</th>
                                  
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
<script src="{{asset('js/typeahead.bundle.js')}}"></script>
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
        var engine = new Bloodhound({
            remote: {



                url: "{{ URL::to('/performance/empdata?term=%QUERY%') }}",
                wildcard: '%QUERY%'
            },

            datumTokenizer: Bloodhound.tokenizers.whitespace('term'),
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        engine.initialize();

        $("#searchProduct").typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            source: engine.ttAdapter(),
            displayKey: engine.clear(),
            limit: 17,
            templates: {
                empty: [
                    '<div class="empty-message btn-secondary disabled">unable to find any</div>'
                ],
                suggestion: function(data) {
                    return '<li class="list-group-item" style="cursor: pointer;" id="suggestion">' + data.first_name + ' ' + data.middle_name + ' ' + data.last_name + '</li>'
                }

            }

        });
        $('#searchProduct').on('typeahead:selected', function(e, datum) {

            $("#btn_qc").show();

            $("#new_raw_qc").append('<tr>' +
                '<input type="hidden" class="form-control" name="emp_id[]" value="' + datum.id + '" readonly="true" >' +

                '<td><input type="text" class="form-control"  value="' + datum.first_name +' '+ datum.middle_name +' '+ datum.last_name + '" readonly="true" style="width:250px;border:none;"></td>' +

                '<td><a class="deleteItem btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="nc-icon nc-simple-remove lg"></i></a></td>' +
                '</tr>');

        });

    });
    $('#new_raw_qc').on('click', '.deleteItem', function() {
        $(this).closest('tr').remove();
    });
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
                url: "{{ route('tracker_data') }}",
                //    data:{emp_id:emp_id, type:type , status:status , dept:dept , to:to , from:from}
            },
            columns: [
                {
                    data: 'name',
                    name: 'name'
                },  { data: 'emp_first', name: 'emp_first', render: function(data,type,row){
                                        return row.emp_first+'&nbsp'+row.emp_middle+'&nbsp'+row.emp_last
                                     } },
               
                {
                    data: 'added_date',
                    name: 'added_date'
                },
                {
                    data: 'modif_date',
                    name: 'modif_date'
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