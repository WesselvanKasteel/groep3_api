<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index(){
        return Vacancy::with('skills', 'users')->get()->all();
    }

    public function getVacancyData(Request $request) {
        $vacancy = Vacancy::with('users')->with('skills')->where('code', '=', $request->code)->first();

        return response()->json([
            'vacancy' => $vacancy,
        ], 200);
    }

}
