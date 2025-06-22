@extends('layouts.admin')
@section('content')
<style>
/* Modal/Popup Styles */
.modal-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1050;
}

.modal-content {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    width: 80%;
    max-width: 700px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {transform: translateY(-50px); opacity: 0;}
    to {transform: translateY(0); opacity: 1;}
}

.modal-header {
    padding: 15px 20px;
    border-bottom: 1px solid #eaeaea;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    background-color: white;
    z-index: 1;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.modal-title {
    margin: 0;
    font-weight: 600;
    color: #333;
    font-size: 1.5rem;
}

.booking-id {
    color: #6c757d;
    font-weight: normal;
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: #777;
    transition: color 0.2s;
}

.modal-close:hover {
    color: #333;
}

.modal-body {
    padding: 20px;
}

.modal-footer {
    padding: 15px 20px;
    border-top: 1px solid #eaeaea;
    text-align: right;
    position: sticky;
    bottom: 0;
    background-color: white;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
}

/* Booking Details Styles */
.booking-details {
    margin-bottom: 0;
    line-height: 1.6;
}

.info-row {
    margin-bottom: 15px;
    display: flex;
    flex-wrap: wrap;
}

.info-label {
    font-weight: 600;
    width: 120px;
    color: #555;
}

.info-value {
    flex: 1;
}

.status-indicator {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
    text-transform: capitalize;
}

.status-pending {
    background-color: #ffc107;
    color: #212529;
}

.status-confirmed {
    background-color: #28a745;
    color: white;
}

.status-completed {
    background-color: #007bff;
    color: white;
}

.status-cancelled {
    background-color: #dc3545;
    color: white;
}

.user-email {
    color: #6c757d;
    font-size: 14px;
    margin-left: 5px;
}

.price-value {
    font-weight: 600;
    color: #28a745;
}

.created-date {
    color: #6c757d;
    font-size: 14px;
    font-style: italic;
}

.btn-back {
    background-color: #6c757d;
    border-color: #6c757d;
    color: white;
    padding: 8px 20px;
    border-radius: 4px;
    text-decoration: none;
    display: inline-block;
    transition: background-color 0.2s;
}

.btn-back:hover {
    background-color: #5a6268;
    border-color: #545b62;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
    padding: 8px 20px;
    border-radius: 4px;
    text-decoration: none;
    display: inline-block;
    margin-left: 10px;
    transition: background-color 0.2s;
}

.btn-primary:hover {
    background-color: #0069d9;
    border-color: #0062cc;
}

@media (max-width: 768px) {
    .modal-content {
        width: 95%;
    }
    
    .info-label {
        width: 100%;
        margin-bottom: 5px;
    }
    
    .info-value {
        width: 100%;
    }
}
</style>

<div class="modal-container">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Booking <span class="booking-id">#{{ $booking->id }}</span></h2>
            <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="booking-details">
                <div class="info-row">
                    <div class="info-label">User:</div>
                    <div class="info-value">
                        {{ $booking->user->name ?? '-' }} 
                        @if($booking->user && $booking->user->email)
                            <span class="user-email">({{ $booking->user->email }})</span>
                        @endif
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Date:</div>
                    <div class="info-value">{{ $booking->booking_date }}</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Time:</div>
                    <div class="info-value">{{ $booking->start_time }} - {{ $booking->end_time }}</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Status:</div>
                    <div class="info-value">
                        <span class="status-indicator status-{{ strtolower($booking->status) }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Service:</div>
                    <div class="info-value">{{ $booking->service_type }}</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Location:</div>
                    <div class="info-value">{{ $booking->location ?? '-' }}</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Price:</div>
                    <div class="info-value"><span class="price-value">{{ $booking->price }} JD</span></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Notes:</div>
                    <div class="info-value">{{ $booking->notes ?? '-' }}</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Created At:</div>
                    <div class="info-value">
                        <span class="created-date">{{ $booking->created_at->format('Y-m-d H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="{{ route('admin.bookings.index') }}" class="btn-back">Back to Bookings</a>
            @if($booking->status == 'pending')
                <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn-primary">Edit Booking</a>
            @endif
        </div>
    </div>
</div>

<script>
    function closeModal() {
        window.location.href = "{{ route('admin.bookings.index') }}";
    }
    
    // Close modal when clicking outside
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.querySelector('.modal-container');
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModal();
            }
        });
        
        // Close on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    });
</script>
@endsection