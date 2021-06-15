<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Job extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['previous_jobs'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
