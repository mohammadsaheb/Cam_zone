<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'category_id',
        'brand',
        'is_featured',
        'is_active'
    ];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the images for the product.
     * This relationship name must match exactly what is used in your views
     */
    public function mainImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_main', true);
    }
    
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Cart items that contain this product
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}