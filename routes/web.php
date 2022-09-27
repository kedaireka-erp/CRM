<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NcrController;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\RoleController;
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

    Route::get('/ncr', [NcrController::class, "index"]);

    Route::get('/ncr/create', [NcrController::class, "create"]);

    Route::post('/ncr', [NcrController::class, "store"]);

    Route::get('/ncr/{ncr}', [NcrController::class, "show"]);

    Route::get('/ncr/{ncr}/edit', [NcrController::class, "edit"]);

    Route::put('/ncr/{ncr}', [NcrController::class, "update"]);

    Route::delete('/ncr/{ncr}', [NcrController::class, "destroy"]);

    Route::get("/kontak", [KontakController::class, "index"]);

    Route::get("/kontak/create", [KontakController::class, "create"]);

    Route::post("/kontak", [KontakController::class, "store"]);

    Route::get("/kontak/{kontak}", [KontakController::class, "show"]);

    Route::get("/kontak/{kontak}/edit", [KontakController::class, "edit"]);

    Route::put("/kontak/{kontak}", [KontakController::class, "update"]);

    Route::delete("/kontak/{kontak}", [KontakController::class, "destroy"]);
    
    Route::get("/memo", [MemoController::class, "index"]);
    
    Route::get("/memo/{ncr}/create", [MemoController::class, "create"]);

    Route::get("/memo/{ncr}/edit", [MemoController::class, "edit"]);

    Route::put("/memo/{ncr}", [MemoController::class, "update"]);

    Route::delete("/memo/{ncr}", [MemoController::class, "destroy"]);

    Route::post("/memo/{ncr}", [MemoController::class, "store"]);

    Route::post("/ncr/validasi/{ncr}", [NcrController::class, "validasi"]);

    Route::post("/ncr/report", [NcrController::class, "report"]);

    Route::get("/memo/{ncr}", [MemoController::class, "show"]);
    
    Route::get('/memo/{ncr}/cetak', [MemoController::class, 'createPDF']);

    Route::get("/role", [RoleController::class, "index"])->middleware("role:Admin");

    Route::post("/role/{user}", [RoleController::class, "update"])->middleware("role:Admin");
});

Auth::routes(["register"=>false]);