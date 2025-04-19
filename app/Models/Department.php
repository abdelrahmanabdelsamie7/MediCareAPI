<?php
namespace App\Models;
use App\traits\UsesUuid;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Hospital, CareCenter, Doctor, Tip};
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory,UsesUuid;
    protected $table = 'departments';
    protected $fillable = ['title', 'description', 'icon'];
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
    public function tips()
    {
        return $this->hasMany(Tip::class);
    }
}
