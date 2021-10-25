<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarRegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClientAuthController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Authentication //
Route::get('/owner-register',[AuthController::class,'getRegister'])->name('owner.getregister');
Route::post('/owner-post-register',[AuthController::class,'postRegister'])->name('owner.postregister');
Route::get('/owner-login',[AuthController::class,'getLogin'])->name('owner.getlogin');
Route::post('/owner-post-login',[AuthController::class,'postLogin'])->name('owner.postlogin');
Route::post('/owner-profile-add',[AuthController::class,'firstProfile'])->name('owner.firstprofile');
Route::get('/view-owner-profile',[AuthController::class,'viewProfile'])->name('owner.view_profile');
Route::post('/update-owner-profile',[AuthController::class,'updateProfile'])->name('owner.update_profile');
Route::post('/delete-owner/{id}',[AuthController::class,'deleteOwner'])->name('owner.delete');
Route::get('/owner-logout',[AuthController::class,'logout'])->name('owner.logout');

// Car-Registration //
Route::get('/car-register',[CarRegisterController::class,'getRegister'])->name('car.get_register');
Route::post('/post-car-register',[CarRegisterController::class,'postRegister'])->name('car.post_register');
Route::get('/view-car/{id}',[CarRegisterController::class,'viewCarDetails'])->name('car.view_car');
Route::get('/edit-car/{id}',[CarRegisterController::class,'editCar'])->name('car.edit_car');
Route::post('/update-car',[CarRegisterController::class,'updateCar'])->name('car.update_car');
Route::get('/delete-car/{id}',[CarRegisterController::class,'deleteCar'])->name('car.delete');

//Owner-Dashboard
Route::get('/bmc',[DashboardController::class,'index'])->name('owner.bmc');

// Booking
Route::get('/request/{id}',[BookingController::class,'requestGiven'])->name('booking.request');
Route::get('/accept-request/{id}',[BookingController::class,'acceptRequest'])->name('booking.accept');
Route::post('/reject-request',[BookingController::class,'rejectRequest'])->name('booking.reject');
