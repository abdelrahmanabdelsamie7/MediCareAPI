<?php
namespace App\Models;
use Illuminate\Support\Str;
use App\Models\{DoctorOffer};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferGroup extends Model
{
    use HasFactory;
    protected $table = 'offer_groups';
    protected $fillable = ['title' , 'image'];
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
    public function doctor_offers()
    {
        return $this->hasMany(DoctorOffer::class);
    }
}
