<?php
namespace App\Models;
use App\Models\DoctorOffer;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorOfferImage extends Model
{
    use HasFactory;
    protected $table = 'doctor_offer_images';
    protected $fillable = ['image', 'doctor_offer_id'];
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
    public function doctor_offer()
    {
        return $this->belongsTo(DoctorOffer::class, 'doctor_offer_id', 'id');
    }
}
