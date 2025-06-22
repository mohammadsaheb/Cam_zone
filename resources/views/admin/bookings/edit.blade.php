@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Booking #{{ $booking->id }}</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif
    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">User *</label>
            <select name="user_id" class="form-select" required>
                <option value="">-- Select User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $booking->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Booking Date *</label>
            <input type="date" name="booking_date" class="form-control" value="{{ old('booking_date', $booking->booking_date) }}" required>
        </div>
        <div class="mb-3 row">
            <div class="col">
                <label class="form-label">Start Time *</label>
                <input type="time" name="start_time" class="form-control" value="{{ old('start_time', $booking->start_time) }}" required>
            </div>
            <div class="col">
                <label class="form-label">End Time *</label>
                <input type="time" name="end_time" class="form-control" value="{{ old('end_time', $booking->end_time) }}" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Service Type *</label>
            <input type="text" name="service_type" class="form-control" value="{{ old('service_type', $booking->service_type) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Price *</label>
            <input type="number" name="price" step="0.01" min="0" class="form-control" value="{{ old('price', $booking->price) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status *</label>
            <select name="status" class="form-select" required>
                <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="completed" {{ old('status', $booking->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $booking->location) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control">{{ old('notes', $booking->notes) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Booking</button>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
