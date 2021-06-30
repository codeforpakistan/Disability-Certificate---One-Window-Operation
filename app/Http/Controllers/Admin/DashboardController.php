<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant;

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
                $applicants = Applicant::with(['resources', 'applicationStatus'])->whereIn('status', [2,9])
                    // ->whereHas('assessments', function($q) {
                    //     $q->where('user_id', \Auth::id());
                    // })
                    ->orderBy("created_at", 'DESC')
                    // ->has('assessments', '=', 0)
                    ->get();
            } else if (\Auth::user()->hasRole('CRPD')) {
                $applicants = Applicant::with(['resources', 'applicationStatus'])->where('status', 3)
                    ->orderBy("created_at", 'DESC')
                    ->get();
            } else if (\Auth::user()->hasRole('Help Desk')) {
                $applicants = Applicant::with(['resources', 'applicationStatus'])->where('status', 1)
                    ->orderBy("created_at", 'DESC')
                    ->get();
            }
        }
        return view('dashboard', [
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
        return view('check-applicant-status', [
            'applicants' => $applicants,
        ]);
    
    }
}
