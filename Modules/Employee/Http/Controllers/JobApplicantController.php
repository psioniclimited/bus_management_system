<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller; 
use Modules\Employee\Entities\JobApplicant;  
use Modules\Employee\Entities\JobOpening;  
use Modules\Employee\Entities\JobApplicantStatus;  
use \Modules\Helpers\DatatableHelper;
use Datatables;

class JobApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('employee::job_applicant.job_applicant_list');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $job_applicant_status=JobApplicantStatus::all();
        return view('employee::job_applicant.create_job_applicant',['job_applicant_status'=>$job_applicant_status]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(\Modules\Employee\Http\Requests\JobApplicantCreateRequest $request){  
       JobApplicant::create($request->all());  
       $request->session()->flash('status', 'Task was successful!');
       return back();
   }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('employee::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(JobApplicant $job_applicant)
    {       
        $job_applicant_status=JobApplicantStatus::all();
       return view('employee::job_applicant.edit_job_applicant',['job_applicant'=>$job_applicant,
        'job_applicant_status'=>$job_applicant_status]);
   }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Employee\Http\Requests\JobApplicantCreateRequest $request,JobApplicant $job_applicant)
    {
        // dd($request->all());
        $job_applicant->update($request->all());
        $request->session()->flash('status', 'Task was successful!');
        return redirect('/job_applicant');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, JobApplicant $job_applicant)
    { 
        $job_applicant->delete();
        $request->session()->flash('status', 'Task was successful!'); 
    }

    public function getAllJobApplicants(DatatableHelper $databaseHelper)
    { 
        $job_applicants = JobApplicant::with('job_openings','job_applicant_status');  
        return Datatables::of($job_applicants)
        ->addColumn('action', function ($job_applicants) use ($databaseHelper){
            return $databaseHelper->editButton('job_applicant',$job_applicants->id).' '.$databaseHelper->deleteButton($job_applicants->id);
        })
        ->make(true);
    }    
}
