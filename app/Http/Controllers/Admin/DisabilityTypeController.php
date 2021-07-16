<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Admin\DisabilityTypesDataTable;
use App\Models\DisabilityType;

class DisabilityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DisabilityTypesDataTable $dataTable)
    {
        return $dataTable->render('admin.disability-types.index');
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
            'type' => ['required', 'string', 'max:255'],
            'eligible_for_scnic' => ['required', 'in:0,1'],
        ]);

        $disabilityType = DisabilityType::create([
            'type' => $validatedData['type'],
            'eligible_for_scnic' => $validatedData['eligible_for_scnic'],
        ]);

        return redirect()->route('admin.disability-types.index')->with('success', 'Disability type created successfully.');
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
            'type' => ['required', 'string', 'max:255'],
            'eligible_for_scnic' => ['required', 'in:0,1'],
        ]);
        $disabilityType = DisabilityType::find($id)->update($validatedData);

        return redirect()->route('admin.disability-types.index')->with('success', 'Disability type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disabilityType = DisabilityType::find($id);
        $recordDeleted = $disabilityType->delete();
        if ( ! $recordDeleted ) {
            return redirect()->back()->with('error', 'Could not delete the record');
        }
        return redirect()->back()->with('success', 'The record has been deleted');
    }
}
