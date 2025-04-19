<?php
namespace App\Models;
use App\Models\{DoctorOffer};
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferGroup extends Model
{
    use HasFactory,UsesUuid;
    protected $table = 'offer_groups';
    protected $fillable = ['title' , 'image'];
    public function doctor_offers()
    {
        return $this->hasMany(DoctorOffer::class);
    }
}