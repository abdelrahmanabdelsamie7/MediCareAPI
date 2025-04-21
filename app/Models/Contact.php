<?php
namespace App\Models;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Contact extends Model
{
    use HasFactory,UsesUuid;
    protected $table = 'contacts';
    protected $fillable = ['name', 'email', 'reply', 'message'];
}
