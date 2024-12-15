<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function dashboard()
{
    // User metrics
    $totalUsers = User::where('role', '!=', 'admin')->count();
    $activeUsers = User::where('role', '!=', 'admin')->where('last_login', '>=', now()->subDays(30))->count(); // Assuming a `last_login` column exists
    $newSignups = User::where('role', '!=', 'admin')->where('created_at', '>=', now()->subDays(30))->count();

    // Booking metrics
    $totalBookings = Booking::count();
    $approvedBookings = Booking::where('status', 'approved')->count();
    $cancelledBookings = Booking::where('status', 'cancelled')->count();

    // Revenue metrics
    $totalRevenue = Booking::where('status', 'approved')->sum('amount'); // Assuming `amount` column exists
    $hostEarnings = $totalRevenue * 0.9; // Assuming 10% platform commission
    $platformEarnings = $totalRevenue * 0.1;

    $popularLocations = Booking::join('properties', 'bookings.property_id', '=', 'properties.id')
    ->select('properties.location')
    ->groupBy('properties.location')
    ->orderByRaw('COUNT(bookings.id) DESC')
    ->take(5)
    ->pluck('properties.location');
    $bookingTrends = Booking::selectRaw('
    DATE_FORMAT(bookings.created_at, "%Y-%m") as month, 
    COUNT(bookings.id) as total, 
    properties.location as top_location')
    ->join('properties', 'bookings.property_id', '=', 'properties.id')
    ->where('bookings.created_at', '>=', now()->subMonths(12)) // Last 12 months
    ->groupBy('month', 'properties.location')
    ->orderBy('month', 'asc')
    ->get();
    $topLocations = Booking::selectRaw('properties.location, COUNT(bookings.id) as total')
    ->join('properties', 'bookings.property_id', '=', 'properties.id')
    ->where('bookings.created_at', '>=', now()->subMonths(12)) // Last 12 months
    ->groupBy('properties.location')
    ->orderBy('total', 'desc')
    ->take(3)
    ->get();



    return view('admin.analytics.dashboard', compact(
        'totalUsers', 'activeUsers', 'newSignups',
        'totalBookings', 'approvedBookings', 'cancelledBookings',
        'totalRevenue', 'hostEarnings', 'platformEarnings', 'popularLocations', 'bookingTrends', 'topLocations'
    ));
}

public function downloadReport()
{
    $data = [
        'users' => User::all(),
        'bookings' => Booking::with('property', 'guest')->get(),
        'totalRevenue' => Booking::where('status', 'approved')->sum('amount'),
    ];

    $filename = 'analytics_report_' . now()->format('Y-m-d') . '.json';
    return response()->json($data)->header('Content-Disposition', "attachment; filename=$filename");
}


}
