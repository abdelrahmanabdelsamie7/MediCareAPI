<?php
namespace App\Models;
use App\Models\Appointment;
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

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
