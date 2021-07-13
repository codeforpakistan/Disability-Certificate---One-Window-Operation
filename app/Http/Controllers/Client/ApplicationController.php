<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\DisabilityType;
use App\Models\Status;

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
            'status' => Status::where('title', 'Documents Uploaded')->first(),
            'applicant' => $applicant,
            'resources' => $applicant->resources,
            'requiredDocuments' => $applicant->resources()->whereIn('name', ['CRC', 'CNIC', 'B Form'])->count(),
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
        $data['status'] = Status::where('title', 'Registered')->first()->id;
        $data['registration_no'] = (100 + Applicant::count()) . '/' . date('Y') . "-CRPD";
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
            $applicant->status = Status::where('title', 'Issued Disability Certificate')->first()->id;
            $applicant->save();
        } else if($request->has('issue') && $request->issue == 'reassess'){
            $applicant = Applicant::with('resources')->find($id);
            $applicant->comments = $request->comments;
            $applicant->status = Status::where('title', 'Reassessment')->first()->id;
            $applicant->save();
            return redirect()->route('client.dashboard', ['cnic' => $applicant->cnic])->with('success', 'Patient marked for reassessment.');
        } else {
            $applicant = Applicant::with('resources')->find($id);
            $applicant->comments = $request->comments;
            $applicant->status = Status::where('title', 'Rejected')->first()->id;
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $applicant = Applicant::with('resources')->find($id);
        $disabilityTypes = DisabilityType::pluck('type', 'id');
        return view('client.applicant.edit-stage1', [
            'applicant' => $applicant,
            'disabilityTypes' => $disabilityTypes,
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
        if ($request->has('update_mode')) {
            $validatedData = $request->validate([
                'cnic' => ['required'],
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
        }
        $request = $request->except(['_method', '_token', 'update_mode']);
        $applicant = Applicant::with('resources')->find($id)->update($request);
        if ($applicant) {
            return redirect()->route('client.dashboard')->with('success', 'Applicant data submitted for clinical assessment.');
        }
    }
}
