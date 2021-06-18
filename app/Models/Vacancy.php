<?php

namespace App\Models;

use App\Models\User;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacancy extends Model
{
    use HasFactory, Uuids;

    public $incrementing = false;
    protected $keyType = 'string'; 

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}
