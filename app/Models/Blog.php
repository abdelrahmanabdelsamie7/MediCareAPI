<?php
namespace App\Models;
use App\Models\Doctor;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory,UsesUuid;
    protected $table = 'blogs';
    protected $fillable = ['title', 'content', 'doctor_id'];
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }
}
