<?php
namespace App\Models;
use App\Models\User;
use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPharmacy extends Model
{
    use HasFactory;
    protected $table = 'user_pharmacies';
    protected $fillable = [
        'review',
        'rating_value',
        'user_id',
        'pharmacy_id',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('review', 'rating_value')->withTimestamps();
    }
    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacy::class)->withPivot('review', 'rating_value')->withTimestamps();
        ;
    }
}
