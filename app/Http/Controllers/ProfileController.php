<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function updateUser(Request $request)
    {
        $user = User::where('id', '=', auth()->user()->id)->first();

        $user->update([
            "city" => $request->city,
            "province" => $request->province
        ]);

        $user->save();

        return response()->json([
            $user
        ], 201);

    }


}
