<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\Cart; // Import Cart model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Display Home Page with Featured Products (Popular Cameras and Lenses)
    public function index()
    {
        // Fetch the latest 4 reviews
        $reviews = Review::with('user')->latest()->take(3)->get();

        // Fetch the featured products (optional, if you need this in the homepage)
        $featuredProducts = Product::where('is_featured', true)
                                   ->where('is_active', true) // Ensure the products are active
                                   ->orderBy('created_at', 'desc') // Optionally order by the latest
                                   ->take(4) // Fetch only 4 featured products
                                   ->get();

        // Get the user's cart item count (the sum of all item quantities in the cart)
        $cart = Cart::where('user_id', Auth::id())->first();
        $cartItemCount = $cart ? $cart->items->sum('quantity') : 0; // Default to 0 if the cart is empty or doesn't exist

        // Pass both the reviews, featured products, and cart item count to the view
        return view('home.index', compact('reviews', 'featuredProducts', 'cartItemCount'));
    }
}
