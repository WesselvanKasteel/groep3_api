<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Vacancy;
use App\Models\Video;

class Topic extends Model
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


    // Vacancy relation
    public function vacancies()
    {
        return $this->belongsToMany(Vacancy::class);
    }

    public function assignVacancy(Vacancy $vacancy) 
    {
        return $this->vacancies()->save($vacancy);
    }

    // Video relation
    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    public function assignVideo(Video $video) 
    {
        return $this->videos()->save($video);
    }
}
