<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserBookingController extends Controller
{
    public function create()
    {
        return view('bookings.create');
    }

    public function getBookedSlots()
    {
        $bookedSlots = Booking::select('booking_date', 'start_time')
            ->where('status', '!=', 'cancelled')
            ->get();
            
        return response()->json($bookedSlots);
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'service_type' => 'required',
            'location' => 'required|in:Indoor,Outdoor',
            'notes' => 'nullable|string',
        ]);

        // Convert to 24-hour format for database
        $startTime = Carbon::parse($request->start_time);
        
        // Determine end time based on service type
        $endTime = match($request->service_type) {
            'Portrait Session (1 hour)' => $startTime->copy()->addHour(),
            'Family Session (2 hours)' => $startTime->copy()->addHours(2),
            'Product Photography (1 hour)' => $startTime->copy()->addHour(),
            'Event Coverage (3 hours)' => $startTime->copy()->addHours(3),
            default => $startTime->copy()->addHour(),
        };

        // Check for conflicts
        $conflict = Booking::where('booking_date', $request->booking_date)
            ->where('status', '!=', 'cancelled')
            ->where(function($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime->subMinute()])
                      ->orWhereBetween('end_time', [$startTime->addMinute(), $endTime])
                      ->orWhere(function($q) use ($startTime, $endTime) {
                          $q->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                      });
            })
            ->exists();

        if ($conflict) {
            return response()->json([
                'success' => false,
                'message' => 'This time slot is already booked!'
            ]);
        }

        $booking = Booking::create([
            'user_id' => auth()->id(), // Remove the () from id
            'booking_date' => $request->booking_date,
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $endTime->format('H:i:s'),
            'service_type' => $request->service_type,
            'price' => 0, // Set price to 0 or null
            'notes' => $request->notes,
            'location' => $request->location, // Save the selected location
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking created successfully!',
            'redirect' => route('bookings.confirmation', $booking->id)
        ]);
    }

    public function confirmation($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Make sure the booking belongs to the authenticated user
        if ($booking->user_id !== auth()->id()) { // Remove the () from id
            abort(403);
        }
        
        return view('bookings.confirmation', compact('booking'));
    }
}