<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function generateRandomString($length = 24) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function update(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::where('id', $id)->first();

        $user->update([
            'city' => $request->city,
            // 'country' => $request->country,
        ]);

        $user->save();

        return response()->json([
            'message' => 'User successfully updated!',
        ], 200);
    }    

    public function updateUser(Request $request){

        $user = User::where('id', '=', auth()->user()->id)->first();
        if ($user->picture_path === null) {

            $extension = $request->file('file')->extension();
            $fileName = $request->file('file')->getClientOriginalName();
            $randomName = $this->generateRandomString() . '_img.' . $extension;
            $result = $request->file('file')->storeAs('public/images', $randomName);

            $user->update([
                "picture_path" => "storage/images/" . $randomName
            ]);

        }

        else {
            $file = str_replace('storage/images/', '', $user->picture_path);
            $result = $request->file('file')->storeAs('public/images', $file);

        }

        $user->update([
            "city" => $request->city,
            "province" => $request->province,
        ]);

        $user->save();

        // if ($user->picture_path === null && $request->file('file') != null) {
        //
        //     $extension = $request->file('file')->extension();
        //     $fileName = $request->file('file')->getClientOriginalName();
        //     $randomName = $this->generateRandomString() . '_img.' . $extension;
        //     $result = $request->file('file')->storeAs('public/images', $randomName);
        //
        //     $user->update([
        //         "picture_path" => "storage/images/" . $randomName
        //     ]);
        // }
        // if ($user->picture_path != null && $request->file('file') != null) {
        //     $file = str_replace('storage/images/', '', $user->picture_path);
        //     $result = $request->file('file')->storeAs('public/images', $file);
        // }
        //
        // $user->update([
        //     "city" => $request->city,
        //     "province" => $request->province,
        // ]);
        //
        // $user->save();

        return response()->json([
            $user
        ], 201);

    }

    public function getUserData() {
        $user = auth()->user();
        $dateOfBirth = date(auth()->user()->date_of_birth);
        // $date = Carbon::createFromFormat('Y', $dateOfBirth);
        $dateOfBirthYear = Carbon::createFromFormat('Y-m-d', $dateOfBirth);
        $currentDate = Carbon::now();

        $calculatedAge = $dateOfBirthYear->diff($currentDate)->y;
        // ->format('%y years, %m months and %d days');

        return response()->json([
            'age' => $calculatedAge,
            'user' => $user,
        ], 201);
    }

    public function show()
    {
        $id = auth()->user()->id;
        $user = User::where('id', $id)->first();

        $dateOfBirth = date($user->date_of_birth);
        $yearOfDateOfBirth = Carbon::createFromFormat('Y-m-d', $dateOfBirth);
        $currentDate = Carbon::now();

        $calculatedAge = $yearOfDateOfBirth->diff($currentDate)->y;

        return response()->json([
            'age' => $calculatedAge,
            'user' => $user,
        ], 200);
    }
}
