<?php
namespace App\Models;
use App\traits\UsesUuid;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\{Blog, Department, DoctorOffer, Specialization, Clinic, Appointment, Reservation};

class Doctor extends Authenticatable implements JWTSubject
{
    use Notifiable,UsesUuid;
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
        'updated_at',
        'password',
        'remember_token',
    ];
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
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
    public function clinics()
    {
        return $this->belongsToMany(Clinic::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'doctor_id');
    }
    public function blogs()
    {
        return $this->hasMany(Blog::class);
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