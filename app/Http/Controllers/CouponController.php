<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        
        $request->validate([
            'code'             => 'required|string|unique:coupons,code',
            'type'             => 'required|in:fixed,percent',
            'value'            => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'valid_from'       => 'required|date',
            'valid_to'         => 'required|date|after_or_equal:valid_from',
            'usage_limit'      => 'nullable|integer|min:1',
            'is_active'        => 'boolean',
        ]);

        Coupon::create($request->all());

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon added successfully!');
    }

    public function show(Coupon $coupon)
    {
        return view('admin.coupons.show', compact('coupon'));
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        
        $request->validate([
            'code'             => 'required|string|unique:coupons,code,'.$coupon->id,
            'type'             => 'required|in:fixed,percent',
            'value'            => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'valid_from'       => 'required|date',
            'valid_to'         => 'required|date|after_or_equal:valid_from',
            'usage_limit'      => 'nullable|integer|min:1',
            'is_active'        => 'boolean',
        ]);

        $coupon->update($request->all());

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully!');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully!');
    }
}
