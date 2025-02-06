<?php
namespace App\Models;
use App\Models\{Appointment, User, Clinic, Doctor};

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'doctor_id',
        'clinic_id',
        'appointment_id',
        'status',
    ];
    protected $keyType = 'string';
    public $incrementing = true;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
