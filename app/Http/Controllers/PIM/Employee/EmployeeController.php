<?php

namespace App\Http\Controllers\PIM\Employee;

use App\Http\Controllers\Controller;
use App\Model\Admin\Education;
use App\Model\Admin\JobCategory;
use App\Model\Admin\JobTitle;
use App\Model\Admin\Location;
use App\Model\Admin\Nationality;
use App\Model\Admin\Skill;
use App\Model\Admin\WorkShift;
use App\Model\PIM\Employee;
use App\Model\PIM\EmployeeAcc;
use App\Model\PIM\EmployeeContact;
use App\Model\PIM\EmployeeEdu;
use App\Model\PIM\EmployeeExp;
use App\Model\PIM\EmployeeFam;
use App\Model\PIM\EmployeeSkill;
use App\Model\PIM\EmployeeStatus;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use File;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Http;

class EmployeeController extends Controller
{
    public function test(){
        FacadesFile::delete('DataEmp/EmpPic/QRkllMnlfUt4ThjxnUqkyAPj5XO8xmcg.webp');
    }
    public function AddEmployee()
    {    $response = Http::post('http://18.141.137.82/hierarchy_modular/hr_kpi/getHierarchy');
        $records = $response->json();
        $location = Location::where('status',0)->get();
        $national = Nationality::where('status',1)->get();
        $jobtitle = JobTitle::where('status',0)->get();
        $jobcategory = JobCategory::where('status',0)->get();
        $employeestatus = EmployeeStatus::where('status',0)->get();
        $workshift = WorkShift::where('status',0)->get();
        $supervisor = Employee::all();
        return view('HRM/PIM/Employee/AddEmployee')->with('location', $location)->with('national', $national)->with('jobtitle', $jobtitle)->with('jobcategory', $jobcategory)->with('employeestatus', $employeestatus)->with('workshift', $workshift)->with('supervisor', $supervisor);
    }

    public function ListView()
    {  $location = Location::all();
       
        $jobtitle = JobTitle::all();
        $jobcategory = JobCategory::all();
        $employeestatus = EmployeeStatus::all();
      
        return view('HRM/PIM/Employee/List')->with('location', $location)->with('jobtitle', $jobtitle)->with('jobcategory', $jobcategory)->with('employeestatus', $employeestatus);
    }
    public function ViewEmp($id)
    {   
        $data = Employee::where('id',$id)->with('supervisor')->with('job')->first();
        $contact = EmployeeContact::where('emp_id',$id)->first();
        if($contact == null){
            $save = new EmployeeContact;
            $save->emp_id = $id;
            $save->status = 0;
            $save->save();
            EmployeeContact::where('emp_id',$id)->first();
            $contact = EmployeeContact::where('emp_id',$id)->first();
        }
        $location = Location::where('status',0)->get();
        $national = Nationality::all();
        $jobtitle = JobTitle::where('status',0)->get();
        $jobcategory = JobCategory::where('status',0)->get();
        $employeestatus = EmployeeStatus::where('status',0)->get();
        $workshift = WorkShift::where('status',0)->get();
        $supervisor = Employee::where('is_supervisor',1)->get();
        $skill = Skill::all();
        $education = Education::where('status',0)->get();

        return view('HRM/PIM/Employee/ViewEmployee')
        ->with('data',$data)
        ->with('contact',$contact)
        ->with('location', $location)
        ->with('national', $national)
        ->with('jobtitle', $jobtitle)
        ->with('jobcategory', $jobcategory)
        ->with('employeestatus', $employeestatus)
        ->with('workshift', $workshift)
        ->with('supervisor', $supervisor)
        ->with('skill', $skill)
        ->with('education', $education);
    }

    public function saveEmployee(Request $request)
    {
        $save = new Employee;
        $save->first_name = $request->get("first_name");
        $save->middle_name = $request->get("middle_name");
        $save->last_name = $request->get("last_name");
        $save->emp_num = $request->get("emp_num");
        $save->emp_location = $request->get("emp_location");
        $save->emp_other_id = $request->get("emp_other_id");
        $save->emp_birth = $request->get("emp_birth");
        $save->emp_place_birth = $request->get("emp_place_birth");
        $save->emp_marital = $request->get("emp_marital");
        $save->emp_gender = $request->get("emp_gender");
        $save->emp_nationality = $request->get("emp_nationality");
        $save->emp_drive_license = $request->get("emp_drive_license");
        $save->emp_blood_grp = $request->get("emp_blood_grp");
        $save->emp_hobbies = $request->get("emp_hobbies");
        $save->emp_join_date = $request->get("emp_join_date");
        $save->emp_date_permanency = $request->get("emp_date_permanency");
        $save->emp_job_title = $request->get("emp_job_title");
        $save->bpjs_kes = $request->get("bpjs_kes");
        $save->bpjs_kej = $request->get("bpjs_kej");
        $save->emp_status = $request->get("emp_status");
        $save->emp_job_ctg = $request->get("emp_job_ctg");
        $save->emp_sub_unit = $request->get("emp_sub_unit");
        $save->emp_work_shift = $request->get("emp_work_shift");
        $save->emp_effective_date = $request->get("emp_effective_date");
        $save->emp_note = $request->get("emp_note");
        $save->emp_contract_start = $request->get("emp_contract_start");
        $save->emp_contract_end = $request->get("emp_contract_end");
        if($request->get("emp_supervisor") == null){
            $save->emp_supervisor_id = 0;
        }
        else{
            $save->emp_supervisor_id = $request->get("emp_supervisor");
        }   
        $save->is_supervisor = $request->get("is_supervisor");

        $save->status = 0;
        $save->created_by = Auth::User()->name;
        if($request->file('emp_pic') != null){
            $save->emp_pic =  $this->uploadImage($save, $request->file('emp_pic'));
        }
        $save->save();
        return redirect(route('list_employee'))->with('success', 'Success Create New Employee!');
    }
    private function uploadImage($save, $emp_pic)
    {
        $imagePath   = '';
        if ($emp_pic && $emp_pic->isValid()) {

            $destinationPath = 'DataEmp/EmpPic/';
            $extension = $emp_pic->getClientOriginalExtension();
            $imageName = Str::random(10) . '.' . $extension;

            if ($emp_pic->move($destinationPath, $imageName)) {
                $imagePath = $destinationPath . $imageName;
            }

            $abc = $imagePath;
        }

        return $abc;
    }

    public function imgUpdate(Request $request)
    {     $id = $request->get("id");
   
        if($request->get('emp_pic') == "0"){
            $save["emp_pic"] =  $this->updateImage( $request->file('emp_pic_new'));
            Employee::where('id',$id)->update($save);

        }
        else{
            FacadesFile::delete($request->get("emp_pic"));
            $save["emp_pic"] =  $this->updateImage( $request->file('emp_pic_new'));
         
            Employee::where('id',$id)->update($save);
        }
        return redirect()->to('/pim/view-employee/'.$id);
    }
    private function updateImage( $emp_pic)
    {
        $imagePath   = '';
        if ($emp_pic && $emp_pic->isValid()) {

            $destinationPath = 'DataEmp/EmpPic/';
            $extension = $emp_pic->getClientOriginalExtension();
            $imageName = Str::random(10) . '.' . $extension;

            if ($emp_pic->move($destinationPath, $imageName)) {
                $imagePath = $destinationPath . $imageName;
            }

            $abc = $imagePath;
        }

        return $abc;
    }
   
    public function personalUpdate(Request $request){
        $id = $request->get("id");
          $save["emp_num"] = $request->get("emp_num");
        $save["first_name"] = $request->get("first_name");
        $save["middle_name"] = $request->get("middle_name");
        $save["last_name"] = $request->get("last_name");
        $save["emp_birth"] = $request->get("emp_birth");
        $save["emp_other_id"] = $request->get("emp_other_id");
        $save["emp_birth"] = $request->get("emp_birth");
        $save["emp_place_birth"] = $request->get("emp_place_birth");
        $save["emp_marital"] = $request->get("emp_marital");
        $save["emp_gender"] = $request->get("emp_gender");
        $save["emp_nationality"] = $request->get("emp_nationality");
        $save["emp_drive_license"] = $request->get("emp_drive_license");
        $save["emp_blood_grp"] = $request->get("emp_blood_grp");
        $save["emp_hobbies"] = $request->get("emp_hobbies");
        Employee::where('id',$id)->update($save);

    }
    public function jobUpdate(Request $request){
        $id = $request->get("id");
        $save["emp_join_date"] = $request->get("emp_join_date");
        $save["emp_date_permanency"] = $request->get("emp_date_permanency");
        $save["emp_job_title"] = $request->get("emp_job_title");
        $save["emp_location"] = $request->get("emp_location");
        $save["emp_status"] = $request->get("emp_status");
        $save["emp_job_ctg"] = $request->get("emp_job_ctg");
        $save["emp_sub_unit"] = $request->get("emp_sub_unit");
        $save["bpjs_kes"] = $request->get("bpjs_kes");
        $save["bpjs_kej"] = $request->get("bpjs_kej");
        $save["emp_work_shift"] = $request->get("emp_work_shift");
        $save["emp_effective_date"] = $request->get("emp_effective_date");
        $save["emp_contract_start"] = $request->get("emp_contract_start");
        $save["emp_contract_end"] = $request->get("emp_contract_end");
        $save["emp_supervisor_id"] = $request->get("emp_supervisor_id");
        $save["is_supervisor"] = $request->get("is_supervisor");
      
   
        Employee::where('id',$id)->update($save);

    }
    public function saveContactEmp(Request $request){
        $id = $request->get("id");
        $save["address1"] = $request->get("address1");
        $save["address2"] = $request->get("address2");
        $save["city"] = $request->get("city"); 
        $save["province"] = $request->get("province");
        $save["zipcode"] = $request->get("zipcode");
        $save["hp"] = $request->get("hp");
        $save["wa"] = $request->get("wa");
        $save["home_tlp"] = $request->get("home_tlp");
        $save["email"] = $request->get("email");
        $save["work_email"] = $request->get("work_email");
        $save["emc_contact_name"] = $request->get("emc_contact_name");
        $save["emc_contact_phone"] = $request->get("emc_contact_phone");
        $save["relationship"] = $request->get("relationship");
        EmployeeContact::where('emp_id',$id)->update($save);
    }

    public function employeeGetData()
    {

        $records = Employee::with('job', 'empstatus','supervisor','location')->get();
     

        return Datatables::of($records)
            ->editColumn('emp_num', function ($record) {
                return $record->emp_num;
            })
            ->editColumn('first_name', function ($record) {

                return  "<a href='" . route('view_employee', $record->id) . "'>$record->first_name&nbsp$record->middle_name&nbsp$record->last_name</a>";
            })
            ->editColumn('job_title', function ($record) {
                return $record->job->job_title;
            })
            ->editColumn('departement', function ($record) {
                return $record->departement->name;
            })
            ->editColumn('emp_status', function ($record) {
                return $record->empstatus->name;
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

            ->rawColumns(['emp_id', 'first_name', 'job_title','emp_status'])

            ->make(true);
    }

    public function employeeGetDataHierarchy()
    {

        $records = Employee::where('hierarchy_id','!=',null)->with('job', 'empstatus','position','location')->get();
     

        return Datatables::of($records)
            ->editColumn('emp_num', function ($record) {
                return $record->emp_num;
            })
            ->editColumn('first_name', function ($record) {

                return  "<a href='" . route('view_employee', $record->id) . "'>$record->first_name&nbsp$record->middle_name&nbsp$record->last_name</a>";
            })
            ->editColumn('job_title', function ($record) {
                return $record->job->job_title;
            })
            ->editColumn('departement', function ($record) {
                return $record->position->name;
            })
            ->editColumn('emp_status', function ($record) {
                return $record->empstatus->name;
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

            ->rawColumns(['emp_id', 'first_name', 'job_title','emp_status'])

            ->make(true);
    }

    public function saveEmployeeStatus(Request $request)
    {
        $save = new EmployeeStatus;
        $save->name = $request->get("name");
        $save->status = 0;
        $save->save();
        // return redirect(route('location_list'))->with('success', 'Success Create New Location!');

    }
    public function employeeStatusUpdateStatus(Request $request)
    {
        $id = $request->get("id");
        $save["status"] = $request->get("status");
        EmployeeStatus::where('id', $id)->update($save);
    }
    public function saveEmployeeExp(Request $request)
    {
        $save = new EmployeeExp;
        $save->emp_id = $request->get("emp_id");
        $save->company = $request->get("company");
        $save->job_title = $request->get("job_title");
        $save->from_date = $request->get("from_date");
        $save->to_date = $request->get("to_date");
      
        $save->save();
        // return redirect(route('location_list'))->with('success', 'Success Create New Location!');

    }
    public function saveEmployeeFam(Request $request)
    {
        $save = new EmployeeFam;
        $save->emp_id = $request->get("emp_id");
        $save->name = $request->get("name");
        $save->relationship = $request->get("relationship");
        $save->save();
        // return redirect(route('location_list'))->with('success', 'Success Create New Location!');

    }
    public function saveEmployeeAcc(Request $request)
    {
        $save = new EmployeeAcc;
        $save->emp_id = $request->get("emp_id");
        $save->bank_name = $request->get("bank_name");
        $save->account_number = $request->get("account_number");
        $save->in_name = $request->get("in_name");
        $save->save();
        // return redirect(route('location_list'))->with('success', 'Success Create New Location!');

    }
    public function saveEmployeeEdu(Request $request)
    {
        $save = new EmployeeEdu;
        $save->emp_id = $request->get("emp_id");
        $save->level = $request->get("level");
        $save->school = $request->get("school");
        $save->major = $request->get("major");
        $save->year = $request->get("year");
        $save->gpa = $request->get("gpa");
        $save->save();
        // return redirect(route('location_list'))->with('success', 'Success Create New Location!');

    }
    public function saveEmployeeSkill(Request $request)
    {
        $save = new EmployeeSkill;
        $save->emp_id = $request->get("emp_id");
        $save->skill = $request->get("skill");
        $save->save();
        // return redirect(route('location_list'))->with('success', 'Success Create New Location!');

    }
    public function deleteEmployeeExp($id)
    {
        EmployeeExp::destroy($id);
    }
    public function deleteEmployeeEdu($id)
    {
        EmployeeEdu::destroy($id);
    }
    public function deleteEmployeeSkill($id)
    {
        EmployeeSkill::destroy($id);
    }
    public function deleteEmployeeFam($id)
    {
        EmployeeFam::destroy($id);
    }
    public function deleteEmployeeAcc($id)
    {
        EmployeeAcc::destroy($id);
    }
    public function employeestatusGetData()
    {

        $records = EmployeeStatus::query();


        return Datatables::of($records)
            ->editColumn('id', function ($record) {

                return $record->id;
            })
            ->editColumn('name', function ($record) {

                return $record->name;
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
    public function employeeexpGetData($id)
    {

        $records = EmployeeExp::where('emp_id',$id)->get();


        return Datatables::of($records)
            ->editColumn('id', function ($record) {

                return $record->id;
            })
            ->editColumn('company', function ($record) {

                return $record->company;
            })
            ->editColumn('job_title', function ($record) {

                return $record->job_title;
            })
            ->editColumn('from_date', function ($record) {

                return $record->from_date;
            })
            ->editColumn('to_date', function ($record) {

                return $record->to_date;
            })
            ->editColumn('action', function ($record) {

                return '
                          &nbsp&nbsp&nbsp&nbsp&nbsp
                          <button class="btn btn-danger" onclick="delExp('.$record->id.')" >
                              delete
                          </button>

                      ';
            })

            ->rawColumns(['action'])

            ->make(true);
    }

    public function employeeeduGetData($id)
    {

        $records = EmployeeEdu::where('emp_id',$id)->get();


        return Datatables::of($records)
            ->editColumn('id', function ($record) {

                return $record->id;
            })
            ->editColumn('level', function ($record) {

                return $record->level;
            })
            ->editColumn('school', function ($record) {

                return $record->school;
            })
            ->editColumn('major', function ($record) {

                return $record->major;
            })
            ->editColumn('year', function ($record) {

                return $record->year;
            })
            ->editColumn('gpa', function ($record) {

                return $record->gpa;
            })
            ->editColumn('action', function ($record) {

                return '
                          &nbsp&nbsp&nbsp&nbsp&nbsp
                          <button class="btn btn-danger" onclick="delEdu('.$record->id.')" >
                              delete
                          </button>

                      ';
            })

            ->rawColumns(['action'])

            ->make(true);
    }
    public function employeeskillGetData($id)
    {

        $records = EmployeeSkill::where('emp_id',$id)->with('skills')->get();


        return Datatables::of($records)
            ->editColumn('id', function ($record) {

                return $record->id;
            })
            ->editColumn('skill', function ($record) {

                return $record->skills->name;
            })
            ->editColumn('desc', function ($record) {

                return $record->skills->desc_skill;
            }) 
            ->editColumn('action', function ($record) {

                return '
                          &nbsp&nbsp&nbsp&nbsp&nbsp
                          <button class="btn btn-danger" onclick="delSkill('.$record->id.')" >
                              delete
                          </button>

                      ';
            })

            ->rawColumns(['action'])

            ->make(true);
    }
    public function employeefamGetData($id)
    {

        $records = EmployeeFam::where('emp_id',$id)->get();


        return Datatables::of($records)
            ->editColumn('id', function ($record) {

                return $record->id;
            })
            ->editColumn('name', function ($record) {

                return $record->name;
            })
            ->editColumn('relationship', function ($record) {

                return $record->relationship;
            }) 
            ->editColumn('action', function ($record) {

                return '
                          &nbsp&nbsp&nbsp&nbsp&nbsp
                          <button class="btn btn-danger" onclick="delFam('.$record->id.')" >
                              delete
                          </button>

                      ';
            })

            ->rawColumns(['action'])

            ->make(true);
    }
    public function employeeaccGetData($id)
    {

        $records = EmployeeAcc::where('emp_id',$id)->get();


        return Datatables::of($records)
            ->editColumn('id', function ($record) {

                return $record->id;
            })
            ->editColumn('bank_name', function ($record) {

                return $record->bank_name;
            })
            ->editColumn('account_number', function ($record) {

                return $record->account_number;
            }) 
            ->editColumn('in_name', function ($record) {

                return $record->in_name;
            }) 
            ->editColumn('action', function ($record) {

                return '
                          &nbsp&nbsp&nbsp&nbsp&nbsp
                          <button class="btn btn-danger" onclick="delAcc('.$record->id.')" >
                              delete
                          </button>

                      ';
            })

            ->rawColumns(['action'])

            ->make(true);
    }

    public function EmpListAPI(){
        $records = Employee::with('contact')->select('first_name', 'middle_name','last_name','hierarchy_id','id')->get();
        return $records;
    }

    public function EmpJobAPI(){
        $records = Employee::with('job')->select('first_name', 'middle_name','last_name','id')->get();
        return $records;
    }

    public function EmpDetailListAPI(){
        $records = Employee::with('job','departement','location')->get();
        return $records;
    }
    public function EmpDetailByIdAPI($id){
        $records = Employee::with('job','departement','location')->where('id',$id)->get();
        return $records;
    }

}
