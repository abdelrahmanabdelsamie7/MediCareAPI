<?php
namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Hospital, CareCenter, Doctor};
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }
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
    protected $hidden = ['created_at', 'updated_at'];
}
