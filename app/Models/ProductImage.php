<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image_url',  // This is the renamed field
        'alt_text',
        'is_main'
    ];

    // Relation to the product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    protected $appends = ['full_url'];

public function getFullUrlAttribute()
{
    if (filter_var($this->image_url, FILTER_VALIDATE_URL)) {
        return $this->image_url;
    }
    return asset('storage/' . ltrim($this->image_url, '/'));
}
}
