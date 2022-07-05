<?php

namespace App\Http\Controllers\Development\BoxMatrix;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MatrixController extends Controller
{
    public function BoxMatrixView(){
        return view('HRM/Development/BoxMatrix');
    }
}
