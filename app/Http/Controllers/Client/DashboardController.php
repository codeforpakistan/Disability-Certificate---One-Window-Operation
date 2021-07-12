<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\Status;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $applicants = collect([]);
        if ($request->has('cnic')) {
            $applicants = Applicant::with(['resources', 'applicationStatus'])->where('cnic', $request->cnic)->orderBy("created_at", 'DESC')->get();
        } else {
            if (\Auth::user()->hasRole('Assessment')) {
                $applicants = Applicant::with(['resources', 'applicationStatus'])->whereIn('status', Status::whereIn('title', ['Documents Uploaded', 'Reassessment'])->pluck('id'))
                    // ->whereHas('assessments', function($q) {
                    //     $q->where('user_id', \Auth::id());
                    // })
                    ->orderBy("created_at", 'DESC')
                    // ->has('assessments', '=', 0)
                    ->get();
            } else if (\Auth::user()->hasRole('CRPD')) {
                $applicants = Applicant::with(['resources', 'applicationStatus'])->where('status', Status::where('title', 'Assessed')->first()->id)
                    ->orderBy("created_at", 'DESC')
                    ->get();
            } else if (\Auth::user()->hasRole('Help Desk')) {
                $applicants = Applicant::with(['resources', 'applicationStatus'])->where('status', Status::where('title', 'Registered')->first()->id)
                    ->orderBy("created_at", 'DESC')
                    ->get();
            }
        }
        return view('client.dashboard', [
            'applicants' => $applicants,
        ]);
    }

    /**
     * Check applicant status.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkApplicantStatus(Request $request)
    {
        $applicants = collect([]);
        if ($request->has('cnic')) {
            $applicants = Applicant::with(['resources', 'applicationStatus'])->where('cnic', $request->cnic)->orderBy("created_at", 'DESC')->get();
        }
        return view('client.check-applicant-status', [
            'applicants' => $applicants,
        ]);
    
    }
}
