<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'orderItems.product');
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        // إذا تحتاج تعديل المستخدم (اختياري)
        $users = User::all();
        return view('admin.orders.edit', compact('order', 'users'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'order_status'     => 'required|in:pending,processing,shipped,delivered,cancelled',
            'payment_status'   => 'required|in:pending,paid,failed',
            'shipping_address' => 'required|string',
            'billing_address'  => 'nullable|string',
            'tracking_number'  => 'nullable|string',
        ]);

        $order->update($request->only([
            'order_status',
            'payment_status',
            'shipping_address',
            'billing_address',
            'tracking_number'
        ]));

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order updated successfully!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully!');
    }
}
