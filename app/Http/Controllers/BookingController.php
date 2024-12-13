<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
{
    $bookings = Booking::with('property', 'guest')->get();
    return view('admin.bookings.index', compact('bookings'));
}

public function updateStatus(Request $request, $id)
{
    $booking = Booking::findOrFail($id);
    $booking->update(['status' => $request->status]);
    return redirect()->route('admin.bookings')->with('success', 'Booking status updated successfully!');
}

}
