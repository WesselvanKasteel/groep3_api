<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    //

    public function index(){
        // $skills = Vacancy::first()->skills;
        // $vacancy = Vacancy::all();

        // return $skills && $vacancy;
        return Vacancy::with('skills')->get()->all();
    }

    public function getVacancyData(Request $request) {

        // $vacancy = Vacancy::where('code', '=', $request->code)->first();

        $vacancy = Vacancy::with('users')->with('skills')->where('code', '=', $request->code)->first();

        return response()->json([
            'vacancy' => $vacancy,
        ], 200);
    }

}
