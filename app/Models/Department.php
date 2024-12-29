<?php
namespace App\Models;
use App\Models\{Hospital, CareCenter, Doctor};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';   // Name Of Table
    protected $fillable = ['title', 'description', 'icon']; // Columns that will fillable
    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class, 'department_hospital')
            ->withPivot('start_at', 'end_at', 'app_price')->distinct();
        ;
    }
    public function care_centers()
    {
        return $this->belongsToMany(CareCenter::class, 'care_center_department')
            ->withPivot('start_at', 'end_at', 'app_price')->distinct();
        ;
    }
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
