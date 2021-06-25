<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory, Uuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'skill',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // Vacancy relation
    public function vacancies()
    {
        return $this->belongsToMany(Vacancy::class);
    }

    public function assignVacancy(Vacancy $vacancy) 
    {
        return $this->vacancies()->save($vacancy);
    }

}
