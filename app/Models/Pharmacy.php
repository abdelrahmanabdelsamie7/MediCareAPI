<?php
namespace App\Models;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pharmacy extends Model
{
    use HasFactory;
    protected $table = 'pharmacies';
    protected $fillable = ['title', 'service', 'image', 'phone', 'area',   'city',  'locationUrl', 'whatsappLink', 'deliveryOption', 'insurence', 'start_at', 'end_at', 'chain_pharmacy_id'];
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
    public function chainPharmacy()
    {
        return $this->belongsTo(ChainPharmacies::class, 'chain_pharmacy_id', 'id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_pharmacies')
            ->withPivot('review', 'rating_value')
            ->withTimestamps();
    }
}

