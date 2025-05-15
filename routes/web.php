<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute untuk admin dashboard dan fitur CRUD
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard route - perbaiki untuk mengarah ke view yang benar
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route untuk CRUD paket
    Route::resource('admin/packages', App\Http\Controllers\Admin\PackageController::class)->names('admin.packages');

    // Route untuk CRUD pesanan
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class);

    // Route untuk CRUD reservasi
    Route::resource('reservations', App\Http\Controllers\Admin\ReservationController::class);
});

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{package}', [PackageController::class, 'show'])->name('packages.show');

// Tiket route
Route::get('/tiket', [TicketController::class, 'index'])->name('tiket');

// Order process routes
Route::get('/booking', [OrderController::class, 'create'])->name('orders.create');
Route::post('/booking', [OrderController::class, 'store'])->name('orders.store');
Route::get('/payment/{orderNumber}', [OrderController::class, 'payment'])->name('orders.payment');
Route::get('/confirmation/{orderNumber}', [OrderController::class, 'confirmation'])->name('orders.confirmation');
Route::get('/tickets/{orderNumber}/download', [TicketController::class, 'download'])->name('tickets.download');

require __DIR__.'/auth.php';
