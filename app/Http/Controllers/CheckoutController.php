<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page
     */
    public function index()
    {
        // Get the user's cart
        $cart = Cart::where('user_id', Auth::id())->first();
        
        if (!$cart) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty!');
        }
    
        // Get cart items with product information
        $cartItems = $cart->items()->with(['product', 'product.images'])->get();
        
        // Calculate total - THIS IS THE MISSING PART
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }
        
        return view('checkout.index', compact('cartItems', 'total'));
    }

    /**
     * Process the order
     */
    public function placeOrder(Request $request)
    {
        // Validate the checkout form data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'payment_method' => 'required|in:cash_on_delivery,visa,mastercard,mada',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Get the user's cart
        $cart = Cart::where('user_id', Auth::id())->first();
        
        if (!$cart || $cart->items->count() === 0) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty!');
        }

        // Get cart items with product information
        $cartItems = $cart->items()->with('product')->get();
        
        // Calculate total
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        // Format shipping address
        $shippingAddress = $request->shipping_address . ', ' . $request->city;
        if ($request->postal_code) {
            $shippingAddress .= ', ' . $request->postal_code;
        }

        // Start database transaction
        DB::beginTransaction();
        
        try {
            // Create the order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'payment_method' => $request->payment_method,
                'shipping_address' => $shippingAddress,
                'billing_address' => $shippingAddress, // Using shipping as billing
                'payment_status' => $request->payment_method === 'cash_on_delivery' ? 'pending' : 'paid',
                'order_status' => 'pending',
            ]);
            
            // Create order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
                
                // Update product inventory (reduce quantity)
                $product = $item->product;
                
                // Ensure we don't set quantity to negative numbers
                $newQuantity = max(0, $product->quantity - $item->quantity);
                
                $product->update([
                    'quantity' => $newQuantity
                ]);
            }
            
            // Clear the cart
            $cart->items()->delete();
            
            // Commit transaction
            DB::commit();
            
            // Redirect to order confirmation page
            return redirect()->route('checkout.confirmation', $order->id)
                          ->with('success', 'Your order has been placed successfully!');
                          
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            
            return redirect()->back()->with('error', 'There was an error processing your order: ' . $e->getMessage());
        }
    }
    
    /**
     * Display order confirmation
     */
    public function confirmation($orderId)
    {
        $order = Order::with(['items.product', 'items.product.images'])->findOrFail($orderId);
        
        // Check if the order belongs to the current user
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('checkout.confirmation', compact('order'));
    }
}