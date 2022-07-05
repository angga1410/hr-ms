<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Model\PIM\Employee;
use App\Model\PIM\UserGet;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserManagementController extends Controller
{
    public function UserListView(){
        $emp = Employee::where('status',0)->get();
        return view('HRM/Admin/UserManagement/UserList')->with('emp',$emp);
    }

    public function UserRoleListView(){
      
        return view('HRM/Admin/UserManagement/UserRoleList');
    }

    public function createUser(Request $request){
        $save = new User;
        $save->name = $request->get("name");
        $save->email = $request->get("email");
        $save->emp_id = $request->get("emp_id");
        $save->password =  Hash::make($request->get("password"));
        $save->save();
    }

    public function GetDataUser()
    {
       
        $records = UserGet::with('emp')->get();


        return DataTables::of($records)
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
            ->editColumn('email', function ($record) {
   
                return $record->email;
            })
            ->editColumn('password', function ($record) {
$pass = Crypt::decrypt($record->password);
dd($pass);
                return $pass;

            })
            // ->editColumn('job_desc', function ($record) {
   
            //     return $record->job_desc;
            // })
            // ->editColumn('status', function ($record) {
            //     if ($record->status == 0) {
            //         return '
            //        <button class="btn btn-success" onclick="updatestatus(' . $record->id . ')" >
            //            Active
            //        </button>

            //    ';
            //     } elseif ($record->status == 1) {
            //         return '
            //     <button class="btn btn-secondary" onclick="updatestatus(' . $record->id . ')" >
            //         Archived
            //     </button>

            // ';
            //     }
            // })
        
            ->rawColumns(['status'])

            ->make(true);
    }
}