<?php

namespace App\Models;

use App\Models\User;
use App\Models\Registration;
use App\Models\Topic;
use App\Models\Skill;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacancy extends Model
{
    use HasFactory, Uuids;

    public $incrementing = false;
    protected $keyType = 'string'; 

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'updated_at'
    ];

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


    // Registration relation
    public function registration()
    {
        return $this->belongsToMany(Registration::class);
    }

    public function assignRegistration(Registration $registration) 
    {
        return $this->registration()->save($registration);
    }

    // Topic relation
    public function topic()
    {
        return $this->belongsToMany(Topic::class);
    }

    public function assignTopic(Topic $topic) 
    {
        return $this->topic()->save($topic);
    }
}
