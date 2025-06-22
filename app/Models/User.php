<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'phone', 
        'address', 
        'role',
       
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    // علاقة المستخدم بالحجوزات
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // علاقة المستخدم بالسلة
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    // علاقة المستخدم بالطلبات
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // علاقة المستخدم بالمراجعات
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}