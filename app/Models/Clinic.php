<?php
namespace App\Models;
use App\Models\ClinicImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Clinic extends Model
{
    use HasFactory;
    protected $table = 'clinics';   // Name Of Table
    protected $fillable = ['title', 'description', 'phone', 'address', 'locationUrl']; // Columns that will fillable
    public function images()
    {
        return $this->hasMany(ClinicImage::class);
    }
}
