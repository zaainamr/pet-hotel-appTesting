<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Language Switcher Route
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

// Admin Dashboard
Route::get('/admin/dashboard', function () {
    $totalOwners = \App\Models\Owner::count();
    $totalPets = \App\Models\Pet::count();
    $availableRooms = \App\Models\Room::where('status', 'available')->count();
    $monthlyRevenue = \App\Models\Invoice::whereMonth('created_at', now()->month)->sum('amount');
    $latestBookings = \App\Models\Booking::with(['pet.owner', 'room'])->latest()->take(10)->get();
    
    return view('admin-dashboard', compact('totalOwners', 'totalPets', 'availableRooms', 'monthlyRevenue', 'latestBookings'));
})->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard');

// Customer Dashboard
Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])
    ->middleware(['auth', 'verified', 'customer'])
    ->name('customer.dashboard');

// Legacy dashboard route (redirect based on role)
Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('customer.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
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
    Route::patch('bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    Route::resource('invoices', InvoiceController::class)->only(['index','show','update']);

    // Reports (Admin only)
    Route::get('reports/bookings', [ReportController::class, 'bookings'])->name('reports.bookings');
    Route::get('reports/income', [ReportController::class, 'income'])->name('reports.income');
    
    // Messages (Admin)
    Route::get('/messages', [MessageController::class, 'adminIndex'])->name('messages.index');
    Route::get('/messages/{customer}', [MessageController::class, 'adminShow'])->name('messages.show');
    Route::post('/messages/{customer}', [MessageController::class, 'adminStore'])->name('messages.store');
});

// Customer Routes
Route::middleware(['auth', 'customer'])->prefix('customer')->group(function () {
    Route::get('/rooms', [CustomerController::class, 'rooms'])->name('customer.rooms');
    Route::get('/book/{room}', [CustomerController::class, 'book'])->name('customer.book');
    Route::post('/book', [CustomerController::class, 'storeBooking'])->name('customer.storeBooking');
    Route::get('/profile', [CustomerController::class, 'profile'])->name('customer.profile');
    Route::put('/profile', [CustomerController::class, 'updateProfile'])->name('customer.updateProfile');
    Route::get('/bookings', [CustomerController::class, 'myBookings'])->name('customer.bookings');
    
    // Pet Management
    Route::get('/pets', [CustomerController::class, 'myPets'])->name('customer.pets.index');
    Route::get('/pets/create', [CustomerController::class, 'createPet'])->name('customer.pets.create');
    Route::post('/pets', [CustomerController::class, 'storePet'])->name('customer.pets.store');
    Route::get('/pets/{pet}/edit', [CustomerController::class, 'editPet'])->name('customer.pets.edit');
    Route::put('/pets/{pet}', [CustomerController::class, 'updatePet'])->name('customer.pets.update');
    Route::delete('/pets/{pet}', [CustomerController::class, 'deletePet'])->name('customer.pets.destroy');
    
    // Notifications
    Route::get('/notifications', [CustomerController::class, 'notifications'])->name('customer.notifications.index');
    Route::post('/notifications/{notification}/read', [CustomerController::class, 'markNotificationRead'])->name('customer.notifications.markRead');
    Route::post('/notifications/mark-all-read', [CustomerController::class, 'markAllNotificationsRead'])->name('customer.notifications.markAllRead');
    
    // Invoices
    Route::get('/invoices', [CustomerController::class, 'invoices'])->name('customer.invoices.index');
    Route::get('/invoices/{invoice}', [CustomerController::class, 'showInvoice'])->name('customer.invoices.show');
    
    // Messages
    Route::get('/messages', [MessageController::class, 'customerIndex'])->name('customer.messages.index');
    Route::post('/messages', [MessageController::class, 'customerStore'])->name('customer.messages.store');
});

// API Routes for Notifications (Polling)
Route::middleware('auth')->prefix('api')->group(function () {
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount']);
    Route::get('/notifications', [NotificationController::class, 'apiIndex']);
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::get('/messages/unread-count', [MessageController::class, 'unreadCount']);
});

require __DIR__.'/auth.php';
