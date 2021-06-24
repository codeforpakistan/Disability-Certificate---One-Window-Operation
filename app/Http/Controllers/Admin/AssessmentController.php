<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApplicantAssesment;
use App\Models\Applicant;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'applicant_id' => ['required', 'exists:applicants,id'],
            'clinical_findings' => ['required'],
            'doctor_name' => ['required'],
            'fit_for_job' => ['required', 'boolean'],
            'fit_for_driving' => ['required', 'boolean'],
        ]);
        $validatedData['user_id'] = \Auth::id();
        $applicantAssessment = ApplicantAssesment::create($validatedData);
        $applicant = Applicant::with('resources')->find($request->applicant_id);

        if(($applicant->status == 2 && $applicant->assessments->count() == 5) || ($applicant->status == 9 && $applicant->assessments->count() == 10)) {
            $applicant->status = 3;
            $applicant->save();
        }
        return redirect()->route('dashboard')->with('success'. 'Clinical assessment submitted successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
