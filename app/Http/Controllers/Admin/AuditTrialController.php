<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditTrialController extends Controller
{
    public function AuditTrailView(){
        return view('HRM/Admin/AuditTrail');
    }

}
