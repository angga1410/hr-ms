<?php

namespace App\Http\Controllers\Time\Timesheets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function MyTimeSheetsView(){
        return view('HRM/Time/MyTimeSheets');
    }

}
