@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Booking Management</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Property</th>
                    <th>Guest</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->property->title }}</td>
                        <td>{{ $booking->guest->name }}</td>
                        <td>{{ $booking->start_date }}</td>
                        <td>{{ $booking->end_date }}</td>
                        <td>
                            <span class="fw-bold
                                {{ $booking->status === 'approved' ? 'text-success' : '' }}
                                {{ $booking->status === 'pending' ? 'text-warning' : '' }}
                                {{ $booking->status === 'cancelled' ? 'text-danger' : '' }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.bookings.update', $booking->id) }}" class="d-flex justify-content-between">
                                @csrf
                                <div class="form-group d-flex">
                                    <select name="status" class="form-control mr-2">
                                        <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $booking->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection