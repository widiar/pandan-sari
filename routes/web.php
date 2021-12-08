<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AboutusController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WaterSportController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('booking', [BookingController::class, 'booking'])->name('booking');
Route::get('gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('about', [HomeController::class, 'about'])->name('about');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::post('contact', [HomeController::class, 'sendContact']);

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('confirm-email', [AuthController::class, 'confirm'])->name('confirm');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('admin/login', function () {
    return view('admin.login');
})->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);

Route::get('detail/{id}', [HomeController::class, 'detail'])->name('detail');

Route::post('check/email', [AuthController::class, 'emailCheck'])->name('check.email');

//admin
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

            Route::get('transaksi', [AdminController::class, 'transaksi'])->name('transaksi');
            Route::get('transaksi/print', [AdminController::class, 'transaksiPrint'])->name('transaksi.print');

            Route::resource('gallery', GalleryController::class);
        });
    });
});

//auth
Route::middleware(['auth'])->group(function () {
    Route::get('transaksi', [HomeController::class, 'transaksi'])->name('transaksi');
    Route::post('transaksi/upload', [BookingController::class, 'uploadUlang'])->name('upload.ulang');
    Route::get('invoice/detail', [BookingController::class, 'detailInvoice'])->name('detail.invoice');

    Route::post('booking/add', [BookingController::class, 'add'])->name('add.booking');
    Route::post('booking/change/amount', [BookingController::class, 'change'])->name('change.booking');
    Route::post('booking/delete', [BookingController::class, 'delete'])->name('delete.booking');
    Route::post('booking/delete/all', [BookingController::class, 'deleteAll'])->name('delete.all.booking');
    Route::post('booking/post/identitas', [BookingController::class, 'identitas'])->name('identitas');
    Route::post('booking/invoice', [BookingController::class, 'invoice'])->name('make.invoice');

    Route::get('akun', [HomeController::class, 'akun'])->name('akun');
    Route::post('akun', [HomeController::class, 'updateAkun']);
});

Route::get('invoices', [HomeController::class, 'invoiceMail'])->name('mail.invoice');

Route::get('dev', [AdminController::class, 'dev']);
