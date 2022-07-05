<?php

namespace App\Http\Controllers\Admin\Organization;

use App\Http\Controllers\Controller;
use App\Model\Admin\Location;
use App\Model\Admin\Nationality;
use Illuminate\Http\Request;
use Auth;
use Yajra\DataTables\DataTables;

class OrganizationHierarchyController extends Controller
{
    public function OrganizationViewerView(){
       
        return view('HRM/Admin/Organization/OrganizationViewer');
    }
    
    public function OrganizationViewerViewV2(){
       
        return view('HRM/Admin/Organization/OrganizationViewerV2');
    }
    
    public function OrganizationViewerViewV3(){
       
        return view('HRM/Admin/Organization/OrganizationViewerV3');
    }
    
    public function OrganizationSetupView(){
       
        return view('HRM/Admin/Organization/OrganizationSetup');
    }
    
    public function OnePageSettingsView(){
       
        return view('HRM/Admin/Organization/OnePageSettings');
    }
    
    public function EmployeeView(){
       
        return view('HRM/Admin/Organization/Employee');
    }
    
    public function NationalHolidaysView(){
       
        return view('HRM/Admin/Organization/NationalHolidays');
    }
    
    public function saveLocation(Request $request)
        {
            $save = new Location;
            $save->name = $request->get("name");
            $save->country = $request->get("country");
            $save->province = $request->get("province");
            $save->city = $request->get("city");
            $save->zipcode = $request->get("zipcode");
            $save->phone = $request->get("phone");
            $save->fax = $request->get("fax");
            $save->number_emp = $request->get("number_emp");
            $save->address = $request->get("address");
            $save->note = $request->get("note");
            $save->status = 0;
            $save->save();
            // return redirect(route('location_list'))->with('success', 'Success Create New Location!');
    
        }

        public function locationUpdateStatus(Request $request)
        {
            $id = $request->get("id");
            $save["status"] = $request->get("status");
            Location::where('id', $id)->update($save);
        }

        public function locationGetData()
        {
           
            $records = Location::query();
    
    
            return Datatables::of($records)
                ->editColumn('id', function ($record) {
       
                    return $record->id;
                })
                ->editColumn('name', function ($record) {
       
                    return $record->name;
                })
                ->editColumn('country', function ($record) {
       
                    return $record->country;
                })
                ->editColumn('province', function ($record) {
       
                    return $record->province;
                })
                ->editColumn('city', function ($record) {
       
                    return $record->city;
                })
                ->editColumn('phone', function ($record) {
       
                    return $record->phone;
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
    }

