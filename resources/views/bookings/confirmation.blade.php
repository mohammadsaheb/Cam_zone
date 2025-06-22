@extends('layouts.app')

@section('content')
<div class="container">
    <div class="confirmation-content">
        <h1>Booking Confirmation</h1>
        
        <div class="confirmation-message">
            <h2>Thank you for your booking!</h2>
            <p>Your booking has been successfully confirmed.</p>
        </div>
        
        <div class="booking-details">
            <h3>Booking Details</h3>
            
            <div class="detail-item">
                <label>Date:</label>
                <span>{{ \Carbon\Carbon::parse($booking->booking_date)->format('l, F j, Y') }}</span>
            </div>
            
            <div class="detail-item">
                <label>Time:</label>
                <span>{{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }}</span>
            </div>
            
            <div class="detail-item">
                <label>Session Type:</label>
                <span>{{ $booking->service_type }}</span>
            </div>
            
            <div class="detail-item">
                <label>Location:</label>
                <span>{{ $booking->location }}</span>
            </div>
            
            @if($booking->notes)
            <div class="detail-item">
                <label>Notes:</label>
                <span>{{ $booking->notes }}</span>
            </div>
            @endif
        </div>
        
        <div class="action-buttons">
            <a href="{{ route('bookings.create') }}" class="btn-book-another">Book Another Session</a>
            <a href="{{ route('home') }}" class="btn-home">Return to Home</a>
        </div>
    </div>
</div>

<style>
.container {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
}

.confirmation-content {
    background: white;
    border-radius: 8px;
    padding: 40px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

h1 {
    color: #333;
    margin-bottom: 30px;
    font-size: 2.5rem;
}

.confirmation-message {
    text-align: center;
    margin-bottom: 40px;
}

.confirmation-message h2 {
    color: #28a745;
    margin-bottom: 10px;
}

.booking-details {
    background: #f8f9fa;
    border-radius: 6px;
    padding: 20px;
    margin-bottom: 30px;
}

.booking-details h3 {
    color: #333;
    margin-bottom: 20px;
}

.detail-item {
    display: flex;
    margin-bottom: 15px;
    font-size: 1.1rem;
}

.detail-item label {
    width: 120px;
    font-weight: bold;
    color: #555;
}

.detail-item span {
    color: #333;
}

.action-buttons {
    text-align: center;
    margin-top: 40px;
}

.btn-book-another,
.btn-home {
    display: inline-block;
    padding: 12px 30px;
    margin: 0 10px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 500;
    transition: background-color 0.2s;
}

.btn-book-another {
    background-color: #000;
    color: white;
}

.btn-book-another:hover {
    background-color: #333;
}

.btn-home {
    background-color: #6c757d;
    color: white;
}

.btn-home:hover {
    background-color: #5a6268;
}
</style>
@endsection