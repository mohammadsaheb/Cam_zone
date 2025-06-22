<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // عرض كل الحجوزات
    public function index()
    {
        $bookings = Booking::with('user')->orderBy('booking_date', 'desc')->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    // صفحة إضافة حجز جديد
    public function create()
    {
        $users = User::all();
        return view('admin.bookings.create', compact('users'));
    }

    // حفظ الحجز الجديد
    public function store(Request $request)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
            'booking_date'  => 'required|date|after_or_equal:today',
            'start_time'    => 'required',
            'end_time'      => 'required|after:start_time',
            'status'        => 'required|in:pending,confirmed,completed,cancelled',
            'service_type'  => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'location'      => 'nullable|string|max:255',
            'notes'         => 'nullable|string',
        ]);

        Booking::create($request->all());

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking added successfully!');
    }

    // عرض تفاصيل الحجز
    public function show(Booking $booking)
    {
        $booking->load('user');
        return view('admin.bookings.show', compact('booking'));
    }

    // صفحة تعديل الحجز
    public function edit(Booking $booking)
    {
        $users = User::all();
        return view('admin.bookings.edit', compact('booking', 'users'));
    }

    // تحديث الحجز
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
            'booking_date'  => 'required|date|after_or_equal:today',
            'start_time'    => 'required',
            'end_time'      => 'required|after:start_time',
            'status'        => 'required|in:pending,confirmed,completed,cancelled',
            'service_type'  => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'location'      => 'nullable|string|max:255',
            'notes'         => 'nullable|string',
        ]);

        $booking->update($request->all());

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking updated successfully!');
    }

    // حذف الحجز
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully!');
    }
}
