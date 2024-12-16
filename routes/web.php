<?php

use App\Models\Announcement;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FraudController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\DataExportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/weekly-bookings', [AdminController::class, 'weeklyBookings']);
    
    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/user-count', [UserController::class, 'getUserCount']);
    Route::get('/user-roles', [UserController::class, 'getUserRoles']);
    Route::post('/users/approve/{id}', [UserController::class, 'approve'])->name('users.approve');
    Route::post('/users/ban/{id}', [UserController::class, 'ban'])->name('users.ban');

    // Property Management
    Route::get('/properties', [PropertyController::class, 'index'])->name('properties');
    Route::post('/properties/approve/{id}', [PropertyController::class, 'approve'])->name('properties.approve');
    Route::post('/properties/reject/{id}', [PropertyController::class, 'reject'])->name('properties.reject');

    // Tickets
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets');
    Route::get('/unresolved-tickets', [TicketController::class, 'getUnresolvedTicketsCount']);
    Route::post('/tickets/update/{id}', [TicketController::class, 'updateStatus'])->name('tickets.update');

    // Hosts
    Route::get('/hosts', [HostController::class, 'index'])->name('hosts');
    Route::post('/hosts/verify/{id}', [HostController::class, 'verify'])->name('hosts.verify');
    Route::post('/hosts/reject/{id}', [HostController::class, 'reject'])->name('hosts.reject');

    // Bookings
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
    Route::get('/pending-bookings', [BookingController::class, 'getPendingBookingsCount']);
    Route::post('/bookings/update/{id}', [BookingController::class, 'updateStatus'])->name('bookings.update');

    // Analytics
    Route::get('/analytics', [AnalyticsController::class, 'dashboard'])->name('analytics');
    Route::get('/analytics/report', [AnalyticsController::class, 'downloadReport'])->name('analytics.report');

    // Transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
    Route::post('/transactions/update/{id}', [TransactionController::class, 'updateStatus'])->name('transactions.update');
    Route::get('/transactions/report', [TransactionController::class, 'generateReport'])->name('transactions.report');
    Route::get('/transactions/last', [TransactionController::class, 'getLastTransactions']);
    Route::get('/transactions/total-amount', [TransactionController::class, 'getTotalAmount']);

    // Security Logs
    Route::get('/security', [SecurityController::class, 'index'])->name('security');
    Route::post('/security/resolve/{id}', [SecurityController::class, 'resolve'])->name('security.resolve');

    // Announcements (Resource Route)
    Route::resource('announcements', AnnouncementController::class);

    require __DIR__.'/auth.php';

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
