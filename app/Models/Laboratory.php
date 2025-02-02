<?php
namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Models\{ChainLaboratories, User};
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laboratory extends Model
{
    use HasFactory;
    protected $table = 'laboratories';
    protected $fillable = ['title', 'service', 'image', 'phone', 'area', 'city', 'locationUrl', 'whatsappLink', 'insurence', 'start_at', 'end_at', 'chain_laboratory_id'];
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
    public function chainLaboratory()
    {
        return $this->belongsTo(ChainLaboratories::class, 'chain_laboratory_id', 'id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_laboratories')
            ->withPivot('review', 'rating_value')
            ->withTimestamps();
    }
}
