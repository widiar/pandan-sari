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
Route::get('/booking', [BookingController::class, 'booking']);
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

Route::middleware(['auth', 'admin'])->group(function () {
    Route::name('admin.')->group(function () {
        Route::prefix('/admin')->group(function () {
            Route::get('/', function () {
                return redirect()->route('admin.login');
            });
            Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::resource('water-sport', WaterSportController::class);
        });
    });
});
