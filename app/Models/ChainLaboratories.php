<?php
namespace App\Models;
use App\Models\Laboratory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChainLaboratories extends Model
{
    use HasFactory;
    protected $table = 'chain_laboratories';
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
    public function laboratories()
    {
        return $this->hasMany(Laboratory::class, 'chain_laboratory_id', 'id');
    }
}
