<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory, Uuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'education',
    ];


    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
