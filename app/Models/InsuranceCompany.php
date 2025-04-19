<?php
namespace App\Models;
use App\Models\{Pharmacy, Laboratory};
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceCompany extends Model
{
    use HasFactory, UsesUuid;
    protected $table = 'insurance_companies';
    protected $fillable = [
        'name',
        'logo',
    ];
    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacy::class, 'insurance_company_pharmacy', 'insurance_company_id', 'pharmacy_id');
    }
    public function laboratories()
    {
        return $this->belongsToMany(Laboratory::class, 'insurance_company_laboratory', 'insurance_company_id', 'laboratory_id');
    }
}
