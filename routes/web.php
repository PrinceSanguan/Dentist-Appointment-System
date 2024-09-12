<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('welcome');

Route::get('/signup', [SignupController::class, 'index'])->name('signup');
Route::post('/signup', [SignupController::class, 'signup'])->name('signup-form');

Route::get('/signin', [IndexController::class, 'signin'])->name('signin');
Route::post('/signin', [LoginController::class, 'loginForm'])->name('login-form');


/**Admin Route */
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/dentist', [AdminController::class, 'dentist'])->name('admin.dentist');
Route::get('/admin/schedule', [AdminController::class, 'schedule'])->name('admin.schedule');
Route::get('/admin/appointment', [AdminController::class, 'appointment'])->name('admin.appointment');
Route::get('/admin/patient', [AdminController::class, 'patient'])->name('admin.patient');

/**Admin Route */

    /******************************************** This Route is For Logout *****************************/
    Route::get('/logout', function (Request $request) {
      Session::flush();
      Auth::logout();
  
      return redirect()->route('signin');
  })->name('logout');
  /******************************************** This Route is For Logout *****************************/
