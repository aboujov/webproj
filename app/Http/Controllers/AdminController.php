<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
{
    return view('admin.dashboard');
}

public function logs()
{
    $logs = file(storage_path('logs/laravel.log'));
    return view('admin.logs', compact('logs'));
}

public function weeklyBookings()
    {
        $data = [];
        $startDate = Carbon::now()->subDays(6);

        for ($i = 0; $i < 7; $i++) {
            $date = $startDate->copy()->addDays($i);
            $count = Booking::whereDate('start_date', $date)->count();
            $data[] = [
                'date' => $date->format('Y-m-d'),
                'count' => $count
            ];
        }

        return response()->json($data);
    }

}
