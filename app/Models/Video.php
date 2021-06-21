<?php

namespace App\Models;

use App\Models\Topic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
    ];


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
