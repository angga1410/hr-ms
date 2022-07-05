<?php

namespace App\Http\Controllers\Time\Attendance;

use App\Http\Controllers\Controller;
use App\Model\Leave\LeaveType;
use App\Model\PIM\Employee;
use App\Model\Time\Attendance;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Auth;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Http;

class AttendanceController extends Controller
{
    public function addPunchView()
    {

        return view('HRM/Time/Attendance/AddPunch');
    }
    public function myRecordView()
    {
        return view('HRM/Time/Attendance/MyRecordView');
    }
    public function testing()
    {
        // $emp = Employee::all();
        // $type = LeaveType::all();
        // return view('HRM/Time/Attendance/testing')->with('emp', $emp)->with('type', $type);
        $id = 24;
        $time = '2019-09-30T17:00:00.000';
        $day = 600;

        $response = Http::get('https://location.meeting.ioseries.com/locationrecords-history?from='.$time.'Z&days='.$day.'&employeeId='.$id.'');
        $records = $response->json();
      

        return DataTables::of($records['history'])
        ->editColumn('date', function ($record) {

            return $record['date'];
        })
       
        ->rawColumns(['punch_out'])

        ->make(true);

       
        
    }

    public function savePunch(Request $request)
    {
        $check = Attendance::where('emp_id', Auth::user()->emp_id)->where('created_at', Carbon::now()->toDateString())->first();
        if ($check == null) {
            $save = new Attendance;
            $save->emp_id = Auth::user()->emp_id;
            $save->punch_in = Carbon::now()->toDateTimeString();
            $save->punch_note = $request->get("note");
            $save->status = 0;
            $save->save();
        } 
        else {
            if ($check->punch_out == null) {
                $save["punch_out"] = Carbon::now()->toDateTimeString();
                $save["status"] = 1;
                Attendance::where('id', $check->id)->update($save);
            } 
            else {
                return redirect()->back();
            }
        }
        return redirect()->back();
    }

    public function listEmployeeRecordView()
    {
        $emp = Employee::all();
        $type = LeaveType::all();
        return view('HRM/Time/Attendance/EmployeeRecord')->with('emp', $emp)->with('type', $type);
    }

    public function myRecordData()
    {
        // $now = Carbon::now();
        // $records = Attendance::where('emp_id', Auth::user()->emp_id)->orderBy('created_at', 'DESC')->get();

        $id = 24;
        $time = '2021-09-30T17:00:00.000';
        $day = 65;

        $response = Http::get('https://location.meeting.ioseries.com/locationrecords-history?from='.$time.'Z&days='.$day.'&employeeId='.$id.'');
        $records = $response->json();
    //   dd($records);


        return DataTables::of($records['history'])
            ->editColumn('date', function ($record) {

                return date('d M Y', strtotime($record['date'])); 
            })
            ->editColumn('punch_in', function ($record) {
                if($record['locationRecord'] != null){
                    return date('H:i:s', strtotime($record['locationRecord']['createdAt'])); 
                }
                else{
                    return "";
                }
                
            })
            ->editColumn('punch_out', function ($record) {
                if($record['checkOut'] != null){
                    return date('H:i:s', strtotime($record['checkOut']['createdAt'])); 
                }
                else{
                    return "";
                }
              
            })
            // ->editColumn('note', function ($record) {
            //     return $record['checkOut']['createdAt'];
            // })
            // ->editColumn('status', function ($record) {
            //     if ($record->status == 0) {
            //         return "Pending Approval";
            //     } elseif ($record->status == 1) {
            //         return "Rejected";
            //     } elseif ($record->status == 2) {
            //         return "Schedulled";
            //     } elseif ($record->status == 3) {
            //         return "Taken";
            //     }
            // })
            // ->editColumn('comment', function ($record) {
            //     return $record->comment;
            // })

            ->rawColumns(['punch_out'])

            ->make(true);
    }

}
