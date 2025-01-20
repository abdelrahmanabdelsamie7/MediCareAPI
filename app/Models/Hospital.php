<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hospital extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }
    protected $table = 'hospitals';
    protected $fillable = ['title', 'service', 'image', 'phone', 'address', 'locationUrl'];
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_hospital')
            ->withPivot('start_at', 'end_at', 'app_price')
            ->distinct();
    }
    protected $hidden = ['created_at', 'updated_at'];
}
