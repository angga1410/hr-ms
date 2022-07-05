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
            <form id="ajaxform">
                <meta name="csrf-token" content="{{ csrf_token() }}" />
              
                <div class="modal-body">


                    <div class="form-group">
                        <label for="email1">Log</label>
                        <input class="form-control" id="name" name="log">

                    </div>
            
                    <div class="form-group">
                        <label for="email1">Performance</label>
                        <select class="form-control select2 document_no" style="width: 100%;" name="performance">
                            <option>-</option>
                            <option>Positive</option>
                            <option>Negative</option>
                          
                        </select>
                    </div>
            </br>
                    <div class="form-group">
                    <label for="email1">Comment </label>
                    <textarea class="form-control" id="name" name="comment"></textarea>

                    </div>

                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                <button class="btn btn-secondary save-log" data-dismiss="modal" id="btnupdate">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="content">
<input type="hidden" id="tracker_id" value="{{$track->id}}">

    <div class="row">
        <div class="col-md-12">
        <a href="{{url('/performance/manage-tracker')}}"><button class="btn btn-secondary">Back</button></a>
            <div class="card">
                <div class="card-header">
               
                    <h4 class="card-title">Trackers Logs - {{$track->name}}</h4>
                    <h6 class="card-title">{{$track->emp->first_name}} {{$track->emp->middle_name}} {{$track->emp->last_name}}</h6>
                    <h4 class="card-title text-right"> <button class="btn btn-info" data-toggle="modal" data-target="#form" title="Add !"><i class="nc-icon nc-simple-add"></i></button> </h4>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>Reviewer</th>
                                    <th>Log</th>
                                    <th>Comments</th>
                                    <th>Performance</th>
                                    <th>Added Date</th>
                                  
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
  var tracker_id = $('#tracker_id').val();
 
function refreshdata() {
        $('#log').val('');
        $('#performance').val('');
        $('#comment').val('');
        $('#table').DataTable().clear().destroy();
        load(tracker_id)
    }
    load(tracker_id)
    function load(tracker_id = '') {
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
                url: "{{ route('tracker_data_view') }}",
                   data:{tracker_id:tracker_id}
            },
            columns: [
                { data: 'emp_first', name: 'emp_first', render: function(data,type,row){
                                        return row.emp_first+'&nbsp'+row.emp_middle+'&nbsp'+row.emp_last
                                     } },
                {
                    data: 'log',
                    name: 'log'
                }, 
                                     {
                    data: 'comment',
                    name: 'comment'
                },
                {
                    data: 'performance',
                    name: 'performance'
                },
               
              
                {
                    data: 'added_date',
                    name: 'added_date'
                },

            ]
        });
    }



    $(".save-log").click(function(event) {
        event.preventDefault();

        let log = $("input[name=log]").val();
        let performance = $("select[name=performance]").val();
        let comment = $("textarea[name=comment]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('save_tracker_log') }}",
            type: "POST",
            data: {
                tracker_id : tracker_id,
               log:log,
               performance: performance,
               comment: comment,
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