<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resource;

class ResourceController extends Controller
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
            'applicant_files' => ['required'],
            'applicant_files.*' => ['mimes:jpeg,jpg,png,pdf']
        ]);
        foreach($request->file('applicant_files') as $file) {
            // dump($file);
            $fileName = time() . rand(0, 1000) . '-' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $fileName . '.' .$file->getClientOriginalExtension();
            $path = $file->storeAs(
                'resources', // Directory
                $fileName, // Name of the file
                'public' // Disk
            );
            $input = [
                'user_id' => \Auth::id(),
                'applicant_id' => $request->applicant_id,
                'type' => $file->getMimeType(),
                // 'name' =>  pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'name' =>  NULL,
                'url' => env('APP_URL') . '/storage/' . $path,
            ];
            Resource::create($input);
        }
        return redirect()->back()->with('success', 'Files uploaded successfully.');
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
