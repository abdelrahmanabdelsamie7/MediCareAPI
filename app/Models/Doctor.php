<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Doctor extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'doctors';

    protected $fillable = [
        'fName',
        'lName',
        'gender',
        'birthDate',
        'phone',
        'image',
        'whatsappLink',
        'facebookLink',
        'title',
        'infoAboutDoctor',
        'app_price',
        'homeOption',
        'email',
        'password',
        'department_id'
    ];

    protected $hidden = [
        'password',
        'remember_token', // Add this if you're using the "remember me" feature
    ];
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value); // Hashing the password
        }
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class)->distinct();
    }

    public function doctor_offers()
    {
        return $this->hasMany(DoctorOffer::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
