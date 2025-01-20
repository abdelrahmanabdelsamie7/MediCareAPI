<?php
namespace App\Models;
use App\Models\User;
use App\Models\Laboratory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserLaboratory extends Model
{
    use HasFactory;
    protected $table = 'user_laboratories';
    protected $fillable = [
        'review',
        'rating_value',
        'user_id',
        'laboratory_id',
    ];
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
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('review', 'rating_value')->withTimestamps();
    }
    public function laboratories()
    {
        return $this->belongsToMany(Laboratory::class)->withPivot('review', 'rating_value')->withTimestamps();
    }
}
