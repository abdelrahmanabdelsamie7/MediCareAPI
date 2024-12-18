<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Pharmacy extends Model
{
    use HasFactory;
    protected $table = 'pharmacies';
    protected $fillable = ['title', 'service', 'image', 'phone', 'address', 'locationUrl', 'whatsappLink', 'deliveryOption', 'insurence', 'start_at', 'end_at', 'chain_pharmacy_id'];
    public function chainPharmacy()
    {
        return $this->belongsTo(ChainPharmacies::class, 'chain_pharmacy_id');
    }
}

