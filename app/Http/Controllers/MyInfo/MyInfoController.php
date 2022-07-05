<?php

namespace App\Http\Controllers\MyInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyInfoController extends Controller
{
    public function MyInfoView(){
        return view('HRM/MyInfo/MyInfo');
    }
}
