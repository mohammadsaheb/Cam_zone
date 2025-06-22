<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    // عرض جميع عناصر الطلب
    public function index()
    {
        $orderItems = OrderItem::with(['order', 'product'])->get();
        return view('admin.order_items.index', compact('orderItems'));
    }

    // صفحة إضافة عنصر طلب جديد
    public function create()
    {
        $orders = Order::all();
        $products = Product::all();
        return view('admin.order_items.create', compact('orders', 'products'));
    }

    // حفظ عنصر طلب جديد
    public function store(Request $request)
    {
        $request->validate([
            'order_id'   => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'price'      => 'required|numeric|min:0',
        ]);

        OrderItem::create($request->all());

        return redirect()->route('order-items.index')
            ->with('success', 'Order item added successfully!');
    }

    // عرض تفاصيل عنصر الطلب
    public function show(OrderItem $orderItem)
    {
        $orderItem->load('order', 'product');
        return view('admin.order_items.show', compact('orderItem'));
    }

    // صفحة تعديل عنصر الطلب
    public function edit(OrderItem $orderItem)
    {
        $orders = Order::all();
        $products = Product::all();
        return view('admin.order_items.edit', compact('orderItem', 'orders', 'products'));
    }

    // تحديث عنصر الطلب
    public function update(Request $request, OrderItem $orderItem)
    {
        $request->validate([
            'order_id'   => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'price'      => 'required|numeric|min:0',
        ]);

        $orderItem->update($request->all());

        return redirect()->route('admin.order-items.index')
            ->with('success', 'Order item updated successfully!');
    }

    // حذف عنصر الطلب
    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();
        return redirect()->route('admin.order-items.index')
            ->with('success', 'Order item deleted successfully!');
    }
}
