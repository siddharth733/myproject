<?php

use App\Http\Controllers\BusController;
use App\Http\Controllers\UserController;
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

Route::get('/',[UserController::class,'show'])->name('customer.view');
Route::get('/show',[UserController::class,'view'])->name('customer.show');
Route::post('/register',[UserController::class,'register']);
