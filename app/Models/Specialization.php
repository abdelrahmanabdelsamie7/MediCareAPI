<?php
namespace App\Models;
use App\Models\Doctor;
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Specialization extends Model
{
    use HasFactory,UsesUuid;
    protected $table = 'specializations';
    protected $fillable = ['title'];
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class)->distinct();
    }
}
