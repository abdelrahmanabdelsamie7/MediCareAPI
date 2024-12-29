<?php
namespace App\Models;
use App\Models\{Department, Specialization};
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
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function specializations()
    {
        return $this->belongsToMany(Specialization::class)->distinct();
    }
}
