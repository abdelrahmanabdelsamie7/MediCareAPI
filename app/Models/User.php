<?php
namespace App\Models;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use App\Models\{Laboratory, Pharmacy};
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
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
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
