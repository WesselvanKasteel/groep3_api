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
        $skillsToBeAdded = $request->skill;

        $newSkill = null;

        foreach($skillsToBeAdded as $skill) {
            $newSkill = Skill::create([
                'id' => Uuid::generate(),
                'skill' => $skill,
            ]);
        }

        $user = auth()->user();
        
        $newSkill->users()->save($user);
        $newSkill->save();
        
        return response()->json([
            'skills' => $skillsToBeAdded
        ], 200);
    }
}
