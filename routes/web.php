<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarRegisterController;


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

// Car Registration //
Route::get('/car-register',[CarRegisterController::class,'getRegister'])->name('car.get_register');


Route::get('/bmc',[AuthController::class,'index'])->name('bmc');