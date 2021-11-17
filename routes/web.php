<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AboutusController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/booking', [BookingController::class, 'booking']);
Route::get('/gallery', [GalleryController::class, 'gallery']);
Route::get('/aboutus', [AboutusController::class, 'aboutus']);
Route::get('/contact', [ContactController::class, 'contact']);
Route::get('/admin', [AdminController::class, 'admin']);

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('confirm-email', [AuthController::class, 'confirm'])->name('confirm');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
