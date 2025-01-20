<?php
namespace App\Models;
use App\Models\Pharmacy;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChainPharmacies extends Model
{
    use HasFactory;
    protected $table = 'chain_pharmacies';
    protected $fillable = ['title'];
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
    public function pharmacies()
    {
        return $this->hasMany(Pharmacy::class, 'chain_pharmacy_id' , 'id');
    }
}
