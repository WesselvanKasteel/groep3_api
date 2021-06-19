<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
    ];


    // Vacancy relation
    public function vacancy()
    {
        return $this->belongsToMany(Vacancy::class);
    }

    public function assignVacancy(Vacancy $vacancy) 
    {
        return $this->vacancy()->save($vacancy);
    }
}
