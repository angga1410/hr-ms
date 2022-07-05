<?php

namespace App\Http\Controllers\Admin\Qualifications;

use App\Http\Controllers\Controller;
use App\Model\Admin\Education;
use App\Model\Admin\Skill;
use Illuminate\Http\Request;
use Auth;
use Yajra\DataTables\DataTables;

class QualificationController extends Controller
{
    public function SkillListView(){
        return view('HRM/Admin/Qualification/SkillsList');
    }
    public function EducationListView(){
        return view('HRM/Admin/Qualification/EducationList');
    }

    public function educationUpdateStatus(Request $request)
    {
        $id = $request->get("id");
        $save["status"] = $request->get("status");
        Education::where('id', $id)->update($save);
    }
    public function skillGetData()
    {
       
        $records = Skill::query();


        return Datatables::of($records)
            ->editColumn('id', function ($record) {
   
                return $record->id;
            })
            ->editColumn('name', function ($record) {
   
                return $record->name;
            })
            ->editColumn('desc_skill', function ($record) {
   
                return $record->desc_skill;
            })
        
            ->rawColumns([])

            ->make(true);
    }
    public function educationGetData()
    {
       
        $records = Education::query();


        return Datatables::of($records)
            ->editColumn('id', function ($record) {
   
                return $record->id;
            })
            ->editColumn('name', function ($record) {
   
                return $record->name;
            })
            ->editColumn('status', function ($record) {
                if ($record->status == 0) {
                    return '
                   <button class="btn btn-success" onclick="updatestatus(' . $record->id . ')" >
                       Active
                   </button>

               ';
                } elseif ($record->status == 1) {
                    return '
                <button class="btn btn-secondary" onclick="updatestatus(' . $record->id . ')" >
                    Archived
                </button>

            ';
                }
            })
        
            ->rawColumns(['status'])

            ->make(true);
    }
    public function saveSkill(Request $request)
    {
        $save = new Skill;
        $save->name = $request->get("name");
        $save->desc_skill = $request->get("desc_skill");
        $save->save();
        // return redirect(route('location_list'))->with('success', 'Success Create New Location!');

    }
    public function saveEducation(Request $request)
    {
        $save = new Education;
        $save->name = $request->get("name");
        $save->save();
        // return redirect(route('location_list'))->with('success', 'Success Create New Location!');

    }
}
