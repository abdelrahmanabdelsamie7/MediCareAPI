<?php
namespace App\Models;
use App\Models\Doctor;
use Illuminate\Support\Str;
use App\Models\DoctorOfferImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorOffer extends Model
{
    use HasFactory;
    protected $table = 'doctor_offers';
    protected $fillable = ['title', 'info_about_offer', 'details', 'price_before_discount', 'discount', 'from_day', 'to_day', 'is_active', 'doctor_id'];
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
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function images()
    {
        return $this->hasMany(DoctorOfferImage::class);
    }
}
