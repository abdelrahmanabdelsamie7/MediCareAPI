<?php
namespace App\Models;
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use App\Models\{ChainLaboratories, User, InsuranceCompany};
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laboratory extends Model
{
    use HasFactory, UsesUuid;
    protected $table = 'laboratories';
    protected $fillable = ['title', 'service', 'image', 'phone', 'area', 'city', 'locationUrl', 'whatsappLink', 'insurence', 'start_at', 'end_at', 'chain_laboratory_id'];
    public function chainLaboratory()
    {
        return $this->belongsTo(ChainLaboratories::class, 'chain_laboratory_id', 'id');
    }
    public function insuranceCompanies()
    {
        return $this->belongsToMany(InsuranceCompany::class, 'insurance_company_laboratory', 'laboratory_id', 'insurance_company_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_laboratories')
            ->withPivot('review', 'rating_value')
            ->withTimestamps();
    }
}
