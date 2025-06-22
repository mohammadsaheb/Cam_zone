@extends('layouts.admin')

@section('content')
<h2>Bookings</h2>

<!-- إضافة زر Add Booking على اليمين -->
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary">Add Booking</a>
</div>

<table class="table table-striped table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>User</th>
            <th>Booking Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Status</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($bookings as $booking)
        <tr>
            <td>{{ $booking->id }}</td>
            <td>{{ $booking->user->name ?? '-' }}</td>
            <td>{{ $booking->booking_date }}</td>
            <td>{{ $booking->start_time }}</td>
            <td>{{ $booking->end_time }}</td>
            <td>
                <span class="badge bg-{{ $booking->status == 'confirmed' ? 'success' : ($booking->status == 'cancelled' ? 'danger' : 'secondary') }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </td>
            <td class="text-center">
                <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-info btn-sm" title="Show">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('admin.bookings.edit', $booking) }}" class="btn btn-warning btn-sm" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection