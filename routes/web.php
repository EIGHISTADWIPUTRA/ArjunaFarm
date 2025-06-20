<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::resource('/', HomeController::class)->only(['index'])->names([
    'index' => 'home',
]);

Route::get('/ticket', [TicketController::class, 'showTickets'])->name('ticket');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/invoice', [PaymentController::class, 'createTransaction'])->name('payment.create');
Route::post('/transaction-result', [PaymentController::class, 'handleResult'])->name('payment.result');
Route::post('/notification-handler', [PaymentController::class, 'notificationHandler'])->name('payment.notification');

Route::get('/invoice/{id}', [PaymentController::class, 'showInvoice'])->name('invoice.show');
Route::get('/receipt/{id}/download', [App\Http\Controllers\ReceiptController::class, 'downloadReceipt'])->name('receipt.download');

Route::view('/tentang', 'tentang')->name('tentang');

require __DIR__.'/auth.php';
