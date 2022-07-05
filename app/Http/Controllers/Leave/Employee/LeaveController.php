<?php

namespace App\Http\Controllers\Leave\Employee;

use App\Http\Controllers\Controller;
use App\Model\Admin\JobCategory;
use App\Model\Leave\EmpLeave;
use App\Model\Leave\Entitlement;
use App\Model\Leave\LeaveType;
use App\Model\PIM\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Auth;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Redirect;

class LeaveController extends Controller
{
    public function MyLeaveView()
    {
        $now = Carbon::now();
        $leave_type_all = LeaveType::where('is_entitlement',1)->get();
        $leave_type = Entitlement::where('emp_id', Auth::user()->emp_id)->where('leave_period', $now->year)->with('type')->where('leave_balance', '!=', 0)->get();
        $leave_blc = Entitlement::where('emp_id', Auth::user()->emp_id)->first();

        return view('HRM/Leave/MyLeave')->with('leave_type', $leave_type)->with('leave_blc', $leave_blc)->with('leave_type_all',$leave_type_all);
    }
    public function LeaveAPI($id)
    {
        $now = Carbon::now();
        $leave_type_all = LeaveType::where('is_entitlement',1)->get();
        $leave_type = Entitlement::where('emp_id', $id)->where('leave_period', $now->year)->with('type')->where('leave_balance', '!=', 0)->get();
        $leave_blc = Entitlement::where('emp_id', $id)->first();
        $merged = $leave_type_all->merge($leave_type);
$income = $merged->all();
        return $income;
    }
    public function LeaveTypeAPI()
    {
       
        $leave_type_all = LeaveType::get();
        return $leave_type_all;
    }
    public function saveMyLeaveAPI(Request $request)
    {$now = Carbon::now();
        $date1 = Carbon::create($request->get("from_date"));
        $date2 = Carbon::create($request->get("to_date"));
        $interval = $date1->diffInDaysFiltered(function (Carbon $date) {
            return !$date->isWeekend();
        }, $date2);
        $days = $interval + 1;

        $balance = Entitlement::where('emp_id', $request->get("emp_id"))->where('leave_type', $request->get("leave_type"))->where('leave_period', $request->get("year"))->first();
if($balance != null && $days < $balance->leave_balance ){
    // $save["leave_balance"] = $balance->leave_balance - $days;
    // Entitlement::where('id', $balance->id)->update($save);

    $save = new EmpLeave;
    $save->leave_type = $request->get("leave_type");
    $save->from_date = $request->get("from_date");
    $save->to_date = $request->get("to_date");
    $save->comment = $request->get("comment");
    $save->emp_id =  $request->get("emp_id");
    $save->period =  $now->year;
    $save->number_day = $days;
    $save->status = 0;
    $save->save();
}elseif($balance != null && $days > $balance->leave_balance ){
    return Redirect::route('my_leave')->withErrors(['msg' => 'The Message']);
}
else{
    $save = new EmpLeave;
    $save->leave_type = $request->get("leave_type");
    $save->from_date = $request->get("from_date");
    $save->to_date = $request->get("to_date");
    $save->comment = $request->get("comment");
    $save->emp_id =  $request->get("emp_id");
    $save->period =  $now->year;
    $save->number_day = $days;
    $save->status = 0;
    $save->save();
}
      
        // return redirect(route('location_list'))->with('success', 'Success Create New Location!');

    }
    
    public function listLeaveView()
    {
        $emp = Employee::all();
        $type = LeaveType::all();
        $dept = JobCategory::all();
        return view('HRM/Leave/ListLeave')->with('emp',$emp)->with('type',$type)->with('dept', $dept);
    }

    public function bulkassignLeaveView()
    {
        $leave_type = LeaveType::all();
        $dept = JobCategory::all();
        return view('HRM/Leave/BulkAssignLeave')->with('leave_type', $leave_type)->with('dept', $dept);
    }
    public function assignLeaveView()
    {
        $leave_type = LeaveType::all();
        $dept = Employee::all();
        return view('HRM/Leave/AssignLeave')->with('leave_type', $leave_type)->with('dept', $dept);
    }
    public function MyLeaveReportView()
    {
        $now = Carbon::now();
        $leave_type = Entitlement::where('emp_id', Auth::user()->emp_id)->where('leave_period', $now->year)->with('type')->where('leave_balance', '!=', 0)->get();
        $leave_blc = Entitlement::where('emp_id', Auth::user()->emp_id)->first();

        return view('HRM/Leave/MyLeaveReport')->with('leave_type', $leave_type)->with('leave_blc', $leave_blc);
    }
    public function LeaveReportView()
    {
        $now = Carbon::now();
        $leave_type = Entitlement::where('emp_id', Auth::user()->emp_id)->where('leave_period', $now->year)->with('type')->where('leave_balance', '!=', 0)->get();
        $leave_blc = Entitlement::where('emp_id', Auth::user()->emp_id)->first();

        return view('HRM/Leave/LeaveReport')->with('leave_type', $leave_type)->with('leave_blc', $leave_blc);
    }

    public function saveMyLeave(Request $request)
    {$now = Carbon::now();
        $date1 = Carbon::create($request->get("from_date"));
        $date2 = Carbon::create($request->get("to_date"));
        $interval = $date1->diffInDaysFiltered(function (Carbon $date) {
            return !$date->isWeekend();
        }, $date2);
        $days = $interval + 1;

        $balance = Entitlement::where('emp_id', Auth::user()->emp_id)->where('leave_type', $request->get("leave_type"))->where('leave_period', $request->get("year"))->first();
if($balance != null && $days < $balance->leave_balance ){
    // $save["leave_balance"] = $balance->leave_balance - $days;
    // Entitlement::where('id', $balance->id)->update($save);

    $save = new EmpLeave;
    $save->leave_type = $request->get("leave_type");
    $save->from_date = $request->get("from_date");
    $save->to_date = $request->get("to_date");
    $save->comment = $request->get("comment");
    $save->emp_id =  Auth::user()->emp_id;
    $save->period =  $now->year;
    $save->number_day = $days;
    $save->status = 0;
    $save->save();
}elseif($balance != null && $days > $balance->leave_balance ){
    return Redirect::route('my_leave')->withErrors(['msg' => 'The Message']);
}
else{
    $save = new EmpLeave;
    $save->leave_type = $request->get("leave_type");
    $save->from_date = $request->get("from_date");
    $save->to_date = $request->get("to_date");
    $save->comment = $request->get("comment");
    $save->emp_id =  Auth::user()->emp_id;
    $save->period =  $now->year;
    $save->number_day = $days;
    $save->status = 0;
    $save->save();
}
      
        // return redirect(route('location_list'))->with('success', 'Success Create New Location!');

    }
    public function saveAssignLeave(Request $request)
    {$now = Carbon::now();
        $date1 = Carbon::create($request->get("from_date"));
        $date2 = Carbon::create($request->get("to_date"));
        $interval = $date1->diffInDaysFiltered(function (Carbon $date) {
            return !$date->isWeekend();
        }, $date2);
        $days = $interval + 1;

        $balance = Entitlement::where('emp_id', $request->get("emp_id"))->where('leave_type', $request->get("leave_type"))->where('leave_period', $request->get("year"))->first();

        if ($balance == null) {
            $save = new Entitlement;
            $save->emp_id = $request->get("emp_id");
            $save->leave_type = $request->get("leave_type");
            $save->leave_period = $request->get("year");
            $save->leave_balance = $days;
            $save->save();
            $blc = Entitlement::where('emp_id', $request->get("emp_id"))->where('leave_type', $request->get("leave_type"))->where('leave_period', $request->get("year"))->first();
            $update["leave_balance"] = $blc->leave_balance - $days;
            Entitlement::where('id', $blc->id)->update($update);

            $save = new EmpLeave;
            $save->leave_type = $request->get("leave_type");
            $save->from_date = $request->get("from_date");
            $save->to_date = $request->get("to_date");
            $save->comment = $request->get("comment");
            $save->emp_id =  $request->get("emp_id");
            $save->period =  $now->year;
            $save->number_day = $days;
            $save->status = 2;
            $save->save();
        } else {
            $save["leave_balance"] = $balance->leave_balance - $days;
            Entitlement::where('id', $balance->id)->update($save);

            $save = new EmpLeave;
            $save->leave_type = $request->get("leave_type");
            $save->from_date = $request->get("from_date");
            $save->to_date = $request->get("to_date");
            $save->comment = $request->get("comment");
            $save->emp_id =  $request->get("emp_id");
            $save->period =  $now->year;
            $save->number_day = $days;
            $save->status = 2;
            $save->save();
        }


        return redirect(route('assign_leave'))->with('success', 'Success Create New Location!');
    }

    public function saveBulkAssignLeave(Request $request)
    {$now = Carbon::now();
        $date1 = Carbon::create($request->get("from_date"));
        $date2 = Carbon::create($request->get("to_date"));
        $interval = $date1->diffInDaysFiltered(function (Carbon $date) {
            return !$date->isWeekend();
        }, $date2);
        $days = $interval + 1;

        $balance = Entitlement::where('emp_id', $request->get("emp_id"))->where('leave_type', $request->get("leave_type"))->where('leave_period', $request->get("year"))->first();

        if ($balance == null) {
            $save = new Entitlement;
            $save->emp_id = $request->get("emp_id");
            $save->leave_type = $request->get("leave_type");
            $save->leave_period = $request->get("year");
            $save->leave_balance = $days;
            $save->save();
            $blc = Entitlement::where('emp_id', $request->get("emp_id"))->where('leave_type', $request->get("leave_type"))->where('leave_period', $request->get("year"))->first();
            $update["leave_balance"] = $blc->leave_balance - $days;
            Entitlement::where('id', $blc->id)->update($update);

            $save = new EmpLeave;
            $save->leave_type = $request->get("leave_type");
            $save->from_date = $request->get("from_date");
            $save->to_date = $request->get("to_date");
            $save->comment = $request->get("comment");
            $save->emp_id =  $request->get("emp_id");
            $save->period =  $now->year;
            $save->number_day = $days;
            $save->status = 2;
            $save->save();
        } else {
            $save["leave_balance"] = $balance->leave_balance - $days;
            Entitlement::where('id', $balance->id)->update($save);

            $save = new EmpLeave;
            $save->leave_type = $request->get("leave_type");
            $save->from_date = $request->get("from_date");
            $save->to_date = $request->get("to_date");
            $save->comment = $request->get("comment");
            $save->emp_id =  $request->get("emp_id");
            $save->period =  $now->year;
            $save->number_day = $days;
            $save->status = 2;
            $save->save();
        }


        return redirect(route('assign_leave'))->with('success', 'Success Create New Location!');
    }

    public function myleaveGetData()
    {
        $now = Carbon::now();
        $records = EmpLeave::where('emp_id', Auth::user()->emp_id)->with('type')->where('period',$now->year)->get();


        return DataTables::of($records)
            ->editColumn('leave_type', function ($record) {
                return $record->type->name;
            })
            ->editColumn('date', function ($record) {

                return $record->created_at;
            })
            ->editColumn('from_date', function ($record) {
                return $record->from_date;
            })
            ->editColumn('to_date', function ($record) {
                return $record->to_date;
            })
            ->editColumn('number', function ($record) {
                return "$record->number_day Days";
            })
            ->editColumn('status', function ($record) {
                if ($record->status == 0) {
                    return "Pending Approval";
                } elseif ($record->status == 1) {
                    return "Rejected";
                } elseif ($record->status == 2) {
                    return "Schedulled";
                } elseif ($record->status == 3) {
                    return "Taken";
                }
            })
            ->editColumn('comment', function ($record) {
                return $record->comment;
            })

            ->rawColumns([])

            ->make(true);
    }
    public function myleaveGetDataAPI($id)
    {
        $now = Carbon::now();
        $records = EmpLeave::where('emp_id', $id)->with('type')->where('period',$now->year)->get();

return $records;
    }
    public function myleaveReportGetData()
    {
        $now = Carbon::now();
        $records = EmpLeave::where('emp_id', Auth::user()->emp_id)->with('type')->where('period',$now->year)->groupBy('leave_type')->get();


        return DataTables::of($records)
            ->editColumn('leave_type', function ($record) {
                return $record->type->name;
            })
            ->editColumn('pending', function ($record) use($now){
                $check = EmpLeave::where('emp_id', Auth::user()->emp_id)->where('period',$now->year)->where('status',0)->where('leave_type',$record->leave_type)->first();
                if($check == null){
                    return 0;
                }else{
                    $num = EmpLeave::where('emp_id', Auth::user()->emp_id)->where('period',$now->year)->where('status',0)->where('leave_type',$record->leave_type)->get()->groupBy('leave_type')
                    ->map(function ($row) {
                        return $row->sum('number_day');
                    });
                    return $num[$record->leave_type];
                }
               
            })
            ->editColumn('scheduled', function ($record) use($now) {
                $check = EmpLeave::where('emp_id', Auth::user()->emp_id)->where('period',$now->year)->where('status',2)->where('leave_type',$record->leave_type)->first();
                if($check == null){
                    return 0;
                }else{
                $num = EmpLeave::where('emp_id', Auth::user()->emp_id)->where('period',$now->year)->where('status',2)->where('leave_type',$record->leave_type)->get()->groupBy('leave_type')
                ->map(function ($row) {
                    return $row->sum('number_day');
                });
                return $num[$record->leave_type];
            }
            })
            ->editColumn('entitlement', function ($record) use($now) {
                $ent = Entitlement::where('emp_id', Auth::user()->emp_id)->where('leave_period',$now->year)->where('leave_type',$record->leave_type)->first();
                return $ent->entitlement;
            })
            ->editColumn('balance', function ($record) use($now) {
                $ent = Entitlement::where('emp_id', Auth::user()->emp_id)->where('leave_period',$now->year)->where('leave_type',$record->leave_type)->first();
                return $ent->leave_balance;
            })

            ->rawColumns([])

            ->make(true);
    }
    public function leaveReportGetData()
    {
        $now = Carbon::now();
     
        $records = Employee::all();
        
        

        return DataTables::of($records)
        ->editColumn('emp_first', function ($record) {

            return $record->first_name;
        })
        ->editColumn('emp_middle', function ($record) {
if($record->middle_name != null){
    return $record->middle_name;
}else{
    return "";
}
            
        })
        ->editColumn('emp_last', function ($record) {

            if($record->last_name != null){
                return $record->last_name;
            }else{
                return "";
            }
        })
            ->editColumn('period', function ($record)use($now) {
                return $now->year;
            })
            ->editColumn('pending', function ($record) use($now){
                $check = EmpLeave::where('emp_id', $record->id)->where('period',$now->year)->where('status',0)->first();
                if($check == null){
                    return 0;
                }else{
                    $num = EmpLeave::where('emp_id', $record->id)->where('period',$now->year)->where('status',0)->get()->groupBy('status')
                    ->map(function ($row) {
                        return $row->sum('number_day');
                    });
                    return $num["0"];
                }
               
            })
            ->editColumn('scheduled', function ($record) use($now) {
                $check = EmpLeave::where('emp_id', $record->id)->where('period',$now->year)->where('status',2)->first();
                if($check == null){
                    return 0;
                }else{
                $num = EmpLeave::where('emp_id', $record->id)->where('period',$now->year)->where('status',2)->get()->groupBy('status')
                ->map(function ($row) {
                    return $row->sum('number_day');
                });
                return $num["2"];
            }
            })
            ->editColumn('entitlement', function ($record) use($now) {
                $ent = Entitlement::where('emp_id', $record->id)->where('leave_period',$now->year)->first();
               
                if($ent == null){
                    return 0;
                }else{
                    $num = Entitlement::where('emp_id', $record->id)->where('leave_period',$now->year)->get()->groupBy('emp_id')
                ->map(function ($row) {
                    return $row->sum('entitlement');
                });
                return $num[$record->id];
                }
               
            })
            ->editColumn('balance', function ($record) use($now) {
                $ent = Entitlement::where('emp_id', $record->id)->where('leave_period',$now->year)->first();
               
                if($ent == null){
                    return 0;
                }else{
                    $num = Entitlement::where('emp_id', $record->id)->where('leave_period',$now->year)->get()->groupBy('emp_id')
                ->map(function ($row) {
                    return $row->sum('leave_balance');
                });
                return $num[$record->id];
                }
            })

            ->rawColumns([])

            ->make(true);
    }

    public function leaveGetData(Request $request)
    {     if($request->emp_id == null && $request->type == null && $request->status == null && $request->dept == null ){
        $now = Carbon::now();
        $records = EmpLeave::where('period',$now->year)->with('type')->with('emp')->get();


        return DataTables::of($records)
        ->editColumn('emp_first', function ($record) {

            return $record->emp->first_name;
        })
        ->editColumn('emp_middle', function ($record) {

            return $record->emp->middle_name;
        })
        ->editColumn('emp_last', function ($record) {

            return $record->emp->last_name;
        })
            ->editColumn('leave_type', function ($record) {
                return $record->type->name;
            })
            ->editColumn('date', function ($record) {

                return $record->created_at;
            })
            ->editColumn('from_date', function ($record) {
                return $record->from_date;
            })
            ->editColumn('to_date', function ($record) {
                return $record->to_date;
            })
            ->editColumn('number', function ($record) {
                return "$record->number_day Days";
            })
            ->editColumn('status', function ($record) {
                if ($record->status == 0) {
                    return "Pending Approval";
                } elseif ($record->status == 1) {
                    return "Rejected";
                } elseif ($record->status == 2) {
                    return "Schedulled";
                } elseif ($record->status == 3) {
                    return "Taken";
                }
            })
            ->editColumn('comment', function ($record) {
                return $record->comment;
            })

            ->rawColumns([])

            ->make(true);
    }
        elseif($request->emp_id == 0 && $request->type == 0 && $request->status == 'All' && $request->dept == 0 ){
            $now = Carbon::now();
            $records = EmpLeave::where('period',$now->year)->with('type')->with('emp')->whereBetween('from_date', array($request->from, $request->to))->whereBetween('to_date', array($request->from, $request->to))->get();
    
    
            return DataTables::of($records)
            ->editColumn('emp_first', function ($record) {
    
                return $record->emp->first_name;
            })
            ->editColumn('emp_middle', function ($record) {
    
                return $record->emp->middle_name;
            })
            ->editColumn('emp_last', function ($record) {
    
                return $record->emp->last_name;
            })
                ->editColumn('leave_type', function ($record) {
                    return $record->type->name;
                })
                ->editColumn('date', function ($record) {
    
                    return $record->created_at;
                })
                ->editColumn('from_date', function ($record) {
                    return $record->from_date;
                })
                ->editColumn('to_date', function ($record) {
                    return $record->to_date;
                })
                ->editColumn('number', function ($record) {
                    return "$record->number_day Days";
                })
                ->editColumn('status', function ($record) {
                    if ($record->status == 0) {
                        return "Pending Approval";
                    } elseif ($record->status == 1) {
                        return "Rejected";
                    } elseif ($record->status == 2) {
                        return "Schedulled";
                    } elseif ($record->status == 3) {
                        return "Taken";
                    }
                })
                ->editColumn('comment', function ($record) {
                    return $record->comment;
                })
    
                ->rawColumns([])
    
                ->make(true);
        }elseif($request->type == 0 && $request->status == 'All' && $request->dept == 0){
            $now = Carbon::now();
            $records = EmpLeave::where('period',$now->year)->where('emp_id',$request->emp_id)->with('type')->with('emp')->whereBetween('from_date', array($request->from, $request->to))->whereBetween('to_date', array($request->from, $request->to))->get();
    
    
            return DataTables::of($records)
            ->editColumn('emp_first', function ($record) {
    
                return $record->emp->first_name;
            })
            ->editColumn('emp_middle', function ($record) {
    
                return $record->emp->middle_name;
            })
            ->editColumn('emp_last', function ($record) {
    
                return $record->emp->last_name;
            })
                ->editColumn('leave_type', function ($record) {
                    return $record->type->name;
                })
                ->editColumn('date', function ($record) {
    
                    return $record->created_at;
                })
                ->editColumn('from_date', function ($record) {
                    return $record->from_date;
                })
                ->editColumn('to_date', function ($record) {
                    return $record->to_date;
                })
                ->editColumn('number', function ($record) {
                    return "$record->number_day Days";
                })
                ->editColumn('status', function ($record) {
                    if ($record->status == 0) {
                        return "Pending Approval";
                    } elseif ($record->status == 1) {
                        return "Rejected";
                    } elseif ($record->status == 2) {
                        return "Schedulled";
                    } elseif ($record->status == 3) {
                        return "Taken";
                    }
                })
                ->editColumn('comment', function ($record) {
                    return $record->comment;
                })
    
                ->rawColumns([])
    
                ->make(true);
        }elseif($request->emp_id == 0  && $request->status == 'All' && $request->dept == 0){
            $now = Carbon::now();
            $records = EmpLeave::where('period',$now->year)->where('leave_type',$request->type)->with('type')->with('emp')->whereBetween('from_date', array($request->from, $request->to))->whereBetween('to_date', array($request->from, $request->to))->get();
    
    
            return DataTables::of($records)
            ->editColumn('emp_first', function ($record) {
    
                return $record->emp->first_name;
            })
            ->editColumn('emp_middle', function ($record) {
    
                return $record->emp->middle_name;
            })
            ->editColumn('emp_last', function ($record) {
    
                return $record->emp->last_name;
            })
                ->editColumn('leave_type', function ($record) {
                    return $record->type->name;
                })
                ->editColumn('date', function ($record) {
    
                    return $record->created_at;
                })
                ->editColumn('from_date', function ($record) {
                    return $record->from_date;
                })
                ->editColumn('to_date', function ($record) {
                    return $record->to_date;
                })
                ->editColumn('number', function ($record) {
                    return "$record->number_day Days";
                })
                ->editColumn('status', function ($record) {
                    if ($record->status == 0) {
                        return "Pending Approval";
                    } elseif ($record->status == 1) {
                        return "Rejected";
                    } elseif ($record->status == 2) {
                        return "Schedulled";
                    } elseif ($record->status == 3) {
                        return "Taken";
                    }
                })
                ->editColumn('comment', function ($record) {
                    return $record->comment;
                })
    
                ->rawColumns([])
    
                ->make(true);
        }elseif($request->emp_id == 0 && $request->type == 0 && $request->dept == 0 ){
            $now = Carbon::now();
            $records = EmpLeave::where('period',$now->year)->where('status',$request->status)->with('type')->with('emp')->whereBetween('from_date', array($request->from, $request->to))->whereBetween('to_date', array($request->from, $request->to))->get();
    
    
            return DataTables::of($records)
            ->editColumn('emp_first', function ($record) {
    
                return $record->emp->first_name;
            })
            ->editColumn('emp_middle', function ($record) {
    
                return $record->emp->middle_name;
            })
            ->editColumn('emp_last', function ($record) {
    
                return $record->emp->last_name;
            })
                ->editColumn('leave_type', function ($record) {
                    return $record->type->name;
                })
                ->editColumn('date', function ($record) {
    
                    return $record->created_at;
                })
                ->editColumn('from_date', function ($record) {
                    return $record->from_date;
                })
                ->editColumn('to_date', function ($record) {
                    return $record->to_date;
                })
                ->editColumn('number', function ($record) {
                    return "$record->number_day Days";
                })
                ->editColumn('status', function ($record) {
                    if ($record->status == 0) {
                        return "Pending Approval";
                    } elseif ($record->status == 1) {
                        return "Rejected";
                    } elseif ($record->status == 2) {
                        return "Schedulled";
                    } elseif ($record->status == 3) {
                        return "Taken";
                    }
                })
                ->editColumn('comment', function ($record) {
                    return $record->comment;
                })
    
                ->rawColumns([])
    
                ->make(true);
        }elseif( $request->status == 'All' ){
            $now = Carbon::now();
       
          

            $records = EmpLeave::where('period',$now->year)->where('emp_id',$request->emp_id)->where('leave_type',$request->type)->with('type')->with('emp')->whereBetween('from_date', array($request->from, $request->to))->whereBetween('to_date', array($request->from, $request->to))->get();
    
    
            return DataTables::of($records)
            ->editColumn('emp_first', function ($record) {
    
                return $record->emp->first_name;
            })
            ->editColumn('emp_middle', function ($record) {
    
                return $record->emp->middle_name;
            })
            ->editColumn('emp_last', function ($record) {
    
                return $record->emp->last_name;
            })
                ->editColumn('leave_type', function ($record) {
                    return $record->type->name;
                })
                ->editColumn('date', function ($record) {
    
                    return $record->created_at;
                })
                ->editColumn('from_date', function ($record) {
                    return $record->from_date;
                })
                ->editColumn('to_date', function ($record) {
                    return $record->to_date;
                })
                ->editColumn('number', function ($record) {
                    return "$record->number_day Days";
                })
                ->editColumn('status', function ($record) {
                    if ($record->status == 0) {
                        return "Pending Approval";
                    } elseif ($record->status == 1) {
                        return "Rejected";
                    } elseif ($record->status == 2) {
                        return "Schedulled";
                    } elseif ($record->status == 3) {
                        return "Taken";
                    }
                })
                ->editColumn('comment', function ($record) {
                    return $record->comment;
                })
    
                ->rawColumns([])
    
                ->make(true);
        }elseif( $request->type == 0 ){
            $now = Carbon::now();
       
          

            $records = EmpLeave::where('period',$now->year)->where('emp_id',$request->emp_id)->where('status',$request->status)->with('type')->with('emp')->whereBetween('from_date', array($request->from, $request->to))->whereBetween('to_date', array($request->from, $request->to))->get();
    
    
            return DataTables::of($records)
            ->editColumn('emp_first', function ($record) {
    
                return $record->emp->first_name;
            })
            ->editColumn('emp_middle', function ($record) {
    
                return $record->emp->middle_name;
            })
            ->editColumn('emp_last', function ($record) {
    
                return $record->emp->last_name;
            })
                ->editColumn('leave_type', function ($record) {
                    return $record->type->name;
                })
                ->editColumn('date', function ($record) {
    
                    return $record->created_at;
                })
                ->editColumn('from_date', function ($record) {
                    return $record->from_date;
                })
                ->editColumn('to_date', function ($record) {
                    return $record->to_date;
                })
                ->editColumn('number', function ($record) {
                    return "$record->number_day Days";
                })
                ->editColumn('status', function ($record) {
                    if ($record->status == 0) {
                        return "Pending Approval";
                    } elseif ($record->status == 1) {
                        return "Rejected";
                    } elseif ($record->status == 2) {
                        return "Schedulled";
                    } elseif ($record->status == 3) {
                        return "Taken";
                    }
                })
                ->editColumn('comment', function ($record) {
                    return $record->comment;
                })
    
                ->rawColumns([])
    
                ->make(true);
        }elseif( $request->emp_id == 0 ){
            $now = Carbon::now();
       
          

            $records = EmpLeave::where('period',$now->year)->where('leave_type',$request->type)->where('status',$request->status)->with('type')->with('emp')->whereBetween('from_date', array($request->from, $request->to))->whereBetween('to_date', array($request->from, $request->to))->get();
    
    
            return DataTables::of($records)
            ->editColumn('emp_first', function ($record) {
    
                return $record->emp->first_name;
            })
            ->editColumn('emp_middle', function ($record) {
    
                return $record->emp->middle_name;
            })
            ->editColumn('emp_last', function ($record) {
    
                return $record->emp->last_name;
            })
                ->editColumn('leave_type', function ($record) {
                    return $record->type->name;
                })
                ->editColumn('date', function ($record) {
    
                    return $record->created_at;
                })
                ->editColumn('from_date', function ($record) {
                    return $record->from_date;
                })
                ->editColumn('to_date', function ($record) {
                    return $record->to_date;
                })
                ->editColumn('number', function ($record) {
                    return "$record->number_day Days";
                })
                ->editColumn('status', function ($record) {
                    if ($record->status == 0) {
                        return "Pending Approval";
                    } elseif ($record->status == 1) {
                        return "Rejected";
                    } elseif ($record->status == 2) {
                        return "Schedulled";
                    } elseif ($record->status == 3) {
                        return "Taken";
                    }
                })
                ->editColumn('comment', function ($record) {
                    return $record->comment;
                })
    
                ->rawColumns([])
    
                ->make(true);
        }
        
    }
}
