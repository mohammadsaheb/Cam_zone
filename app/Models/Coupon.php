<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 
        'type', 
        'value', 
        'min_order_amount', 
        'valid_from', 
        'valid_to', 
        'usage_limit', 
        'is_active'
    ];
}
