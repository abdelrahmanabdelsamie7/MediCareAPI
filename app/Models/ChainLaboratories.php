<?php
namespace App\Models;
use App\Models\Laboratory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ChainLaboratories extends Model
{
    use HasFactory;
    protected $table = 'chain_laboratories';
    protected $fillable = ['title'];
    public function laboratories()
    {
        return $this->hasMany(Laboratory::class, 'chain_laboratory_id');
    }
}