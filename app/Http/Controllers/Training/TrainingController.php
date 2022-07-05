<?php

namespace App\Http\Controllers\Training;

use App\Http\Controllers\Controller;
use App\Model\Admin\JobCategory;
use App\Model\PIM\Employee;
use App\Model\Training\Course;
use App\Model\Training\Session;
use Asm89\Stack\Cors;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Auth;
use COM;
use Illuminate\Support\Str;

class TrainingController extends Controller
{
    public function CourseListView()
    { 
       
        $dept = JobCategory::all();
        $emp = Employee::all();
        return view('HRM/Training/CourseList')->with('emp',$emp)->with('dept',$dept);
    }

    public function SessionListView()
    {$course = Course::where('status',0)->get();
        return view('HRM/Training/SessionList')->with('course',$course);
    }
    public function ParticipantSessionView()
    {$course = Course::where('status',0)->get();
        return view('HRM/Training/ParticipantSession')->with('course',$course);
    }
    public function ViewSession($id)
    {
        $session = Session::where('id',$id)->with('course')->first();
        return view('HRM/Training/ViewSession')->with('session',$session);
    }
    public function ViewParticipant($id)
    {
        $session = Session::where('id',$id)->with('course')->first();
        return view('HRM/Training/ParticipantView')->with('session',$session);
    }

    public function saveCourse(Request $request)
    {
        $save = new Course;
        $save->title = $request->get("title");
        $save->coordinator_emp = $request->get("coordinator_emp");
        $save->dept_id = $request->get("dept_id");
        $save->desc_course = $request->get("desc_course");
        $save->duration = $request->get("duration");
        $save->org_course = $request->get("org_course");
        $save->status = 0;
        $save->save();
    }
    public function saveSession(Request $request)
    {
        $save = new Session;
        $save->name = $request->get("name");
        $save->course_id = $request->get("course_id");
        $save->start_date = $request->get("start_date");
        $save->end_date = $request->get("end_date");
        $save->location = $request->get("location");
        $save->delivery_method = $request->get("delivery_method");
        $save->desc_session = $request->get("desc_session");
        $save->trainers = $request->get("trainers");
        $save->status = 0;
        $save->save();
    }
    public function updateStatus(Request $request)
    {
        $id = $request->get("id");
        $save["status"] = $request->get("status");
        Course::where('id', $id)->update($save);
    }
    public function courseData()
    {
        // $now = Carbon::now();
        $records = Course::with('emp')->with('dept')->get();

        return DataTables::of($records)
            ->editColumn('title', function ($record) {

                return $record->title;
            })
            ->editColumn('desc_course', function ($record) {

                return $record->desc_course;
            })
            ->editColumn('duration', function ($record) {

                return "$record->duration H";
            })
            ->editColumn('org_course', function ($record) {

                return $record->org_course;
            })
            ->editColumn('dept', function ($record) {
                return $record->dept->name;
            })
            ->editColumn('coordinator_emp_first', function ($record) {

                return $record->emp->first_name;
            })
            ->editColumn('coordinator_emp_middle', function ($record) {

                return $record->emp->middle_name;
            })
            ->editColumn('coordinator_emp_last', function ($record) {

                return $record->emp->last_name;
            })
            ->editColumn('status', function ($record) {
                if ($record->status == 0) {
                    return '
                   <button class="btn btn-success" onclick="updatevacancies(' . $record->id . ')" >
                       Active
                   </button>

               ';
                } elseif ($record->status == 1) {
                    return '
                <button class="btn btn-secondary" onclick="updatevacancies(' . $record->id . ')" >
                    Archived
                </button>

            ';
                }
            })

            ->rawColumns(['duartion','status'])

            ->make(true);
    }
    public function sessionData()
    {
        // $now = Carbon::now();
        $records = Session::with('course')->get();

        return DataTables::of($records)
            ->editColumn('name', function ($record) {

                return  "<a href='" . route('session_view', $record->id) . "'>$record->name</a>";
            })
            ->editColumn('course_id', function ($record) {

                return $record->course->title;
            })
            ->editColumn('start_date', function ($record) {

                return date('D, d M Y', strtotime($record->start_date));  
            })
            ->editColumn('end_date', function ($record) {

                return date('D, d M Y', strtotime($record->end_date));  
            })
            ->editColumn('location', function ($record) {

                return $record->location;
            })
            ->editColumn('delivery_method', function ($record) {

                return $record->delivery_method;
            })
            ->editColumn('desc_session', function ($record) {

                return $record->desc_session;
            })
            ->editColumn('trainers', function ($record) {

                return $record->trainers;
            })
            ->editColumn('status', function ($record) {
                if ($record->status == 0) {
                    return '
                   <h6><span class="badge badge-secondary">	Scheduled</span></h6>

               ';
                } elseif ($record->status == 1) {
                    return '
                <h6> <span class="badge badge-success">Completed</span></h6>

            ';
                } 
            })
           

            ->rawColumns(['status','name'])

            ->make(true);
    }
    public function participantData()
    {
        // $now = Carbon::now();
        $records = Session::with('course')->get();

        return DataTables::of($records)
            ->editColumn('name', function ($record) {

                return  "<a href='" . route('participant_view', $record->id) . "'>$record->name</a>";
            })
            ->editColumn('course_id', function ($record) {

                return $record->course->title;
            })
            ->editColumn('start_date', function ($record) {

                return date('D, d M Y', strtotime($record->start_date));  
            })
            ->editColumn('end_date', function ($record) {

                return date('D, d M Y', strtotime($record->end_date));  
            })
            ->editColumn('location', function ($record) {

                return $record->location;
            })
            ->editColumn('delivery_method', function ($record) {

                return $record->delivery_method;
            })
            ->editColumn('desc_session', function ($record) {

                return $record->desc_session;
            })
            ->editColumn('trainers', function ($record) {

                return $record->trainers;
            })
            ->editColumn('status', function ($record) {
                if ($record->status == 0) {
                    return '
                   <h6><span class="badge badge-secondary">	Scheduled</span></h6>

               ';
                } elseif ($record->status == 1) {
                    return '
                <h6> <span class="badge badge-success">Completed</span></h6>

            ';
                } 
            })
           

            ->rawColumns(['status','name'])

            ->make(true);
    }
}
