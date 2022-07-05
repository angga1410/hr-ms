<?php

namespace App\Http\Controllers\Leave\Entitlements;

use App\Http\Controllers\Controller;
use App\Model\Admin\JobCategory;
use App\Model\Leave\Entitlement;
use App\Model\Leave\LeaveType;
use App\Model\PIM\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class EntitlementController extends Controller
{
    public function addEntitlementView()
    {
        $leave_type = LeaveType::where('is_entitlement',0)->get();
        $emp = Employee::all();
        return view('HRM/Leave/AddEntitlement')->with('leave_type', $leave_type)->with('emp', $emp);
    }

    public function addEntitlementContractView()
    {
        $leave_type = LeaveType::where('is_entitlement',0)->get();
        return view('HRM/Leave/AddEntitlementContract')->with('leave_type', $leave_type);
    }

    public function bulkaddEntitlementView()
    {
        $leave_type = LeaveType::where('is_entitlement',0)->get();
        $dept = JobCategory::all();
        return view('HRM/Leave/BulkAddEntitlement')->with('leave_type', $leave_type)->with('dept', $dept);
    }

    public function listEntitlementView()
    {
        $emp = Employee::all();
        $type = LeaveType::all();
        return view('HRM/Leave/ListEntitlement')->with('emp', $emp)->with('type', $type);
    }

    public function getEmployeebyContract(){
        $time = date('Y-m-d', strtotime('-1 year'));
        $records = Employee::whereDate('emp_join_date','<=',$time)->get();
        // $years = Carbon::parse($emp->emp_join_date)->age; 
        return Datatables::of($records)
        ->editColumn('emp_id', function ($record) {
            return "<input class='form-control' style='width: 50%; bordered: none;' name='emp_id[]' value='" . $record->id . "' hidden>"  ;
        })
            ->editColumn('emp_num', function ($record) {
                return $record->emp_num;
            })
            ->editColumn('first_name', function ($record) {

                return  "$record->first_name&nbsp$record->middle_name&nbsp$record->last_name";
            })
            ->editColumn('job_title', function ($record) {
                return $record->job->job_title;
            })
            ->editColumn('departement', function ($record) {
                return $record->departement->name;
            })
            ->editColumn('emp_status', function ($record) {
                return $record->emp_join_date;
            })
            // ->editColumn('emp_supervisor', function ($record) {
            //     if ($record->is_supervisor == 1){
            //         return "Supervisor";
            //     }
            //     else{
            //         return $record->supervisor->first_name;
            //     }
               
            // })
            ->editColumn('location', function ($record) {
                return $record->location->name;
            })
            

            ->rawColumns(['emp_id', 'first_name', 'job_title','emp_status','balance'])

            ->make(true);
    }


    public function saveEntitlement(Request $request)
    {
        $check = Entitlement::where('emp_id', $request->get("emp_id"))->where('leave_type', $request->get("leave_type"))->where('leave_period', $request->get("leave_period"))->first();

        if ($check == null) {
            $save = new Entitlement;
            $save->emp_id = $request->get("emp_id");
            $save->leave_type = $request->get("leave_type");
            $save->leave_period = $request->get("leave_period");
            $save->leave_balance = $request->get("leave_balance");
            $save->entitlement = $request->get("leave_balance");
            $save->save();
        } else {
            $blc["leave_balance"] = $check->leave_balance + $request->get("leave_balance");
            $blc["entitlement"] = $check->entitlement + $request->get("leave_balance");
            Entitlement::where('id', $check->id)->update($blc);
        }


        return redirect(route('add_entitlement'))->with('success', 'Success Create New Location!');
    }

    public function saveBulkEntitlement(Request $request)
    {
        if ($request->get("dept_id") == 0) {
            $emp_list = Employee::all();
        } else {
            $emp_list = Employee::where('emp_job_ctg', $request->get("dept_id"))->get();
        }


        foreach ($emp_list as $emp) {
            $check = Entitlement::where('emp_id', $emp->id)->where('leave_type', $request->get("leave_type"))->where('leave_period', $request->get("leave_period"))->first();

            if ($check == null) {
                $save = new Entitlement;
                $save->emp_id = $emp->id;
                $save->leave_type = $request->get("leave_type");
                $save->leave_period = $request->get("leave_period");
                $save->leave_balance = $request->get("leave_balance");
                $save->entitlement = $request->get("leave_balance");
                $save->save();
            } else {
                $blc["leave_balance"] = $check->leave_balance + $request->get("leave_balance");
                $blc["entitlement"] = $check->entitlement + $request->get("leave_balance");
                Entitlement::where('id', $check->id)->update($blc);
            }
        }



        return redirect(route('bulk_add_entitlement'))->with('success', 'Success Create New Location!');
    }

    public function saveEntitlementContract(Request $request)
    {
       
    
$emp_list = $request->get("emp_id");

        foreach ($emp_list as $emp) {
          
            $check = Entitlement::where('emp_id', $emp)->where('leave_type', $request->get("leave_type"))->where('leave_period', $request->get("leave_period"))->first();

            if ($check == null) {
                $save = new Entitlement;
                $save->emp_id = $emp;
                $save->leave_type = $request->get("leave_type");
                $save->leave_period = $request->get("leave_period");
                $save->leave_balance = $request->get("leave_balance");
                $save->entitlement = $request->get("leave_balance");
                $save->save();
            } else {
                $blc["leave_balance"] = $check->leave_balance + $request->get("leave_balance");
                $blc["entitlement"] = $check->entitlement + $request->get("leave_balance");
                Entitlement::where('id', $check->id)->update($blc);
            }
        }



        return redirect(route('list_entitlement'))->with('success', 'Success Create New Location!');
    }
    public function entitlementGetData(Request $request)
    {
        if ($request->type == null && $request->emp_id == null && $request->period == null) {
            $records = Entitlement::with('type')->get();


            return DataTables::of($records)
                ->editColumn('leave_type', function ($record) {
                    return $record->type->name;
                })
                ->editColumn('emp_first', function ($record) {

                    return $record->emp->first_name; 
                })
                ->editColumn('emp_middle', function ($record) {
if($record->emp->middle_name != null){
    return $record->emp->middle_name;
}else{return '';

}
                   
                })
                ->editColumn('emp_last', function ($record) {
                    if($record->emp->last_name != null){
                        return $record->emp->last_name;
                    }else{return '';
                    
                    }
                  
                })
                ->editColumn('period', function ($record) {

                    return $record->leave_period;
                })
                ->editColumn('balance', function ($record) {

                    return "$record->leave_balance Days";
                })


                ->rawColumns([])

                ->make(true);
        }
        elseif ($request->type == 0) {
            $records = Entitlement::where('emp_id', $request->emp_id)->where('leave_period', $request->period)->with('type')->get();


            return DataTables::of($records)
                ->editColumn('leave_type', function ($record) {
                    return $record->type->name;
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
                ->editColumn('period', function ($record) {

                    return $record->leave_period;
                })
                ->editColumn('balance', function ($record) {

                    return "$record->leave_balance Days";
                })


                ->rawColumns([])

                ->make(true);
        } else {
            $records = Entitlement::where('emp_id', $request->emp_id)->where('leave_type', $request->type)->where('leave_period', $request->period)->with('type')->get();


            return DataTables::of($records)
                ->editColumn('leave_type', function ($record) {
                    return $record->type->name;
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
                ->editColumn('period', function ($record) {

                    return $record->leave_period;
                })
                ->editColumn('balance', function ($record) {

                    return "$record->leave_balance Days";
                })


                ->rawColumns([])

                ->make(true);
        }
    }
}
