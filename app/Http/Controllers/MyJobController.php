<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Http\Request;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('my_job.index', [
            'jobs' => auth()->user()->employer
                ->jobs()
                ->with(['employer', 'jobApplications', 'jobApplications.user'])
                ->latest()
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('my_job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        // $validatedData = request()->validate([
        //     'title'       =>  'required|string|max:255|',
        //     'location'    =>  'required|max:255',
        //     'salary'      =>  'required|numeric|min:5000|max:1000000',
        //     'category'    =>  'required|max:255',
        //     'description' =>  'required|string|max:255',
        //     'experience'  =>  'required|in:' . implode(',', Job::$experience),
        //     'category'    =>  'required|in:' . implode(',', Job::$categories),
        // ]);

        auth()->user()->employer->jobs()->create($request->validated()); // from JobRequest $request to $request->validated()

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $myJob)
    {
        return view('my_job.edit', ['job' => $myJob]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, Job $myJob)
    {
        $myJob->update($request->validated()); // $myJob->update($request->validated()), see JobRequest.php

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $myJob)
    {
        $myJob->delete();

        return redirect()->route('my-job.index')
            ->with('success', 'Job deleted successfully!');
    }
}