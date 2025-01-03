<?php
namespace App\Models;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';   // Name Of Table
    protected $fillable = ['title', 'content', 'doctor_id']; // Columns that will fillable
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, );
    }
}
