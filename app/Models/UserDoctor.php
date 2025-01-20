<?php
namespace App\Models;
use Illuminate\Support\Str;
use App\Models\{Doctor, User};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDoctor extends Model
{
    use HasFactory;
    protected $table = 'user_doctors';
    protected $fillable = [
        'review',
        'rating_value',
        'user_id',
        'doctor_id',
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
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class)->withPivot('review', 'rating_value')->withTimestamps();
    }
}
