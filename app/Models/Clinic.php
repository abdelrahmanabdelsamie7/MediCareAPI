<?php
namespace App\Models;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\ClinicImage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clinic extends Model
{
    use HasFactory;
    protected $table = 'clinics';
    protected $fillable = ['title', 'description', 'phone', 'address', 'locationUrl'];

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
