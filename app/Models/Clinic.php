<?php
namespace App\Models;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\ClinicImage;
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clinic extends Model
{
    use HasFactory,UsesUuid;
    protected $table = 'clinics';
    protected $fillable = ['title', 'description', 'phone', 'address', 'locationUrl'];
    public function images()
    {
        return $this->hasMany(ClinicImage::class);
    }
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
