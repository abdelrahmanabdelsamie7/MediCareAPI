<?php
namespace App\Models;
use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ChainPharmacies extends Model
{
    use HasFactory;
    protected $table = 'chain_pharmacies';
    protected $fillable = ['title'];

    public function pharmacies()
    {
        return $this->hasMany(Pharmacy::class, 'chain_pharmacy_id');
    }

}
