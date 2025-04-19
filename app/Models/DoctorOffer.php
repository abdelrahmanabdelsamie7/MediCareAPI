<?php
namespace App\Models;
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\{DoctorOfferImage, OfferGroup, Doctor};

class DoctorOffer extends Model
{
    use HasFactory,UsesUuid;
    protected $table = 'doctor_offers';
    protected $fillable = ['title', 'info_about_offer', 'details', 'price_before_discount', 'discount', 'from_day', 'to_day', 'is_active', 'doctor_id', 'offer_group_id'];
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function images()
    {
        return $this->hasMany(DoctorOfferImage::class);
    }
    public function offerGroup()
    {
        return $this->belongsTo(OfferGroup::class, 'offer_group_id');
    }
}