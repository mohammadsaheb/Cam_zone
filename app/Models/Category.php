<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'slug', 
        'image', 
        'is_active'
    ];

    // علاقة الفئة بالمنتجات
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
