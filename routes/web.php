<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AboutusController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/booking', [BookingController::class, 'booking']);
Route::get('/gallery', [GalleryController::class, 'gallery']);
Route::get('/aboutus', [AboutusController::class, 'aboutus']);
Route::get('/contact', [ContactController::class, 'contact']);
Route::get('/admin', [AdminController::class, 'admin']);
