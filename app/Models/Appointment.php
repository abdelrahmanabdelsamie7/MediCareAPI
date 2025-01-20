<?php
namespace App\Models;
use Illuminate\Support\Str;
use App\Models\{Clinic, Doctor};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';
    protected $fillable = ['day', 'start_at', 'end_at', 'duration', 'doctor_id', 'clinic_id'];
    protected $keyType = 'string';
    public $incrementing = true;

    public function doctors()
    {
        return $this->belongsTo(Doctor::class);

    }
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);

    }
}
