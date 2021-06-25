<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileUpdateRequest;
use App\Models\User;
use App\Models\Job;
use App\Models\Education;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function show()
    {
        $id = auth()->user()->id;
        $user = User::with('skills', 'jobs', 'education', 'videos')->where('id', $id)->first();

        $user_video = false;

        foreach ($user->videos as $video) {;
            if (str_contains($video->path, 'intruduction')) {
                $user_video = $video;
            }
        }

        $dateOfBirth = date($user->date_of_birth);
        $yearOfDateOfBirth = Carbon::createFromFormat('Y-m-d', $dateOfBirth);
        $currentDate = Carbon::now();

        $calculatedAge = $yearOfDateOfBirth->diff($currentDate)->y;

        return response()->json([
            'age' => $calculatedAge,
            'video' => $user_video,
            'user' => $user,
        ], 200);
    }

    public function edit(UserProfileUpdateRequest $request)
    {
        $id = auth()->user()->id;
        $user = User::where('id', $id)->first();

        $fieldsToBeUpdated = $request->validated();

        $user->update($fieldsToBeUpdated);
        $user->save();
        return response()->json([
            'message' => 'user succesfully updated',
            $user
        ], 200);
    }

    public function uploadProfilePicture(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::where('id', $id)->first();

        $pictureToBeUploaded = $request->file('picture');
        $encodedProfilePicture = base64_encode(file_get_contents($pictureToBeUploaded));

        $user->update([
            'picture' => $encodedProfilePicture,
        ]);
        $user->save();

        return response()->json([
            'message' => 'profile picture succesfully updated!',
            'encoded_picture' => $encodedProfilePicture,
        ]);
    }


    public function getUsersData(){
        return User::with('skills')->get()->all();
    }
}
