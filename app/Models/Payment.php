<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_intent_id',
        'amount',
        'currency',
        'status',
    ];

    // Optionally, define relationships if needed
    // For example, if you want to link to a User:


}
