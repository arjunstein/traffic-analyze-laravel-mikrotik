<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PPPoEController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class,'index'])->name('login');
Route::post('/login', [AuthController::class,'login'])->name('login.post');

Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');

Route::get('pppoe/secret', [PPPoEController::class,'index'])->name('pppoe.secret');
Route::post('pppoe/secret/store', [PPPoEController::class,'store'])->name('pppoe.store');
Route::get('pppoe/secret/edit/{id}', [PPPoEController::class,'edit'])->name('pppoe.edit');
Route::post('pppoe/secret/update', [PPPoEController::class,'update'])->name('pppoe.update');
