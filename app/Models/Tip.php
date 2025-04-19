<?php
namespace App\Models;
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Tip extends Model
{
    use HasFactory,UsesUuid;
    protected $table = 'tips';
    protected $fillable = ['question', 'answer', 'department_id'];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
