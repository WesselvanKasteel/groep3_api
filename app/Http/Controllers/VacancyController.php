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
        return Vacancy::with('skills')->get();
    }

}
