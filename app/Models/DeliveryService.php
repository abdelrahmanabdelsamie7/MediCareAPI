<?php
namespace App\Models;
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class DeliveryService extends Model
{
    use HasFactory,UsesUuid;
    protected $table = 'delivery_services';
    protected $fillable = ['name', 'description', 'app_link'];
}