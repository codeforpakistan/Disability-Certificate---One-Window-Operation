<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.applicant.create-stage1');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ( ! $request->has('applicant_id') ) {
            return redirect()->route('admin.applications.index');
        }
        $applicant = Applicant::with('resources')->find($request->applicant_id);
        return view('admin.applicant.create-stage2', [
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
        $data['status'] = "2";
        $applicant = Applicant::create($data);
        return redirect()->route('admin.applications.create', ['applicant_id' => $applicant->id]);
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
