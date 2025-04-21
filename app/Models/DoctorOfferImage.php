<?php
namespace App\Models;
use App\Models\DoctorOffer;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorOfferImage extends Model
{
    use HasFactory,UsesUuid;
    protected $table = 'doctor_offer_images';
    protected $fillable = ['image', 'doctor_offer_id'];
    public function doctor_offer()
    {
        return $this->belongsTo(DoctorOffer::class, 'doctor_offer_id', 'id');
    }
}
