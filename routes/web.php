<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;

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
Route::get('/signup', [IndexController::class, 'signup'])->name('signup');
Route::get('/signin', [IndexController::class, 'signin'])->name('signin');

/**Admin Route */
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
