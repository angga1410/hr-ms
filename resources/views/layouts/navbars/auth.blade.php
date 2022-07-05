<div class="modal fade" id="applyleave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Punch In/Out</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('save_punch') }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="modal-body">
       

       


  
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
        <button type="submit" class="btn btn-info btn-lg">Punch</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="sidebar" data-color="black" data-active-color="danger">
    <div class="logo">
        <a href="{{url('/home')}}" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/icon.png">
            </div>
        </a>
        <a href="{{url('/home')}}" class="simple-text logo-normal">
            {{ __('GSPE HRM') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
            <a href="{{url('/home')}}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'admin' || $elementActive == 'profile' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                    <i class="nc-icon nc-touch-id"></i>
                    <p>
                        {{ __('Admin') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="laravelExamples">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples1">

                                <p>
                                    {{ __(' User Management') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="laravelExamples1">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{url('/admin/user-list')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Users ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{url('/admin/user-role-list')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Users Role') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples2">

                                <p>
                                    {{ __(' Job') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="laravelExamples2">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{url('/admin/job-title-list')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Job Titles ') }}</span>
                                        </a>
                                    </li>
                                    <!-- <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Salary Components') }}</span>
                                        </a>
                                    </li> -->
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{url('/admin/employee-status-list')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Employment Status ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{url('/admin/job-category-list')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Department ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{url('/admin/work-shift-list')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' work shift') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples3">

                                <p>
                                    {{ __(' Organization') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="laravelExamples3">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/admin/general-info')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' General Information ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{url('/admin/location-list')}}">
                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Locations ') }}</span>
                                        </a>
                                    </li>

                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{url('/admin/organization_viewer_v3')}}">
                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Organization Viewer ') }}</span>
                                        </a>
                                    </li>
                                    <!-- <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{url('/admin/organization_viewer')}}">
                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Organization Viewer V2') }}</span>
                                        </a>
                                    </li> -->
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{url('/admin/organization_setup')}}">
                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Organization Setup ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{url('/admin/employee-hierarchy')}}">
                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Employee') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{url('/admin/one_page_settings')}}">
                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' One Page Settings ') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples4">

                                <p>
                                    {{ __(' Qualifications ') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="laravelExamples4">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{url('/admin/skill-list')}}">
                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Skills ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/admin/education-list')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Education ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Language ') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples5">

                                <p>
                                    {{ __(' Announcements ') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="laravelExamples5">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Documents ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{url('/admin/document-category-list')}}">
                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Documents CATEGORIES ') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples6">

                                <p>
                                    {{ __(' Configuration ') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="laravelExamples6">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Email Settings ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Email Notifications ') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                        <a href="{{url('/admin/audit-trail')}}">

                                <span class="sidebar-normal">{{ __(' Audit Trails ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="{{ $elementActive == 'pim' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples7">
                    <i class="nc-icon nc-badge"></i>
                    <p>{{ __('PIM') }}</p>
                    <b class="caret"></b>
                </a>
                <div class="collapse" id="laravelExamples7">
                    <ul class="nav">
                        <!-- <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples8">

                                <p>
                                    {{ __(' Configuration ') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="laravelExamples8">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Reporting Methods ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Termination Reasons') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Documents Templates') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->
                        <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                        <a href="{{url('/pim/list-employee')}}">

                                <span class="sidebar-normal">{{ __(' Employee List') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                        <a href="{{url('/pim/add-employee')}}">

                                <span class="sidebar-normal">{{ __(' Add Employee ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                        <a href="{{url('/pim/list-employee')}}">

                                <span class="sidebar-normal">{{ __('Past Employee') }}</span>
                            </a>
                        </li>
                        <!-- <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'user') }}">

                                <span class="sidebar-normal">{{ __(' Reports ') }}</span>
                            </a>
                        </li> -->
                        <!-- <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples9">

                                <p>
                                    {{ __(' Manage Date ') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="laravelExamples9">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Bulk Data ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Employee Data Export') }}</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li> -->
                    </ul>
                </div>
            </li>
            <!-- <li class="{{ $elementActive == 'myinfo' ? 'active' : '' }}">
          
            <a href="{{url('')}}" >
                    <i class="nc-icon nc-single-02"></i>
                    <p>{{ __('My Info') }}</p>
                </a>
            </li> -->
            <li class="{{ $elementActive == 'leave' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#leave">
                    <i class="nc-icon nc-single-copy-04"></i>
                    <p>{{ __('Leave') }}</p>
                    <b class="caret"></b>
                </a>

                <div class="collapse" id="leave">
                    <ul class="nav">
                        <!-- <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                            <a href="" data-toggle="modal" data-target="#applyleave" >

                                <span class="sidebar-normal">{{ __(' Apply ') }}</span>
                            </a>
                        </li> -->
                        <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                        <a href="{{url('/leave/my-leave')}}">
                                <span class="sidebar-normal">{{ __(' My Leave ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#leave1">

                                <p>
                                    {{ __(' Entitlements') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="leave1">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/leave/add-entitlement')}}">
                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Add Entitlements ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/leave/bulk-add-entitlement')}}">
                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __('Add Entitlements by Dept') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/leave/add-entitlement-contract')}}">
                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __('Add Entitlements by Contract') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/leave/list-entitlement')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Entitlement List') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' My Entitlements') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#leave2">

                                <p>
                                    {{ __(' Reports') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="leave2">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/leave/leave-report')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Leave Usage ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/leave/my-leave-report')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' My Leave Usage') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#leave3">

                                <p>
                                    {{ __(' Configure') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="leave3">
                                <ul class="nav">
                                 
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/leave/leave-type-list')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Leave Types') }}</span>
                                        </a>
                                    </li>
                                
                                    <!-- <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Notifications ') }}</span>
                                        </a>
                                    </li> -->

                                </ul>
                            </div>
                        </li>
                        <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                        <a href="{{url('/leave/list-leave')}}">

                                <span class="sidebar-normal">{{ __(' Leave List ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                        <a href="{{url('/leave/assign-leave')}}">

                                <span class="sidebar-normal">{{ __(' Assign Leave ') }}</span>
                            </a>
                        </li>
                        <!-- <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                        <a href="{{url('/leave/leave-calendar')}}">


                                <span class="sidebar-normal">{{ __(' Leave Calendar ') }}</span>
                            </a>
                        </li> -->
                        <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                        <a href="{{url('/leave/holiday')}}">


                                <span class="sidebar-normal">{{ __(' Holiday and Cuti Bersama') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                        <a href="{{url('/leave/bulk-assign-leave')}}">

                                <span class="sidebar-normal">{{ __(' Bulk Assign ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            </li>
            <li class="{{ $elementActive == 'time' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#time">
                    <i class="nc-icon nc-watch-time"></i>
                    <p>{{ __('Time') }}</p>
                    <b class="caret"></b>
                </a>
                <div class="collapse" id="time">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#time1">

                                <p>
                                    {{ __(' Timesheets') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="time1">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/time/my-timesheets')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' My Timesheets ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Employee Timesheets ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Export Timesheets ') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#time2">

                                <p>
                                    {{ __(' Attendance') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="time2">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/time/my-record')}}">


                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' My Records ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="" data-toggle="modal" data-target="#applyleave" >


                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Punch In/Out ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/time/employee-record')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Employee Records ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Configurations ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Export to CSV ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Upload Data ') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#time3">

                                <p>
                                    {{ __(' Reports') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="time3">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Project Time ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Employee Project Time ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Pay Hours Report ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Attendance Summary ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Monthly Attendance ') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>

            </li>
            <li class="{{ $elementActive == 'recruitment' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#recruit">
                    <i class="nc-icon nc-circle-10"></i>
                    <p>{{ __('Recruitment') }}</p>
                    <b class="caret"></b>

                </a>
                <div class="collapse" id="recruit">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'myinfo' ? 'active' : '' }}">
                        <a href="{{url('/recruitment/vacancies-list')}}">

                                <p>{{ __('Vacancies') }}</p>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'myinfo' ? 'active' : '' }}">
                        <a href="{{url('/recruitment/candidate-list')}}">

                                <p>{{ __('Candidates') }}</p>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#recruit1">

                                <p>
                                    {{ __(' Configurations') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="recruit1">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Vacancy Templates ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Employee Timesheets ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Export Timesheets ') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="{{ $elementActive == 'discipline' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#discipline">
                    <i class="nc-icon nc-tap-01"></i>
                    <p>{{ __('Discipline') }}</p>
                    <b class="caret"></b>

                </a>
                <div class="collapse" id="discipline">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'myinfo' ? 'active' : '' }}">
                        <a href="{{url('/discipline/list')}}">
                                <p>{{ __('Disciplinary Case') }}</p>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'myinfo' ? 'active' : '' }}">
                        <a href="{{url('/discipline/my-action')}}">

                                <p>{{ __('My Actions') }}</p>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#discipline1">

                                <p>
                                    {{ __(' Configurations') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="discipline1">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Document Templates ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/discipline/config-action')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Disciplinary Action ') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="{{ $elementActive == 'training' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#training">
                    <i class="nc-icon nc-send"></i>
                    <p>{{ __('Training') }}</p>
                    <b class="caret"></b>

                </a>
                <div class="collapse" id="training">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'myinfo' ? 'active' : '' }}">
                        <a href="{{url('/training/course-list')}}">

                                <p>{{ __('Courses') }}</p>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'myinfo' ? 'active' : '' }}">
                        <a href="{{url('/training/session-list')}}">

                                <p>{{ __('Sessions') }}</p>
                            </a>
                        </li>
                        <!-- <li class="{{ $elementActive == 'myinfo' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'map') }}">

                                <p>{{ __('Training Sessions') }}</p>
                            </a>
                        </li> -->
                        <li class="{{ $elementActive == 'myinfo' ? 'active' : '' }}">
                        <a href="{{url('/training/participant-session')}}">


                                <p>{{ __('Paticipanting Sessions') }}</p>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#training1">

                                <p>
                                    {{ __(' Report') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="training1">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Paticipanting Sessions ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Training Sessions ') }}</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="{{ $elementActive == 'performance' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#Performance">
                    <i class="nc-icon nc-sound-wave"></i>
                    <p>{{ __('Performance') }}</p>
                    <b class="caret"></b>

                </a>
                <div class="collapse" id="Performance">
                    <ul class="nav">

                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#perfom1">

                                <p>
                                    {{ __(' Employee Trackers') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="perfom1">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/performance/tracker-list')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Tracker List ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/performance/my-tracker-list')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' My Trackers ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/performance/manage-tracker')}}">
                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Manage Trackers ') }}</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <!-- <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#perfom2">

                                <p>
                                    {{ __(' Goals') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="perfom2">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' My Goals ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Goal List') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Goal Library ') }}</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li> -->
                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#perfom3">

                                <p>
                                    {{ __(' Appraisals') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="perfom3">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Appraisal List ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' My Appraisals') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Appraisal Cycles ') }}</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#perfom4">

                                <p>
                                    {{ __(' Configuration') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="perfom4">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Appraisal  ') }}</span>
                                        </a>
                                    </li>


                                </ul>
                            </div>
                        </li>
                        <!-- <li class="{{ $elementActive == 'myinfo' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'map') }}">

                                <p>{{ __('Competency Profiles') }}</p>
                            </a>
                        </li> -->
                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#perfom5">

                                <p>
                                    {{ __(' Reports') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="perfom5">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Review & Appraisal Progress  ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Performance Comparison  ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Perfomance Profile  ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Performance Progress  ') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
          
            <!-- <li class="{{ $elementActive == 'development' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#develop">
                <i class="nc-icon nc-trophy"></i>
                    <p>{{ __('Development') }}</p>
                    <b class="caret"></b>

                </a>
                <div class="collapse" id="develop">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'myinfo' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'map') }}">

                                <p>{{ __('Individual Development Plans') }}</p>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'myinfo' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'map') }}">

                                <p>{{ __('My IDP') }}</p>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'myinfo' ? 'active' : '' }}">
                        <a href="{{url('/development/box-matrix')}}">
                                <p>{{ __('9 Box Matrix') }}</p>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#develop1">

                                <p>
                                    {{ __(' Configuration') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="develop1">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Training Sessions ') }}</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </li> -->

            <!-- <li class="{{ $elementActive == 'onboarding' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'typography') }}">
                    <i class="nc-icon nc-paper"></i>
                    <p>{{ __('On Boarding') }}</p>
                </a>
            </li> -->
            <li class="{{ $elementActive == 'expense' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#Expense">
                <i class="nc-icon nc-money-coins"></i>
                    <p>{{ __('Expense') }}</p>
                    <b class="caret"></b>

                </a>
                <div class="collapse" id="Expense">
                    <ul class="nav">

                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#expense1">

                                <p>
                                    {{ __(' Configuration') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="expense1">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/expense/config')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Expense Type') }}</span>
                                        </a>
                                    </li>
                                 
                               

                                </ul>
                            </div>
                        </li>
                     
                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#expense3">

                                <p>
                                    {{ __(' Travel Requests') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="expense3">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/expense/add-new')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Emp Travel Request ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                    <a href="{{url('/expense/add-new')}}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' My Travel Request ') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#expense4">

                                <p>
                                    {{ __(' Claims') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="expense4">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Employee Claims  ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' My Claims  ') }}</span>
                                        </a>
                                    </li>


                                </ul>
                            </div>
                        </li>
                      
                        <li class="{{ $elementActive == 'coba' || $elementActive == 'coba1' ? 'active' : '' }}">
                            <a data-toggle="collapse" aria-expanded="true" href="#expense5">

                                <p>
                                    {{ __(' Reports') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="expense5">
                                <ul class="nav">
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Review & Appraisal Progress  ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Performance Comparison  ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Perfomance Profile  ') }}</span>
                                        </a>
                                    </li>
                                    <li class="{{ $elementActive == 'coba' ? 'active' : '' }}">
                                        <a href="{{ route('page.index', 'user') }}">

                                            <span class="sidebar-normal"> &nbsp&nbsp&nbsp{{ __(' Performance Progress  ') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
          
            <li class="{{ $elementActive == 'more' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'typography') }}">
                    <i class="nc-icon nc-bullet-list-67"></i>
                    <p>{{ __('More') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'more' ? 'active' : '' }}">
            <a href="{{url('/socialnetwork/dashboard')}}">
                    <i class="nc-icon nc-satisfied"></i>
                    <p>{{ __('Social Network') }}</p>
                </a>
            </li>
            <!-- <li class="active-pro {{ $elementActive == 'upgrade' ? 'active' : '' }} bg-danger">
                <a href="{{ route('page.index', 'upgrade') }}">
                    <i class="nc-icon nc-spaceship text-white"></i>
                    <p class="text-white">{{ __('Upgrade to PRO') }}</p>
                </a>
            </li> -->
        </ul>
    </div>
</div>