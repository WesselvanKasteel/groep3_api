<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class SkillController extends Controller
{
    public function index()
    {
        $users = Skill::with('users')->get();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $skillToBeAdded = $request->skill;
        $skill = Skill::create([
            'id' => Uuid::generate(),
            'skill' => $skillToBeAdded,
        ]);

        $skill->users()->attach($user);
        $skill->save();
        
        return response()->json([
            'message' => 'skill sucessfully added',
            'skill' => $skill,
            'user' => $user,
        ]);
    }
}
