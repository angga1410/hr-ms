@extends('layouts.app', [
'class' => '',
'elementActive' => 'time'
])

@section('content')
<style>
section {
  padding-left: 220px;
  padding-right: 10px;
  padding-bottom: 0px !important;
  margin-bottom: 0px !important;
}
@media screen and (max-width: 991px) {
  section {
    padding-left: 70px;
  }
}

body {
  background-image: url("https://static.pexels.com/photos/173434/pexels-photo-173434.jpeg");
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.6) 40%, rgba(255, 255, 255, 0.85) 100%), url("https://static.pexels.com/photos/173434/pexels-photo-173434.jpeg");
  background-repeat: no-repeat;
}



.maintitle {
  padding: 20px 0 0px 0%;
  margin-bottom: 50px;
  text-align: center;
  font-size: 40px;
  font-weight: 200;
}

.timesheet-navigation {
  margin-top: -30px;
  margin-left: -12px;
}

.timesheet-buttons {
  margin-top: 30px;
}

.today-timesheet {
  margin-top: 30px;
  position: relative;
  top: -66px;
  left: 200px;
}

.newmsgb, #theDate {
  border: solid 1px #1c7f7d;
  background-color: transparent;
  color: #1c7f7d;
  border-radius: 5px;
  padding: 7px 15px 7px 15px;
  white-space: nowrap;
}

.newmsgb:hover {
  background-color: #1c7f7d;
  color: white;
}
.newmsgb:focus {
  outline: none !important;
}

#theDate {
  margin-top: 5px;
}

.add-task-timesheet {
  border-radius: 5px;
  padding: 7px 15px 7px 15px;
  white-space: nowrap;
  background-color: #DD8F5B;
  border: none;
  margin-left: 10px;
  color: white;
}
.add-task-timesheet:hover {
  background-color: #E15959;
}
.add-task-timesheet:focus {
  outline: none !important;
}

.tab-text {
  padding-left: 20px;
  background-color: rgba(255, 255, 255, 0.6);
}

.tab-title {
  padding-top: 10px;
  padding-bottom: 10px;
  background-color: #1AAEAB;
  color: white;
  font-weight: 100;
}
@media screen and (max-width: 600px) {
  .tab-title {
    display: none;
  }
}
.tab-title div div {
  font-size: 15px;
  font-weight: 500;
  text-align: left;
  padding-left: 5px;
}
@media screen and (max-width: 768px) {
  .tab-title div div {
    font-size: 13px;
  }
}

.picked-day {
  font-size: 24px;
  color: #1c7f7d;
}

.dropdown-timesheet {
  position: relative;
  color: black;
  top: -42px;
  left: 140px;
}
.dropdown-timesheet .timesheet-button {
  font-size: 14px;
  border: none;
  background-color: #1c7f7d;
  color: white;
  border-radius: 5px;
  padding: 5px 15px 5px 15px;
}
.dropdown-timesheet .timesheet-button:focus {
  outline: none;
}
.dropdown-timesheet .timesheet-button .fa-sort {
  padding-right: 6px;
}

.timesheet-menu > li > a:focus, .timesheet-menu > li > a:hover {
  background-color: rgba(28, 127, 125, 0.6);
}

.modal-backdrop.in {
  z-index: 0 !important;
  opacity: 0;
}

.modal-content {
  box-shadow: none !important;
 
}

.timesheet .modal-title {
  text-align: left;
}

.select2-container {
  width: 255px !important;
}

.timesheet select, .timesheet input {
  color: #444;
  line-height: 28px;
  padding-left: 8px;
  padding-right: 20px;
  text-overflow: ellipsis;
  white-space: nowrap;
  background-color: #fff;
  border: 1px solid #aaa;
  border-radius: 4px;
  width: 255px;
}
@media screen and (max-width: 768px) {
  .timesheet select, .timesheet input {
    width: 200px;
  }
}
@media screen and (max-width: 768px) {
  .timesheet .modal-body {
    display: block;
    margin: auto;
    text-align: center;
  }
}
.timesheet .modal-body .row {
  padding-top: 5px;
  padding-bottom: 5px;
}

.timesheet-description {
  height: 118px !important;
  padding-bottom: 83px !important;
}

.user-aciton {
  font-weight: 700;
  text-transform: uppercase;
  font-size: 13px;
  text-align: center;
  color: white;
  width: 255px;
  height: 35px;
  border: none;
  border-radius: 5px;
  margin-top: 23px;
  background-color: #E46A6A;
  left: 0px;
  top: 0px;
  -webkit-transition: all 0.1s ease, top 0.1s ease 0.1s, height 0.1s ease 0.1s, background-color 0.1s ease 0.1s;
  transition: all 0.1s ease, top 0.1s ease 0.1s, height 0.1s ease 0.1s, background-color 0.1s ease 0.1s;
  padding: 0;
}
@media screen and (max-width: 768px) {
  .user-aciton {
    width: 200px;
  }
}

.timesheet-task-row {
  padding-top: 10px;
}

.nav-tabs {
  background-color: white;
  border: none;
  width: 100%;
}

.nav-tabs > li {
  width: 150px;
  text-align: center;
}
@media screen and (max-width: 860px) {
  .nav-tabs > li {
    width: 103px;
  }
}
@media screen and (max-width: 650px) {
  .nav-tabs > li {
    font-size: 90px !important;
  }
}

.nav-tabs > li > a {
  color: rgba(28, 127, 125, 0.6);
  font-weight: 700;
  font-size: 15px;
  height: 60px;
  line-height: 40px;
  white-space: nowrap;
}
@media screen and (max-width: 860px) {
  .nav-tabs > li > a {
    font-size: 13px !important;
  }
}
@media screen and (max-width: 650px) {
  .nav-tabs > li > a {
    font-size: 11px !important;
  }
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
  border: none;
  border-bottom: solid 3px #dd915b;
  border-radius: 0px;
  color: #1c7f7d;
  z-index: 1;
}

.nav > li > a:focus, .nav > li > a:hover {
  background-color: rgba(28, 127, 125, 0.02);
  border: none;
  border-radius: 0px !important;
}

.tab-content {
  overflow: hidden;
}

.tab-text {
  padding-left: 20px;
  background-color: rgba(255, 255, 255, 0.6);
}

.tab-title {
  padding-top: 10px;
  padding-bottom: 10px;
  background-color: #1AAEAB;
  color: white;
  font-weight: 100;
}
@media screen and (max-width: 600px) {
  .tab-title {
    display: none;
  }
}

</style>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="container">

            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> My Time Sheets </h4>
                </div>

                <div class="card-body">

                <div>
  
  </div>

<section class="timesheet-navigation">
    <div class="nav">
      <div class="container-fluid nopaddingmail">
       <div class="tabbable">
        <ul class="nav nav-tabs" data-tabs="tabs" id="myTab">
        <li class="active"><a data-toggle="tab" href="#incoming">Current</a></li>
        <li><a data-toggle="tab" href="#sentmsg">Previous</a></li>
        <li><a data-toggle="tab" href="#sentmsg">Not Sent</a></li>
        <li><a data-toggle="tab" href="#sentmsg">Wait for Accept</a></li>
        <li><a data-toggle="tab" href="#sentmsg">Accepted</a></li>
        <li><a data-toggle="tab" href="#sentmsg">Rejected</a></li>
        </ul>
        <div class="tab-content">
        <div class="tab-pane active" id="incoming">
          
</section>


<section class="timesheet-buttons">

  <input type="date" id="theDate">
  
  <div class="today-timesheet">
    <button type="button" class="newmsgb">Today</button>
    <button type="button" class="add-task-timesheet" data-toggle="modal" data-target="#addtask">Add New Task</button>
  </div>
</section>

<section style="margin-top: -40px">
  
  <p class="picked-day">2020-12-30</p>


  
    
</section>

<section>
 <div class="container-fluid">
   <div class="row">
     <div class="col-md-12 col-sm-12 col-xs-12 tab-title">
       <div class="row">
          <div class="col-md-2 col-sm-2 col-xs-1">
            <div class="statustitle">Project</div>
           </div>
           <div class="col-md-2 col-sm-2 col-xs-2">
             <div class="projectnametitle">Task</div>
           </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
              <div class="completiontitle">Date</div>
           </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
              <div class="detailstitle">Start Date/End Date</div>
            </div>
            <div class="col-md-1 col-sm-1 col-xs-1">
              <div class="detailstitle">Duration</div>
            </div>
             <div class="col-md-2 col-sm-2 col-xs-2">
              <div class="detailstitle">Description</div>
            </div>
             <div class="col-md-1 col-sm-1 col-xs-1">
              <div class="tsdelete-row"></div>
            </div>
          </div>
        </div>
      </div>
    </div>  
</section>


<section>
 <div class="container-fluid">
   <div class="row">
     <div class="col-md-12 col-sm-12 col-xs-12">
       <div class="row timesheet-task-row">
          <div class="col-md-2 col-sm-2 col-xs-1">
            <div class="statustitle">Project 1</div>
           </div>
           <div class="col-md-2 col-sm-2 col-xs-2">
             <div class="projectnametitle">Task 1</div>
           </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
              <div class="completiontitle">2016-12-12</div>
           </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
              <div class="detailstitle">12:00/13:00</div>
            </div>
            <div class="col-md-1 col-sm-1 col-xs-1">
              <div class="detailstitle">1 Hr.</div>
            </div>
             <div class="col-md-2 col-sm-2 col-xs-2">
              <div class="detailstitle">Really hard work.</div>
            </div>
             <div class="col-md-1 col-sm-1 col-xs-1">
              <div class="tsdelete-row">x</div>
            </div>
          </div>
        </div>
      </div>
    </div>  
</section>


<!-- Modal -->
<div id="addtask" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content timesheet">
      <div class="modal-header">
        
        <h5 class="modal-title left" id="exampleModalLabel">Create Job Categories</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
            
              <div class="row">
                <div class="col-md-3">
                  <p>Task</p>
                </div>
                <div class="col-md-9">
                  
                <div class="form-group">
         
            <input type="email" class="form-control" id="email1" aria-describedby="emailHelp" >
           
          </div>
                  
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p>Date</p>
                </div>
                <div class="col-md-9">
                  <input type="date">
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p>Start Time</p>
                </div>
                <div class="col-md-9">
                  <input type="time" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p>End Time</p>
                </div>
                <div class="col-md-9">
                  <input type="time" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p>Description</p>
                </div>
                <div class="col-md-9">
                  <input type="text" class="timesheet-description"/>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                  
                   <div clas="actionbutton">
     <p class="button-container"><button class="user-aciton">Add Task</button></p>
   </div>  
                </div>
        
                </div>
              </div>
            </div>
          </div>
        </div>
        
        
        
        
        
        
        
      </div>
    </div>

  </div>
</div>


                </div>
            </div>
        </div>

    </div>
</div>
@endsection


@push('scripts')
<script type="text/javascript">
   $('.ui.dropdown')
  .dropdown()
;

$(document).ready(function() {
  $(".js-example-basic-single").select2();
});



webshims.setOptions('forms-ext', {types: 'date'});
webshims.polyfill('forms forms-ext');
$.webshims.formcfg = {
en: {
    dFormat: '-',
    dateSigns: '-',
    patterns: {
        d: "yy-mm-dd"
    }
}
};

var date = new Date();

var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();

if (month < 10) month = "0" + month;
if (day < 10) day = "0" + day;

var today = year + "-" + month + "-" + day;       
document.getElementById("theDate").value = today;


</script>
@endpush