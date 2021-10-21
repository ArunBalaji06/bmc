<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarRegisterController;
use App\Http\Controllers\DashboardController;


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
Route::get('/register',[AuthController::class,'getRegister'])->name('getregister');
Route::get('/post-register',[AuthController::class,'postRegister'])->name('postregister');
Route::get('/login',[AuthController::class,'getLogin'])->name('getlogin');
Route::get('/post-login',[AuthController::class,'postLogin'])->name('postlogin');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

// Car Registration //
Route::get('/car-register',[CarRegisterController::class,'getRegister'])->name('car.get_register');
Route::post('/post-car-register',[CarRegisterController::class,'postRegister'])->name('car.post_register');

//Dashboard
Route::get('/bmc',[DashboardController::class,'index'])->name('bmc');