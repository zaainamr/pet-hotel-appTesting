<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin Dashboard
Route::get('/admin/dashboard', function () {
    return view('admin-dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard');

// Customer Dashboard
Route::get('/customer/dashboard', function () {
    return view('customer-dashboard');
})->middleware(['auth', 'verified', 'customer'])->name('customer.dashboard');

// Legacy dashboard route (redirect based on role)
Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('customer.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pet Hotel resources (Admin only)
    Route::resource('owners', OwnerController::class);
    Route::resource('pets', PetController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('services', ServiceController::class)->except(['create','edit']);
    Route::resource('bookings', BookingController::class);
    Route::resource('invoices', InvoiceController::class)->only(['index','show','update']);

    // Reports (Admin only)
    Route::get('reports/bookings', [ReportController::class, 'bookings'])->name('reports.bookings');
    Route::get('reports/income', [ReportController::class, 'income'])->name('reports.income');
});

require __DIR__.'/auth.php';
