<?php

namespace App\Http\Controllers\Admin\Announcements;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function DocumentCategoryView(){
        return view('HRM/Admin/Announcements/DocumentCategoryLIst');
    }
}
