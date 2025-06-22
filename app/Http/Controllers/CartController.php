<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the cart
     */
    public function viewCart()
    {
        // Get the user's cart or create a new one
        $cart = $this->getOrCreateCart();
        
        // Get all cart items with product information
        $cartItems = $cart->items()->with(['product', 'product.images'])->get();
        
        // Calculate cart total
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }
        
        // Get cart item count for badge
        $cartItemCount = $cartItems->sum('quantity');
        
        // Pass data to the view
        return view('cart.view', compact('cartItems', 'total', 'cartItemCount'));
    }
    
    /**
     * Add product to cart
     */
    public function addToCart($productId)
    {
        // Find the product
        $product = Product::findOrFail($productId);
        
        // Get or create cart
        $cart = $this->getOrCreateCart();
        
        // Check if product already exists in cart
        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $productId)
                            ->first();
        
        if ($cartItem) {
            // Update existing cart item
            $cartItem->increment('quantity');
        } else {
            // Add new cart item
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }
        
        return redirect()->back()->with('success', 'Product added to cart!');
    }
    
    /**
     * Update cart item quantity
     */
    public function updateCart(Request $request, $cartItemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        
        $cartItem = CartItem::findOrFail($cartItemId);
        
        // Ensure cart item belongs to current user
        if ($cartItem->cart->user_id != Auth::id()) {
            abort(403);
        }
        
        $cartItem->update([
            'quantity' => $request->quantity
        ]);
        
        return redirect()->route('cart.view')->with('success', 'Cart updated successfully!');
    }
    
    /**
     * Remove item from cart
     */
    public function removeFromCart($cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        
        // Ensure cart item belongs to current user
        if ($cartItem->cart->user_id != Auth::id()) {
            abort(403);
        }
        
        $cartItem->delete();
        
        return redirect()->route('cart.view')->with('success', 'Item removed from cart!');
    }
    
    /**
     * Helper method to get or create cart
     */
    private function getOrCreateCart()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => Auth::id()
            ]);
        }
        
        return $cart;
    }
}