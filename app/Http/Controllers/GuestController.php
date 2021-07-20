<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('verify-disability-certificate');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $validatedData = $request->validate([
            'cnic' => ['required', 'exists:applicants,cnic'],
            'issue_date' => ['required'],
        ]);
        $applicant = Applicant::where('cnic', $validatedData['cnic'])->whereDate('created_at', $validatedData['issue_date'])->first();

        if (! $applicant ) {
            return redirect()->back()->withInput()->withErrors([
                'issue_date' => 'Issue date is invalid.',
            ]);
        }
        
        return view('client.applicant.create-stage5', [
            'applicant' => $applicant,
        ]);
    }
}
