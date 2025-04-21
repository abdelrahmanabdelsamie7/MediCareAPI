<?php
namespace App\Models;
use App\Models\Clinic;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClinicImage extends Model
{
    use HasFactory,UsesUuid;
    protected $table = 'clinic_images';
    protected $fillable = ['image', 'clinic_id'];
    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }
}
