<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'booking_date', 
        'start_time', 
        'end_time', 
        'status', 
        'notes', 
        'location', 
        'service_type', 
        'price'
    ];

    // علاقة الحجز بالمستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
