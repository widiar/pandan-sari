<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AboutusController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WaterSportController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('booking', [BookingController::class, 'booking'])->name('booking');
Route::get('/gallery', [GalleryController::class, 'gallery']);
Route::get('/aboutus', [AboutusController::class, 'aboutus']);
Route::get('/contact', [ContactController::class, 'contact']);

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('confirm-email', [AuthController::class, 'confirm'])->name('confirm');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('admin/login', function () {
    return view('admin.login');
})->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);

Route::get('detail/{id}', [HomeController::class, 'detail'])->name('detail');
Route::post('booking/add', [BookingController::class, 'add'])->name('add.booking');
Route::post('booking/change/amount', [BookingController::class, 'change'])->name('change.booking');
Route::post('booking/delete', [BookingController::class, 'delete'])->name('delete.booking');
Route::post('booking/delete/all', [BookingController::class, 'deleteAll'])->name('delete.all.booking');
Route::post('booking/post/identitas', [BookingController::class, 'identitas'])->name('identitas');
Route::post('booking/invoice', [BookingController::class, 'invoice'])->name('make.invoice');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::name('admin.')->group(function () {
        Route::prefix('/admin')->group(function () {
            Route::get('/', function () {
                return redirect()->route('admin.login');
            });
            Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::resource('water-sport', WaterSportController::class);

            Route::get('booking', [AdminController::class, 'booking'])->name('booking');
            Route::post('booking/verif', [AdminController::class, 'verifBooking'])->name('booking.verif');
            Route::post('booking/reject', [AdminController::class, 'rejectBooking'])->name('booking.reject');
        });
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('transaksi', [HomeController::class, 'transaksi'])->name('transaksi');
    Route::get('invoice/detail', [BookingController::class, 'detailInvoice'])->name('detail.invoice');
});
