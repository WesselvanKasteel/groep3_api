<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $users = Job::with('users')->get();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $jobsToBeAdded = $request->job;
        $newJob = Job::create([
            'job' => $jobsToBeAdded,
        ]);

        $newJob->users()->attach($user);
        $newJob->save();

        return response()->json([
            'message' => 'Succesfully stored jobs',
            'jobs' => $jobsToBeAdded
        ], 200);
    }

    public function destroy(Request $request)
    {
        $user = auth()->user();
        $jobsToBeRemoved = $request->job;

        $job = new Job();
        $job->users()->detach($user);
        $job->delete($jobsToBeRemoved);
        $job->save();

        return response()->json([
            'message' => 'Succesfully deleted job',
        ]);
    }
}
