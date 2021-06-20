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
        $skillsToBeAdded = $request->skill;

        // $newSkill = null;

        // foreach($skillsToBeAdded as $skill) {
        //     $newSkill = Skill::create([
        //         'skill' => $skill,
        //     ]);
        // }
        $newSkill = Skill::create([
            'skill' => $skillsToBeAdded,
        ]);

        $newSkill->users()->save($user);
        $newSkill->save();
        
        return response()->json([
            'message' => 'Succesfully stored skills',
            'skills' => $skillsToBeAdded
        ], 200);
    }
}
