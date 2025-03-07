<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PassengerController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [HomeController::class, 'index']);

Route::get('/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

// driver
Route::get('/login', [HomeController::class, 'login'])->name('loginForm');
Route::get('/register', [HomeController::class, 'register'])->name('registerForm');

Route::post('/login',[AuthController::class, 'login'])->name('loginAction');
Route::post('/register',[AuthController::class, 'register'])->name('registerAction');

Route::get('/driver', [DriverController::class, 'driverDashboard'])->name('driver');
Route::get('/driver', [DriverController::class, 'readTaxi'])->name('driver');

Route::post('/createTaxi', [DriverController::class, 'createTaxi'])->name('newTaxi');
Route::post('/updateTaxi', [DriverController::class, 'updateTaxi'])->name('updateTaxi');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/routes', [DriverController::class, 'routesDashboard'])->name('routes');
Route::post('/routes',[DriverController::class, 'createRoute'])->name('newPost');

Route::get('/routes', [DriverController::class, 'readRoute'])->name('routes');


// passenger
Route::get('/passenger', [PassengerController::class, 'passengerDashboard'])->name('passenger');
Route::get('/reservations', [PassengerController::class, 'reservationDashboard'])->name('bookings');
Route::get('/reservations', [PassengerController::class, 'readDrivers'])->name('bookings');
Route::post('/reservations', [PassengerController::class, 'createReservation'])->name('bookings');


// admin
Route::get('/admin', [AdminController::class, 'admin'])->name('admin');