<?php

namespace App\Http\Controllers\Discipline;

use App\Http\Controllers\Controller;
use App\Model\Discipline\DisciplineAction;
use App\Model\Discipline\EmpDiscipline;
use App\Model\PIM\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Auth;
use Illuminate\Support\Str;

class DisciplineController extends Controller
{
    public function DisciplineListView()
 {  $emp = Employee::all();
    $action = DisciplineAction::all();
          return view('HRM/Discipline/DisciplineListView')->with('emp',$emp)->with('action',$action);
 }
 public function ConfigDisciplineActionView()
 {  
          return view('HRM/Discipline/ConfigDisciplineAction');
 }

 public function MyActionListView()
 {  $emp = Employee::all();
          return view('HRM/Discipline/MyActionView')->with('emp',$emp);
 }

 public function saveDiscipline(Request $request){
    $save = new EmpDiscipline;
    $save->emp_id = $request->get("emp_id");
    $save->case_name = $request->get("case_name");
    $save->description = $request->get("description");
    $save->created_by = Auth::User()->emp_id;
    $save->status = 0;
    $save->save();
 }
 public function saveDisciplineAction(Request $request){
    $save = new DisciplineAction;
    $save->name = $request->get("name");
    $save->description = $request->get("description");
    $save->status = 0;
    $save->save();
 }
 
 public function updateAction(Request $request){
    $id = $request->get("id");
    $save["action_id"] = $request->get("action_id");
    $save["from_to"] = $request->get("from_to");
    $save["end_to"] = $request->get("end_to");
    $save["status_action"] = 1;
    $save["status"] = 1;
    $save["acted_by"] = Auth::User()->emp_id;
    EmpDiscipline::where('id',$id)->update($save);
   }
 public function disciplineData()
 {
     // $now = Carbon::now();
     $records = EmpDiscipline::with('emp')->with('create_by')->get();


     return DataTables::of($records)
         ->editColumn('first_name', function ($record) {

             return $record->emp->first_name;
         })
      
         ->editColumn('middle_name', function ($record) {

          return $record->emp->middle_name;
      })
      ->editColumn('last_name', function ($record) {

          return $record->emp->last_name;
      })
      ->editColumn('first_name_emp', function ($record) {

        return $record->create_by->first_name;
    })
 
    ->editColumn('middle_name_emp', function ($record) {

     return $record->create_by->middle_name;
 })
 ->editColumn('last_name_emp', function ($record) {

     return $record->create_by->last_name;
 })
      ->editColumn('case_name', function ($record) {
if($record->status_action == 0){
    return "<a href='#' onclick='updatevacancies(".$record->id.")'>$record->case_name</a>";
}else{
    return "<a href='#' onclick='disciplineaction(".$record->id.")'>$record->case_name</a>";
}
         
      })
      ->editColumn('description', function ($record) {

          return $record->description;
      })
      ->editColumn('created_on', function ($record) {

        return date('d M Y', strtotime($record->created_at)); 
    })
      
         ->editColumn('status', function ($record) {
             if ($record->status == 0) {
                 return '
                 <h6><span class="badge badge-warning">In Progress</span></h6>

             ';
             } elseif ($record->status == 1) {
              return '
              <h6> <span class="badge badge-success">In Action</span></h6>

          ';
             }
             elseif ($record->status == 2) {
              return '
              <h6> <span class="badge badge-primary">Interview Scheduled</span></h6>

          ';
             } 
         })

         ->rawColumns(['status','case_name'])

         ->make(true);
 }

 public function actionData()
 {
     // $now = Carbon::now();
     $records = EmpDiscipline::with('emp')->with('create_by')->get();


     return DataTables::of($records)
         ->editColumn('first_name', function ($record) {

             return $record->emp->first_name;
         })
      
         ->editColumn('middle_name', function ($record) {

          return $record->emp->middle_name;
      })
      ->editColumn('last_name', function ($record) {

          return $record->emp->last_name;
      })
      ->editColumn('first_name_act', function ($record) {
        if($record->acted_by != null){
            return $record->act->first_name;
        }
        else{
            return '';
        }
       
    })
 
    ->editColumn('middle_name_act', function ($record) {
        if($record->acted_by != null){
            return $record->act->middle_name;
        }
        else{
            return '';
        }
       
     
 })
 ->editColumn('last_name_act', function ($record) {
    if($record->acted_by != null){
        return $record->act->last_name;
    }
    else{
        return '';
    }
   
   
 })
 ->editColumn('first_name_emp', function ($record) {

    return $record->create_by->first_name;
})

->editColumn('middle_name_emp', function ($record) {

 return $record->create_by->middle_name;
})
->editColumn('last_name_emp', function ($record) {

 return $record->create_by->last_name;
})

      ->editColumn('description', function ($record) {

          return $record->description;
      })
      ->editColumn('start_date', function ($record) {
if($record->from_to != null){
    return date('d M Y', strtotime($record->from_to)); 
}
else{
    return '';
}
       
    })
    ->editColumn('end_date', function ($record) {
        if($record->end_to != null){
            return date('d M Y', strtotime($record->end_to)); 
        }
        else{
            return '';
        }
        
    })
    ->editColumn('action_id', function ($record) {
        if($record->action_id != null){
            return $record->action->name;
        }
        else{
            return '';
        }
      
    })

      
    ->editColumn('status', function ($record) {
        if ($record->status == 0) {
            return '
            <h6><span class="badge badge-warning">Open</span></h6>

        ';
        } elseif ($record->status == 1) {
         return '
         <h6> <span class="badge badge-success">In Progress </span></h6>

     ';
        }
        elseif ($record->status == 2) {
         return '
         <h6> <span class="badge badge-primary">Interview Scheduled</span></h6>

     ';
        } 
    })

         ->rawColumns(['status'])

         ->make(true);
 }
 
 public function actionDataById($id)
 {
     // $now = Carbon::now();
     $records = EmpDiscipline::where('id',$id)->with('emp')->with('create_by')->get();


     return DataTables::of($records)
         ->editColumn('first_name', function ($record) {

             return $record->emp->first_name;
         })
      
         ->editColumn('middle_name', function ($record) {

          return $record->emp->middle_name;
      })
      ->editColumn('last_name', function ($record) {

          return $record->emp->last_name;
      })
      ->editColumn('first_name_act', function ($record) {
        if($record->acted_by != null){
            return $record->act->first_name;
        }
        else{
            return '';
        }
       
    })
 
    ->editColumn('middle_name_act', function ($record) {
        if($record->acted_by != null){
            return $record->act->middle_name;
        }
        else{
            return '';
        }
       
     
 })
 ->editColumn('last_name_act', function ($record) {
    if($record->acted_by != null){
        return $record->act->last_name;
    }
    else{
        return '';
    }
   
   
 })
 ->editColumn('first_name_emp', function ($record) {

    return $record->create_by->first_name;
})

->editColumn('middle_name_emp', function ($record) {

 return $record->create_by->middle_name;
})
->editColumn('last_name_emp', function ($record) {

 return $record->create_by->last_name;
})

      ->editColumn('description', function ($record) {

          return $record->description;
      })
      ->editColumn('start_date', function ($record) {
if($record->from_to != null){
    return date('d M Y', strtotime($record->from_to)); 
}
else{
    return '';
}
       
    })
    ->editColumn('end_date', function ($record) {
        if($record->end_to != null){
            return date('d M Y', strtotime($record->end_to)); 
        }
        else{
            return '';
        }
        
    })
    ->editColumn('action_id', function ($record) {
        if($record->action_id != null){
            return $record->action->name;
        }
        else{
            return '';
        }
      
    })

      
         ->editColumn('status', function ($record) {
             if ($record->status == 0) {
                 return '
                 <h6><span class="badge badge-warning">Open</span></h6>

             ';
             } elseif ($record->status == 1) {
              return '
              <h6> <span class="badge badge-success">In Progress </span></h6>

          ';
             }
             elseif ($record->status == 2) {
              return '
              <h6> <span class="badge badge-primary">Interview Scheduled</span></h6>

          ';
             } 
         })

         ->rawColumns(['status'])

         ->make(true);
 }

 public function actionConfigData()
 {
    
     $records = DisciplineAction::query();


     return Datatables::of($records)
         ->editColumn('name', function ($record) {

             return $record->name;
         })
         ->editColumn('desc', function ($record) {

             return $record->description;
         })
     
         ->rawColumns([])

         ->make(true);
 }

}
