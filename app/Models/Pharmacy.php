<?php
namespace App\Models;
use App\Models\{User, ChainPharmacies, InsuranceCompany};
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pharmacy extends Model
{
    use HasFactory, UsesUuid;
    protected $table = 'pharmacies';
    protected $fillable = ['title', 'service', 'image', 'phone', 'area', 'city', 'locationUrl', 'whatsappLink', 'deliveryOption', 'insurence', 'start_at', 'end_at', 'chain_pharmacy_id'];
    public function chainPharmacy()
    {
        return $this->belongsTo(ChainPharmacies::class, 'chain_pharmacy_id', 'id');
    }
    public function insuranceCompanies()
    {
        return $this->belongsToMany(InsuranceCompany::class, 'insurance_company_pharmacy', 'pharmacy_id', 'insurance_company_id')
            ->withPivot('id')
            ->withTimestamps();
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_pharmacies')
            ->withPivot('review', 'rating_value')
            ->withTimestamps();
    }
}
