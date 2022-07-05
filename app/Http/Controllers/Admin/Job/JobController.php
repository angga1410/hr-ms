<?php

namespace App\Http\Controllers\Admin\Job;

use App\Http\Controllers\Controller;
use App\Model\Admin\JobCategory;
use App\Model\Admin\JobTitle;
use App\Model\Admin\WorkShift;
use Illuminate\Http\Request;
use Auth;
use Yajra\DataTables\DataTables;

class JobController extends Controller
{
    public function JobTittleListView(){
        return view('HRM/Admin/Job/JobTitleList');
    }

    public function EmployeeStatusListView(){
        return view('HRM/Admin/Job/EmployeeStatusList');
    }

    public function JobCategoryListView(){
        return view('HRM/Admin/Job/JobCategoryList');
    }

    public function WorkShiftListView(){
        return view('HRM/Admin/Job/WorkShiftList');
    }

    public function jobTitleUpdateStatus(Request $request)
    {
        $id = $request->get("id");
        $save["status"] = $request->get("status");
        JobTitle::where('id', $id)->update($save);
    }
    public function jobCategoryUpdateStatus(Request $request)
    {
        $id = $request->get("id");
        $save["status"] = $request->get("status");
        JobCategory::where('id', $id)->update($save);
    }
    public function workShiftUpdateStatus(Request $request)
    {
        $id = $request->get("id");
        $save["status"] = $request->get("status");
        WorkShift::where('id', $id)->update($save);
    }

    public function saveJobTitle(Request $request)
    {
        $save = new JobTitle;
        $save->job_title = $request->get("job_title");
        $save->job_desc = $request->get("job_desc");
        $save->job_note = $request->get("job_note");
        $save->job_file = $request->get("job_file");
        $save->status = 0;
        $save->save();
        // return redirect(route('location_list'))->with('success', 'Success Create New Location!');

    }
    public function saveJobCategory(Request $request)
    {
        $save = new JobCategory;
        $save->name = $request->get("name");
        $save->status = 0;
        $save->save();
        // return redirect(route('location_list'))->with('success', 'Success Create New Location!');

    }
    public function jobtitleGetData()
    {
       
        $records = JobTitle::query();


        return Datatables::of($records)
            ->editColumn('id', function ($record) {
   
                return $record->id;
            })
            ->editColumn('job_title', function ($record) {
   
                return $record->job_title;
            })
            ->editColumn('job_desc', function ($record) {
   
                return $record->job_desc;
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

    public function jobcategoryGetData()
    {
       
        $records = JobCategory::query();


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

    public function saveWorkShift(Request $request)
    {  
        $save = new WorkShift;
        $save->name = $request->get("name");
        $save->from_hour = $request->get("from_hour");
        $save->to_hour = $request->get("to_hour");
        $save->hour_per_day = $request->get("hour_per_day");
        $save->status = 0;
        $save->save();
        // return redirect(route('location_list'))->with('success', 'Success Create New Location!');

    }
    public function workshiftGetData()
    {
       
        $records = WorkShift::query();


        return Datatables::of($records)
            ->editColumn('id', function ($record) {
   
                return $record->id;
            })
            ->editColumn('name', function ($record) {
   
                return $record->name;
            })
            ->editColumn('from_hour', function ($record) {
   
                return $record->from_hour;
            })
            ->editColumn('to_hour', function ($record) {
   
                return $record->to_hour;
            })
            ->editColumn('hour_per_day', function ($record) {
   
                return $record->hour_per_day;
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

    public function jobcategoryAPI()
    {
       
        $records = JobCategory::select('id','name')->get();
return $records;
    }
    public function jobAPI()
    {
       
        $records = JobTitle::select('id','job_title')->get();
return $records;
    }

}
