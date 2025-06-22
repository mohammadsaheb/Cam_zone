<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    // Table name explicitly mentioned (optional, Laravel assumes 'carts' if plural)
    protected $table = 'carts';

    // Relationship with CartItem
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
