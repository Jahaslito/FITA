<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScreeningDataController;

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
    return view('auth.index');
});

Auth::routes(['verify'=> true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::post('/personal_details',[ProfileController::class,'update_personal_details'])->name('personal_details');
Route::post('/password',[ProfileController::class,'change_password'])->name('change_password');
Route::post('/setting',[ProfileController::class,'change_email'])->name('change_email');
Route::post('/upload-profile-image', [ ProfileController::class, 'store_profile_image' ]);
Route::post('/submit-screening-data', [ScreeningDataController::class,'store_screening_data']);
