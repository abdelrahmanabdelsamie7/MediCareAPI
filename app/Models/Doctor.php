<?php
namespace App\Models;
use App\Models\{Department, Specialization, DoctorOffer};
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctors';
    protected $fillable = ['fName', 'lName', 'gender', 'birthDate', 'phone', 'image', 'whatsappLink', 'facebookLink', 'title', 'infoAboutDoctor', 'app_price', 'homeOption', 'email', 'password', 'department_id'];
    protected $hidden = [
        'password',
    ];
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = Hash::make($value);
        }
    }
    // Department has Many Doctors & Doctor Belongs To Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    // Specializations has Many Doctors & Doctor can has Many Specializations
    public function specializations()
    {
        return $this->belongsToMany(Specialization::class)->distinct();
    }
    public function doctor_offers()
    {
        return $this->hasMany(DoctorOffer::class);
    }
}
