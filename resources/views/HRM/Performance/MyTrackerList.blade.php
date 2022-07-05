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

<div class="content">


    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">My Performance Trackers</h4>
                  
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

    load()

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
                url: "{{ route('my_tracker_data') }}",
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


</script>
@endpush