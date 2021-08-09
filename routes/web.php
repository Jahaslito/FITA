<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScreeningDataController;
use App\Http\Controllers\TrainFace;

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
    return view('auth.login');
});

Auth::routes(['verify'=> true]);

Route::middleware('verified')->group(function (){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/train_face', [HomeController::class, 'train_face'])->name('train_face');
    Route::post('/train_face', [TrainFace::class, 'detectPhoto']);
    Route::post('/personal_details',[ProfileController::class,'update_personal_details'])->name('personal_details');
    Route::post('/password',[ProfileController::class,'change_password'])->name('change_password')->middleware('verified');
    Route::post('/setting',[ProfileController::class,'change_email'])->name('change_email');
    Route::post('/upload-profile-image', [ ProfileController::class, 'store_profile_image' ]);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::post('/personal_details',[ProfileController::class,'update_personal_details'])->name('personal_details');
    Route::post('/password',[ProfileController::class,'change_password'])->name('change_password');
    Route::post('/setting',[ProfileController::class,'change_email'])->name('change_email');
    Route::post('/upload-profile-image', [ ProfileController::class, 'store_profile_image' ]);
    Route::post('/submit-screening-data', [ScreeningDataController::class,'store_screening_data']);

});

Route::get('/admin',[\App\Http\Controllers\DashboardController::class, 'resources'])->middleware('role:admin');

Route::resource('users', \App\Http\Controllers\UserController::class)->middleware('role:admin');
Route::resource('roles', \App\Http\Controllers\RoleController::class)->middleware('role:admin');
Route::resource('permissions', \App\Http\Controllers\PermissionController::class)->middleware('role:admin');
Route::get('disable/{id}', [\App\Http\Controllers\UserController::class, 'disable'])->name('disable');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
