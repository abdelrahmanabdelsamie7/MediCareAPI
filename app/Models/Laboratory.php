<?php
namespace App\Models;
use App\Models\{ChainLaboratories, User};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laboratory extends Model
{
    use HasFactory;
    protected $table = 'laboratories';
    protected $fillable = ['title', 'service', 'image', 'phone', 'address', 'locationUrl', 'whatsappLink', 'insurence', 'start_at', 'end_at', 'chain_laboratory_id'];

    public function chainLaboratory()
    {
        return $this->belongsTo(ChainLaboratories::class, 'chain_laboratory_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_laboratories')
            ->withPivot('review', 'rating_value')
            ->withTimestamps();
    }
}
