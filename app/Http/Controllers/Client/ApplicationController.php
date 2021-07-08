<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\DisabilityType;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disabilityTypes = DisabilityType::pluck('type', 'id');
        return view('client.applicant.create-stage1', [
            'disabilityTypes' => $disabilityTypes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ( ! $request->has('applicant_id') ) {
            return redirect()->route('client.applications.index');
        }
        $applicant = Applicant::with('resources')->find($request->applicant_id);
        return view('client.applicant.create-stage2', [
            'applicant' => $applicant,
            'resources' => $applicant->resources,
        ]);
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
            'cnic' => ['required', 'unique:applicants'],
            'dob' => ['required', 'before:today', 'after:1900-01-01'],
            'name' => ['required'],
            'father_name' => ['required'],
            'phone_no' => ['required'],
            'address' => ['required'],
            'gender' => ['required'],
            'marital_status' => ['required'],
            'qualification' => ['required'],
            'type_of_disability' => ['required'],
            'nature_of_disability' => ['required'],
            'cause_of_disability' => ['required'],
            'source_of_income' => ['required'],
            'type_of_job' => ['required'],
        ]);
        $data = $request->except(['_token']);
        $data['user_id'] = \Auth::id();
        $data['status'] = "1";
        $applicant = Applicant::create($data);
        return redirect()->route('client.applications.create', ['applicant_id' => $applicant->id]);
    }

    /**
     * Show the form for CRPD verification the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verification(Request $request, $id)
    {
        $applicant = Applicant::with(['resources', 'assessments.user'])->find($id);
        return view('client.applicant.create-stage4', [
            'applicant' => $applicant,
        ]);
    }

    /**
     * Show the form for CRPD verification the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function issueCertificate(Request $request, $id)
    {
        if ($request->has('issue') && $request->issue == 'yes') {
            $applicant = Applicant::with('resources')->find($id);
            $applicant->comments = $request->comments;
            $applicant->status = 5;
            $applicant->save();
        } else if($request->has('issue') && $request->issue == 'reassess'){
            $applicant = Applicant::with('resources')->find($id);
            $applicant->comments = $request->comments;
            $applicant->status = 9;
            $applicant->save();
            return redirect()->route('client.dashboard', ['cnic' => $applicant->cnic])->with('success', 'Patient marked for reassessment.');
        } else {
            $applicant = Applicant::with('resources')->find($id);
            $applicant->comments = $request->comments;
            $applicant->status = 8;
            $applicant->save();
            return redirect()->route('client.dashboard', ['cnic' => $applicant->cnic])->with('success', 'Verification complete.');
        }
        $applicant = Applicant::with('resources')->find($id);
        
        return view('client.applicant.create-stage5', [
            'applicant' => $applicant,
        ]);
    }

    /**
     * Show the form for assessment the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assessment(Request $request, $id)
    {
        $applicant = Applicant::with('resources')->find($id);
        return view('client.applicant.create-stage3', [
            'applicant' => $applicant,
        ]);
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
        $request = $request->except(['_method', '_token']);
        $applicant = Applicant::with('resources')->find($id)->update($request);
        if ($applicant) {
            return redirect()->route('client.dashboard')->with('success', 'Applicant data submitted for clinical assessment.');
        }
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
