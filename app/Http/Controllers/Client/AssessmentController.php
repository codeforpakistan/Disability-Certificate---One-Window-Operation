<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApplicantAssesment;
use App\Models\Applicant;
use App\Models\Status;

class AssessmentController extends Controller
{

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

        if(($applicant->applicationStatus->title == 'Documents Uploaded' && $applicant->assessments->count() == 5) || ($applicant->applicationStatus->title == 'Reassessment' && $applicant->assessments->count() == 10)) {
            $applicant->status = Status::where('title', 'Assessed')->first()->id;
            $applicant->save();
        }
        return redirect()->route('client.dashboard')->with('success', 'Clinical assessment submitted successfully.');
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
        $validatedData = $request->validate([
            'applicant_id' => ['required', 'exists:applicants,id'],
            'clinical_findings' => ['required'],
            'doctor_name' => ['required'],
            'fit_for_job' => ['required', 'boolean'],
            'fit_for_driving' => ['required', 'boolean'],
        ]);
        $applicantAssessment = ApplicantAssesment::find($id)->update($validatedData);
        return redirect()->route('client.dashboard')->with('success', 'Clinical assessment updated successfully.');
    }
}
