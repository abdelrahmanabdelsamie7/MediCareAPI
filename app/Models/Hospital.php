<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $table = 'hospitals';   // Name Of Table
    protected $fillable = ['title', 'service', 'image', 'phone', 'address', 'locationUrl']; // Columns that will fillable
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_hospital')
            ->withPivot('start_at', 'end_at', 'app_price')->distinct();;
    }
}
