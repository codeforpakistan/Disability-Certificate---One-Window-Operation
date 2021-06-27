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
        $applicants = collect([])->paginate(50);
        if ($request->has('cnic')) {
            $applicants = Applicant::with('resources')->where('cnic', $request->cnic)->orderBy("created_at", 'DESC')->cursorPaginate(50);
        } else {
            if (\Auth::user()->hasRole('Assessment')) {
                $applicants = Applicant::whereIn('status', [2,9])
                    // ->whereHas('assessments', function($q) {
                    //     $q->where('user_id', \Auth::id());
                    // })
                    ->orderBy("created_at", 'DESC')
                    // ->has('assessments', '=', 0)
                    ->cursorPaginate(50);
            } else if (\Auth::user()->hasRole('CRPD')) {
                $applicants = Applicant::where('status', 3)
                    ->orderBy("created_at", 'DESC')
                    ->cursorPaginate(50);
            } else if (\Auth::user()->hasRole('Help Desk')) {
                $applicants = Applicant::where('status', 1)
                    ->orderBy("created_at", 'DESC')
                    ->cursorPaginate(50);
            }
        }
        return view('dashboard', [
            'applicants' => $applicants,
        ]);
    }
}
