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
            $applicants = Applicant::with('resources')->where('cnic', $request->cnic)->orderBy("created_at", 'DESC')->paginate(10);
        } else {
            if (\Auth::user()->role == 'Assessment') {
                $applicants = Applicant::where('status', 2)
                    // ->whereHas('assessments', function($q) {
                    //     $q->where('user_id', \Auth::id());
                    // })
                    ->orderBy("created_at", 'DESC')
                    // ->has('assessments', '=', 0)
                    ->paginate(10);
            }
            if (\Auth::user()->role == 'CRPD') {
                $applicants = Applicant::where('status', 3)->orderBy("created_at", 'DESC')->paginate(10);
            }
        }
        return view('dashboard', [
            'applicants' => $applicants,
        ]);
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
        //
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
