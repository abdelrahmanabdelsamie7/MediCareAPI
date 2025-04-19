<?php
namespace App\Models;
use App\Models\Department;
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class CareCenter extends Model
{
    use HasFactory,UsesUuid;
    protected $table = 'care_centers';
    protected $fillable = ['title', 'service', 'image', 'phone', 'address', 'locationUrl'];
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'care_center_department')
            ->withPivot('start_at', 'end_at', 'app_price')->distinct();
    }
}