<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaveCalendar extends Controller
{
    public function LeaveCalendarView(){
        return view('HRM/Leave/LeaveCalendar');
    }

}
