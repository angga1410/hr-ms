<?php

namespace App\Http\Controllers\Leave\Configuration;

use App\Http\Controllers\Controller;
use App\Model\Leave\Holiday;
use App\Model\Leave\LeaveType;
use Illuminate\Http\Request;
use Auth;
use GuzzleHttp\Client;
use Yajra\DataTables\DataTables;

class ConfigurationController extends Controller
{
    public function LeaveTypeListView(){
        return view('HRM/Leave/Configuration/LeaveTypeList');
    }
    public function HolidayListView(){
        return view('HRM/Leave/HolidayList');
    }

//     public function generateHoliday(){
//         $client = new Client();
//     $request = $client->get('https://kalenderindonesia.com/api/APIUb20111pwj/libur/masehi/2022');
//     $response = $request->getBody();
//     $array = collect(json_decode($response, true));

// // dd($array["data"]["holiday"]);
//     // return view('HRM/Leave/Configuration/LeaveTypeList');
// $date = [];
//  foreach($array["data"]["holiday"] as $get){
//     $date[] = ['holiday' => $get];
   
//  }
//  $date2 = [];
//  foreach($date as $gett){
//     $date2[] = ['holiday' => $gett["holiday"]["data"]];
   
//  }

//  return DataTables::of($date2)
//  ->editColumn('holiday', function ($record) {
//     return $record['holiday'];
//  })


//  ->rawColumns(['holiday'])

//  ->make(true);

//     }

    public function saveLeaveType(Request $request)
    {
        $save = new LeaveType;
        $save->name = $request->get("name");
        $save->note = $request->get("note");
        $save->is_entitlement = $request->get("is_entitlement");
        $save->status = 0;
        $save->save();
        // return redirect(route('location_list'))->with('success', 'Success Create New Location!');

    }

    public function saveHoliday(Request $request)
    {
        $save = new Holiday;
        $save->date = $request->get("date");
        $save->info = $request->get("info");
        $save->type = $request->get("type");
        $save->status = 0;
        $save->save();

    }

    public function leavetypeID($id){
        $type = LeaveType::where('id',$id)->first();
        return $type;
    }
    public function updateType(Request $request)
    {
        $id = $request->get("id");
        $save["name"] = $request->get("name");
        $save["note"] = $request->get("note");
        $save["is_entitlement"] = $request->get("is_entitlement");
        LeaveType::where('id', $id)->update($save);
    }
    public function deleteholiday($id){
Holiday::where('id',$id)->delete();
return view('HRM/Leave/HolidayList');
    }
    public function leavetypeGetData()
    {
       
        $records = LeaveType::query();


        return Datatables::of($records)
            ->editColumn('id', function ($record) {
   
                return $record->id;
            })
            ->editColumn('name', function ($record) {
   
                return $record->name;
            })
            ->editColumn('note', function ($record) {
   
                return $record->note;
            })
            ->editColumn('is_entitlement', function ($record) {
   if($record->is_entitlement == 0){
    return "No";
   }
   else{
       return "Yes";
   }
                return $record->note;
            })

            ->editColumn('status', function ($record) {
                
                    return '
                   <button class="btn btn-secondary" onclick="updatevacancies(' . $record->id . ')" >
                       Edit
                   </button>

               ';
            })
        
            ->rawColumns(['status'])

            ->make(true);
    }

    public function holidayGetData()
    {
       
        $records = Holiday::query();


        return Datatables::of($records)
            ->editColumn('date', function ($record) {
   
                return $record->date;
            })
            ->editColumn('info', function ($record) {
   
                return $record->info;
            })
            ->editColumn('type', function ($record) {
                if($record->type == 0){
                 return "Cuti Bersama";
                }
                else{
                    return "Libur Nasional";
                }
                             return $record->note;
                         })
                         ->editColumn('status', function ($record) {
                       
                            return  "<a href='" . route('delete_holiday', $record->id) . "'> <button class='btn btn-secondary'>
                            Delete
                        </button></a>";
                          
                        })
        
            ->rawColumns(['status'])

            ->make(true);
    }

    public function holidayGetDataAPI($year)
    {
       
        $records = Holiday::whereYear('date',$year)->select('date','info')->get();
       return $records;
    }
}
