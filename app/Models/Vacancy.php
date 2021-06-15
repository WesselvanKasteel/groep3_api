<?php

namespace App\Models;

use App\Models\User;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacancy extends Model
{
    use HasFactory, Uuids;

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
