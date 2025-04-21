<?php
namespace App\Models;
use App\Traits\UsesUuid;
use App\Models\{Clinic, Doctor};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory,UsesUuid;
    protected $table = 'appointments';
    protected $fillable = ['day', 'start_at', 'end_at', 'duration', 'doctor_id', 'clinic_id'];
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);

    }
}
