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
    // public function generateRandomString($length = 24) {
    //     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //     $charactersLength = strlen($characters);
    //     $randomString = '';
    //     for ($i = 0; $i < $length; $i++) {
    //         $randomString .= $characters[rand(0, $charactersLength - 1)];
    //     }
    //     return $randomString;
    // }

    public function show()
    {
        $id = auth()->user()->id;
        // $user = User::where('id', $id)->first();
        $user = User::with('skills', 'jobs', 'education', 'videos')->where('id', $id)->first();

        $user_video = null;

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

    // public function updateUser(Request $request){
    //
    //     $user = User::where('id', '=', auth()->user()->id)->first();
    //     if ($user->picture_path === null) {
    //
    //         $extension = $request->file('file')->extension();
    //         $fileName = $request->file('file')->getClientOriginalName();
    //         $randomName = $this->generateRandomString() . '_img.' . $extension;
    //         $result = $request->file('file')->storeAs('public/images', $randomName);
    //
    //         $user->update([
    //             "picture_path" => "storage/images/" . $randomName
    //         ]);
    //
    //     }
    //
    //     else {
    //         $file = str_replace('storage/images/', '', $user->picture_path);
    //         $result = $request->file('file')->storeAs('public/images', $file);
    //
    //     }
    //
    //     $user->update([
    //         "city" => $request->city,
    //         "province" => $request->province,
    //     ]);
    //
    //     $user->save();
    //
    //     // if ($user->picture_path === null && $request->file('file') != null) {
    //     //
    //     //     $extension = $request->file('file')->extension();
    //     //     $fileName = $request->file('file')->getClientOriginalName();
    //     //     $randomName = $this->generateRandomString() . '_img.' . $extension;
    //     //     $result = $request->file('file')->storeAs('public/images', $randomName);
    //     //
    //         // $user->update([
    //         //     "picture_path" => "storage/images/" . $randomName
    //         // ]);
    //     // }
    //     // if ($user->picture_path != null && $request->file('file') != null) {
    //     //     $file = str_replace('storage/images/', '', $user->picture_path);
    //     //     $result = $request->file('file')->storeAs('public/images', $file);
    //     // }
    //     //
    //     // $user->update([
    //     //     "city" => $request->city,
    //     //     "province" => $request->province,
    //     // ]);
    //     //
    //     // $user->save();
    //
    //     return response()->json([
    //         auth()->user()
    //         //$user
    //     ], 201);
    //
    // }
    //
    // public function getUserData() {
    //     $user = auth()->user();
    //     $dateOfBirth = date(auth()->user()->date_of_birth);
    //     // $date = Carbon::createFromFormat('Y', $dateOfBirth);
    //     $dateOfBirthYear = Carbon::createFromFormat('Y-m-d', $dateOfBirth);
    //     $currentDate = Carbon::now();
    //
    //     $calculatedAge = $dateOfBirthYear->diff($currentDate)->y;
    //     // ->format('%y years, %m months and %d days');
    //
    //     return response()->json([
    //         'age' => $calculatedAge,
    //         'user' => $user,
    //     ], 201);
    // }
