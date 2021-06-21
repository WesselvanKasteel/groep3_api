<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class EducationController extends Controller
{
    public function index()
    {
        $users = Education::with('users')->get();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $educationToBeAdded = $request->education;
        $newJob = Education::create([
            'education' => $educationToBeAdded,
        ]);

        $newJob->users()->save($user);
        $newJob->save();

        return response()->json([
            'message' => 'Succesfully stored education',
            'Education' => $educationToBeAdded
        ], 200);
    }
}
