<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Model\Admin\JobCategory;
use App\Model\Admin\JobTitle;
use App\Model\Admin\Location;
use App\Model\Admin\Nationality;
use App\Model\Admin\WorkShift;
use App\Model\PIM\Employee;
use App\Model\PIM\EmployeeStatus;
use App\Model\Recruitment\Candidate;
use App\Model\Recruitment\CandidateDetail;
use App\Model\Recruitment\Vacancy;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Auth;
use Illuminate\Support\Str;


class RecruitmentController extends Controller
{
    public function resumedownload($id)
    {
        $test = Candidate::where('id', $id)->first();
        if ($test->attachment != null) {
            return response()->download($test->attachment);
        } else {
            return redirect()->back()->with('alert', 'hello');
        }
    }
    public function VacanciesView()
    {
        $location = Location::all();
        $jobtitle = JobTitle::all();
        $jobcategory = JobCategory::all();
        $emp = Employee::all();
        return view('HRM/Recruitment/Vancancies/VancanciesList')
            ->with('location', $location)
            ->with('jobtitle', $jobtitle)
            ->with('jobcategory', $jobcategory)
            ->with('emp', $emp);
    }
    public function CandidateView()
    {
        $location = Location::all();
        $jobtitle = JobTitle::all();
        $jobcategory = JobCategory::all();
        $emp = Employee::all();
        return view('HRM/Recruitment/Candidate/CandidateList')
            ->with('location', $location)
            ->with('jobtitle', $jobtitle)
            ->with('jobcategory', $jobcategory)
            ->with('emp', $emp);
    }
    public function AddCandidateView()
    {
        $vacancy = Vacancy::where('status', 0)->with('location')->get();
        return view('HRM/Recruitment/Candidate/AddNewCandidate')->with('vacancy', $vacancy);
    }
    public function ViewCandidate($id)
    {
        $data = Candidate::where('id', $id)->first();

        $vacancy = Vacancy::where('status', 0)->with('location')->get();
        return view('HRM/Recruitment/Candidate/ViewCandidate')->with('vacancy', $vacancy)->with('data', $data);
    }



    public function saveVacancy(Request $request)
    {
        $save = new Vacancy;
        $save->vacancy_name = $request->get("vacancy_name");
        $save->job_title_id = $request->get("job_title_id");
        $save->sub_unit_id = $request->get("sub_unit_id");
        $save->location_id = $request->get("location_id");
        $save->hiring_manager = $request->get("hiring_manager");
        $save->number_pos = $request->get("number_pos");
        $save->status = 0;
        $save->save();
    }
    public function saveCandidate(Request $request)
    {
        $save = new Candidate;
        $save->first_name = $request->get("first_name");
        $save->last_name = $request->get("last_name");
        $save->middle_name = $request->get("middle_name");
        $save->email = $request->get("email");
        $save->contact_phone = $request->get("contact_phone");
        $save->picture = $this->uploadImage($save, $request->file('picture'));
        $save->facebook = $request->get("facebook");
        $save->twitter = $request->get("twitter");
        $save->linkedin = $request->get("linkedin");
        $save->vacancy_id = $request->get("vacancy_id");
        $save->date_apply = $request->get("date_apply");
        $save->note = $request->get("note");
        $save->attachment = $this->uploadResume($save, $request->file('attachment'));
        $save->status = 0;
        $save->save();

        $detail = new CandidateDetail;
        $detail->candidate_id = $save->id;
        $detail->perform_date = $save->date_apply;
        $detail->action = "" . Auth::User()->name . " added $save->first_name $save->middle_name";
        $detail->save();

        return redirect(route('candidate_view'))->with('success', 'Success Create New Employee!');
    }
    private function uploadImage($save, $emp_pic)
    {
        $imagePath   = '';
        if ($emp_pic && $emp_pic->isValid()) {

            $destinationPath = 'DataEmp/CandidatePic/';
            $extension = $emp_pic->getClientOriginalExtension();
            $imageName = Str::random(10) . '.' . $extension;

            if ($emp_pic->move($destinationPath, $imageName)) {
                $imagePath = $destinationPath . $imageName;
            }

            $abc = $imagePath;
        }

        return $imagePath;
    }
    private function uploadResume($save, $emp_pic)
    {
        $imagePath   = '';
        if ($emp_pic && $emp_pic->isValid()) {

            $destinationPath = 'DataEmp/CandidateResume/';
            $extension = $emp_pic->getClientOriginalExtension();
            $imageName = Str::random(10) . '.' . $extension;

            if ($emp_pic->move($destinationPath, $imageName)) {
                $imagePath = $destinationPath . $imageName;
            }

            $abc = $imagePath;
        }

        return $imagePath;
    }

    public function updateStatus(Request $request)
    {
        $id = $request->get("id");
        $save["status"] = $request->get("status");
        Vacancy::where('id', $id)->update($save);
    }

    public function vacancyData()
    {
        // $now = Carbon::now();
        $records = Vacancy::with('job_title')->with('departement')->with('location')->with('emp')->get();


        return DataTables::of($records)
            ->editColumn('vacancy_name', function ($record) {

                return $record->vacancy_name;
            })
            ->editColumn('job_title', function ($record) {
                return $record->job_title->job_title;
            })
            ->editColumn('departement', function ($record) {
                return $record->departement->name;
            })
            ->editColumn('emp_first', function ($record) {

                return $record->emp->first_name;
            })
            ->editColumn('emp_middle', function ($record) {

                return $record->emp->middle_name;
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
                <button class="btn btn-danger" onclick="updatevacancies(' . $record->id . ')" >
                    Inactive
                </button>

            ';
                }
            })
            ->editColumn('number_pos', function ($record) {
                return $record->number_pos;
            })

            ->rawColumns(['status'])

            ->make(true);
    }

    public function candidateData()
    {
        // $now = Carbon::now();
        $records = Candidate::with('vacancy')->get();


        return DataTables::of($records)
            ->editColumn('first_name', function ($record) {

                return  "<a href='" . route('view_candidate', $record->id) . "'>$record->first_name&nbsp$record->middle_name&nbsp$record->last_name</a>";
            })

            ->editColumn('vacancy', function ($record) {

                return $record->vacancy->vacancy_name;
            })
            ->editColumn('date', function ($record) {

                return $record->date_apply;
            })
            ->editColumn('email', function ($record) {

                return $record->email;
            })
            ->editColumn('contact', function ($record) {

                return $record->contact_phone;
            })
            ->editColumn('hiring_manager_first', function ($record) {

                return $record->vacancy->emp->first_name;
            })
            ->editColumn('hiring_manager_middle', function ($record) {

                return $record->vacancy->emp->middle_name;
            })
            ->editColumn('hiring_manager_last', function ($record) {

                return $record->vacancy->emp->last_name;
            })
            ->editColumn('status', function ($record) {
                if ($record->status == 0) {
                    return '
                   <h6><span class="badge badge-secondary">	Application Initiated</span></h6>

               ';
                } elseif ($record->status == 1) {
                    return '
                <h6> <span class="badge badge-success">Shortlisted</span></h6>

            ';
                } elseif ($record->status == 2) {
                    return '
                <h6> <span class="badge badge-primary">Interview Scheduled</span></h6>

            ';
                }
            })
            ->editColumn('resume', function ($record) {
                return '
               <a href="' . route('resume', $record->id) . '"">
               <button class="btn btn-secondary btn-sm">
                   Download
               </button></a>

           ';
            })

            ->rawColumns(['status', 'resume', 'first_name'])

            ->make(true);
    }

    public function candidatePerformData(Request $request)
    {
        // $now = Carbon::now();
        $records = CandidateDetail::where('candidate_id', $request->id)->get();


        return DataTables::of($records)
            ->editColumn('perform_date', function ($record) {

                return $record->perform_date;
            })
            ->editColumn('action', function ($record) {
                return $record->action;
            })


            ->rawColumns([])

            ->make(true);
    }
}
