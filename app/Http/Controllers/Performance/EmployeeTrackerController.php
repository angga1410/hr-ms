<?php

namespace App\Http\Controllers\Performance;

use App\Http\Controllers\Controller;
use App\Model\Performance\EmpTracker;
use App\Model\Performance\EmpTrackerLog;
use App\Model\Performance\EmpTrackerReviewer;
use App\Model\PIM\Employee;
use App\Model\Training\Course;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Auth;

class EmployeeTrackerController extends Controller
{
    public function ManageTrackerView()
    {   $emp = Employee::where('status',0)->get();
        return view('HRM/Performance/ManageTracker')->with('emp',$emp);
    }
    public function TrackerListView()
    {  
        return view('HRM/Performance/TrackerList');
    }
    public function MyTrackerListView()
    {  
        return view('HRM/Performance/MyTrackerList');
    }
    public function ViewTrackerView($id)
    {   $emp = Employee::where('status',0)->get();
        $track = EmpTracker::where('id',$id)->with('emp')->first();

        return view('HRM/Performance/ViewTracker')->with('emp',$emp)->with('track',$track);
    }
    public function ViewTrackerAllView($id)
    {   $emp = Employee::where('status',0)->get();
        $track = EmpTracker::where('id',$id)->with('emp')->first();

        return view('HRM/Performance/ViewTrackerAll')->with('emp',$emp)->with('track',$track);
    }
    public function ViewMyTrackerView($id)
    {   $emp = Employee::where('status',0)->get();
        $track = EmpTracker::where('id',$id)->with('emp')->first();

        return view('HRM/Performance/ViewMyTracker')->with('emp',$emp)->with('track',$track);
    }


    public function saveTracker(Request $request){
        $save = new EmpTracker();
        $save->name = $request->get("name");
        $save->emp_tracker = $request->get("emp_tracker");
        $save->status = 0;
        $save->save();
        $emp_id = $request->get("emp_id");

        for ($i = 0; $i < count($emp_id); $i++) {
            $rev = new EmpTrackerReviewer();
            $rev->emp_id = $emp_id[$i];
            $rev->tracker_id = $save->id;
            $rev->save();
        }
        return redirect(route('manage_tracker'))->with('success', 'Success Create New Employee!');
    }

    public function saveLogTracker(Request $request){
        $save = new EmpTrackerLog();
        $save->tracker_id = $request->get("tracker_id");
        $save->log = $request->get("log");
        $save->performance = $request->get("performance");
        $save->comment = $request->get("comment");
        $save->emp_tracker = Auth::user()->emp_id;
        $save->save();
    }

    public function employeeData(Request $request)
    {
        $term = $request->get('term');

        $data = Employee::where('first_name', 'LIKE', '%' . $term . '%')->orWhere('middle_name', 'LIKE', '%' . $term . '%')->orWhere('last_name', 'LIKE', '%' . $term . '%')->get();

        $results = array();

        foreach ($data as $query) {
            $results[] = ['id' => $query->id, 'first_name' => $query->first_name, 'middle_name' => $query->middle_name, 'last_name' => $query->last_name];
        }
        return response()->json($results);
    }

    public function trackerData()
    {
       
        $records = EmpTracker::query();
   
   
        return Datatables::of($records)
            ->editColumn('name', function ($record) {
   
                return  "<a href='" . route('tracker_view',$record->id) . "'>$record->name</a>";
            })
            ->editColumn('emp_first', function ($record) {

                return $record->emp->first_name;
            })
            ->editColumn('emp_middle', function ($record) {

                return $record->emp->middle_name;
            })
            ->editColumn('emp_last', function ($record) {

                return $record->emp->last_name;
            })
            ->editColumn('added_date', function ($record) {

                return date('D, d M Y', strtotime($record->created_at));  
            })
            ->editColumn('modif_date', function ($record) {

                return date('D, d M Y', strtotime($record->updated_at));  
            })
        
            ->rawColumns(['name'])
   
            ->make(true);
    }
    public function mytrackerData()
    {
       
        $records = EmpTracker::where('emp_tracker',Auth::user()->emp_id)->get();
   
   
        return Datatables::of($records)
            ->editColumn('name', function ($record) {
   
                return  "<a href='" . route('my_tracker_view',$record->id) . "'>$record->name</a>";
            })
            ->editColumn('emp_first', function ($record) {

                return $record->emp->first_name;
            })
            ->editColumn('emp_middle', function ($record) {

                return $record->emp->middle_name;
            })
            ->editColumn('emp_last', function ($record) {

                return $record->emp->last_name;
            })
            ->editColumn('added_date', function ($record) {

                return date('D, d M Y', strtotime($record->created_at));  
            })
            ->editColumn('modif_date', function ($record) {

                return date('D, d M Y', strtotime($record->updated_at));  
            })
        
            ->rawColumns(['name'])
   
            ->make(true);
    }
    public function trackerDataAll()
    {
       
        $records = EmpTracker::query();
   
   
        return Datatables::of($records)
            ->editColumn('name', function ($record) {
   
                return  "<a href='" . route('tracker_view_all',$record->id) . "'>$record->name</a>";
            })
            ->editColumn('emp_first', function ($record) {

                return $record->emp->first_name;
            })
            ->editColumn('emp_middle', function ($record) {

                return $record->emp->middle_name;
            })
            ->editColumn('emp_last', function ($record) {

                return $record->emp->last_name;
            })
            ->editColumn('added_date', function ($record) {

                return date('D, d M Y', strtotime($record->created_at));  
            })
            ->editColumn('modif_date', function ($record) {

                return date('D, d M Y', strtotime($record->updated_at));  
            })
        
            ->rawColumns(['name'])
   
            ->make(true);
    }
    public function viewtrackerData(Request $request)
    {
       
        $records = EmpTrackerLog::where('tracker_id',$request->tracker_id)->get();
   
   
        return Datatables::of($records)
            ->editColumn('log', function ($record) {
   
                return $record->log;
            })
            ->editColumn('performance', function ($record) {
   
                return $record->performance;
            })
            ->editColumn('comment', function ($record) {
   
                return $record->comment;
            })
            ->editColumn('emp_first', function ($record) {

                return $record->emp->first_name;
            })
            ->editColumn('emp_middle', function ($record) {

                return $record->emp->middle_name;
            })
            ->editColumn('emp_last', function ($record) {

                return $record->emp->last_name;
            })
            ->editColumn('added_date', function ($record) {

                return date('D, d M Y', strtotime($record->created_at));  
            })
          
        
            ->rawColumns(['name'])
   
            ->make(true);
    }

}
