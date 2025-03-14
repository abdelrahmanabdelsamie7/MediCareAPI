<?php
namespace App\Models;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use App\Models\{Laboratory, Pharmacy, Reservation};
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject,MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'google_id',
        'avatar',
        'role',
        'phone',
        'address',
        'birth_date',
        'password',
        'verification_token',
        'verification_token_expires_at',
    ];
    protected $keyType = 'string';
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacy::class, 'user_pharmacies')
            ->withPivot('review', 'rating_value')
            ->withTimestamps();
    }
    public function laboratories()
    {
        return $this->belongsToMany(Laboratory::class, 'user_laboratories')
            ->withPivot('review', 'rating_value')
            ->withTimestamps();
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
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
