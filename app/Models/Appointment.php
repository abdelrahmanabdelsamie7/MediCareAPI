<?php
namespace App\Models;
use App\Models\{Clinic, Doctor};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';   // Name Of Table
    protected $fillable = ['day', 'start_at', 'end_at', 'doctor_id', 'clinic_id']; // Columns that will fillable
    public function doctors()
    {
        return $this->belongsTo(Doctor::class);

    }
    public function clinics()
    {
        return $this->belongsTo(Clinic::class);

    }
}
