<?php
namespace App\Models;
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Hospital extends Model
{
    use HasFactory, UsesUuid;
    protected $table = 'hospitals';
    protected $fillable = ['title', 'service', 'image', 'phone', 'address', 'locationUrl'];
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_hospital')
            ->withPivot('start_at', 'end_at', 'app_price')
            ->distinct();
    }
}