<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NcrController;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\KontakController;
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

Route::middleware("auth")->group(function () {
    Route::get('/', [DashboardController::class, "index"]);
    
    Route::resource('ncr', NcrController::class);
    
    Route::resource('kontak', KontakController::class);
    
    Route::get("/memo", [MemoController::class, "index"]);
    
    Route::get("/memo/{ncr}/create", [MemoController::class, "create"]);
});

Auth::routes();