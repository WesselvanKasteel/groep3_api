<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'name',
        'size',
        'length',
        'path',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
