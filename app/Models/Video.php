<?php

namespace App\Models;

use App\Traits\Uuids;

use App\Models\Topic;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory, Uuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'path',
        'size',
        'duration',
    ];

    protected $hidden = [
        // 'id',
        'updated_at',
        'created_at',
    ];


    // Topic relation
    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }

    public function assignTopic(Topic $topic) 
    {
        return $this->topics()->save($topic);
    }

    // User relation
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function assignUser(User $user) 
    {
        return $this->users()->save($user);
    }
}
