@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Platform Analytics</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h2 class="h4 mb-0">User Metrics</h2>
                </div>
                <div class="card-body">
                    <p class="mb-1">Total Users: <span class="fw-bold">{{ $totalUsers }}</span></p>
                    <p class="mb-1">Active Users (last 30 days): <span class="fw-bold">{{ $activeUsers }}</span></p>
                    <p class="mb-0">New Signups (last 30 days): <span class="fw-bold">{{ $newSignups }}</span></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h2 class="h4 mb-0">Booking Metrics</h2>
                </div>
                <div class="card-body">
                    <p class="mb-1">Total Bookings: <span class="fw-bold">{{ $totalBookings }}</span></p>
                    <p class="mb-1">Approved Bookings: <span class="fw-bold">{{ $approvedBookings }}</span></p>
                    <p class="mb-0">Cancelled Bookings: <span class="fw-bold">{{ $cancelledBookings }}</span></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h2 class="h4 mb-0">Revenue Metrics</h2>
                </div>
                <div class="card-body">
                    <p class="mb-1">Total Revenue: <span class="fw-bold">${{ number_format($totalRevenue, 2) }}</span></p>
                    <p class="mb-1">Host Earnings: <span class="fw-bold">${{ number_format($hostEarnings, 2) }}</span></p>
                    <p class="mb-0">Platform Earnings: <span class="fw-bold">${{ number_format($platformEarnings, 2) }}</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h2 class="h4 mb-0">Top 3 Popular Locations</h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Location</th>
                                <th>Total Bookings</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topLocations as $location)
                                <tr>
                                    <td>{{ $location->location }}</td>
                                    <td>{{ $location->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h2 class="h4 mb-0">Booking Trends (Last 12 Months)</h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Month</th>
                                <th>Total Bookings</th>
                                <th>Top Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookingTrends as $trend)
                                <tr>
                                    <td>{{ $trend->month }}</td>
                                    <td>{{ $trend->total }}</td>
                                    <td>{{ $trend->top_location }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('admin.analytics.report') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-download mr-2"></i>Download Full Report
        </a>
    </div>
</div>
@endsection