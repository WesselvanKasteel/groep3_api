<?php

namespace App\Models;

use App\Traits\Uuids;
use App\Models\Vacancy;
use App\Models\Registration;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, Uuids;

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function premium()
    {
        return $this->hasOne(Premium::class);
    }

    public function vacancy()
    {
        return $this->belongsToMany(Vacancy::class);
    }

    public function vacancies()
    {
        return $this->belongsToMany(Vacancy::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function educations()
    {
        return $this->belongsToMany(Education::class);
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name',
        'first_name',
        'prefix',
        'last_name',
        'country',
        'province',
        'city',
        'address',
        'email',
        'password',
        'phone_number',
        'date_of_birth',
        'picture',
        'external_cv',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'id' => 'string',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
