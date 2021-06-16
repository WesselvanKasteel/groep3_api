<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'skill',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function vacancies()
    {
        return $this->belongsToMany(Vacancy::class);
    }
}
