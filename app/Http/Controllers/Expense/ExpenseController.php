<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Model\Expense\ExpenseConfig;
use App\Model\PIM\Employee;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{
    public function ExpenseTypeView(){
        return view('HRM/Expense/ConfigExpense');
    }
    public function AddNewExpenseView(){
        $user =  Auth::user()->emp_id;
        $emp = Employee::where('id',$user)->first();
        $type = ExpenseConfig::where('status',0)->get();
        return view('HRM/Expense/AddNewExpense')->with('emp',$emp)->with('type',$type);
    }

    public function saveExpenseConfig(Request $request)
    {
        $save = new ExpenseConfig;
        $save->name = $request->get("name");
        $save->expense_group = $request->get("expense_group");
        $save->status = 0;
        $save->save();
     
    }

    public function updateStatus(Request $request)
    {
        $id = $request->get("id");
        $save["status"] = $request->get("status");
        ExpenseConfig::where('id', $id)->update($save);
    }

    public function expenseconfigData()
    {
       
        $records = ExpenseConfig::query();


        return Datatables::of($records)
            ->editColumn('name', function ($record) {
   
                return $record->name;
            })
            ->editColumn('expense_group', function ($record) {
   
                return $record->expense_group;
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
        
            ->rawColumns(['status'])

            ->make(true);
    }
}
