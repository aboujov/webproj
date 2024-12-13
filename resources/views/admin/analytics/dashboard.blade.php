@extends('layouts.admin')

@section('content')
    <h1>Platform Analytics</h1>

    <section>
        <h2>User Metrics</h2>
        <p>Total Users: {{ $totalUsers }}</p>
        <p>Active Users (last 30 days): {{ $activeUsers }}</p>
        <p>New Signups (last 30 days): {{ $newSignups }}</p>
    </section>

    <section>
        <h2>Booking Metrics</h2>
        <p>Total Bookings: {{ $totalBookings }}</p>
        <p>Approved Bookings: {{ $approvedBookings }}</p>
        <p>Cancelled Bookings: {{ $cancelledBookings }}</p>
    </section>

    <section>
        <h2>Revenue Metrics</h2>
        <p>Total Revenue: ${{ number_format($totalRevenue, 2) }}</p>
        <p>Host Earnings: ${{ number_format($hostEarnings, 2) }}</p>
        <p>Platform Earnings: ${{ number_format($platformEarnings, 2) }}</p>
    </section>

    <section>
        <h2>Top 3 Popular Locations</h2>
        <table border="1">
            <thead>
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
    </section>    

    <section>
        <h2>Booking Trends (Last 12 Months)</h2>
        <table border="1">
            <thead>
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
    </section>

    <section>
        <a href="{{ route('admin.analytics.report') }}">Download Full Report</a>
    </section>
@endsection
