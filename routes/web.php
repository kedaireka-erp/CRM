<?php

use App\Models\Fppp;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NcrController;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\LoginController;
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

    Route::post("/ncr/validasi/{ncr}", [NcrController::class, "validasi"]);

    Route::get('/ncr', [NcrController::class, "index"]);

    Route::get('/ncr/create', [NcrController::class, "create"])->middleware("permission:add-ncr");

    Route::post('/ncr', [NcrController::class, "store"])->middleware("permission:add-ncr");

    Route::get('/ncr/{ncr}', [NcrController::class, "show"]);

    Route::get('/ncr/{ncr}/edit', [NcrController::class, "edit"])->middleware("permission:edit-ncr");

    Route::put('/ncr/{ncr}', [NcrController::class, "update"])->middleware("permission:edit-ncr");

    Route::delete('/ncr/{ncr}', [NcrController::class, "destroy"])->middleware("permission:delete-ncr");

    Route::get("/kontak", [KontakController::class, "index"]);

    Route::get("/kontak/create", [KontakController::class, "create"])->middleware("permission:add-kontak");

    Route::post("/kontak", [KontakController::class, "store"])->middleware("permission:add-kontak");

    Route::get("/kontak/{kontak}/edit", [KontakController::class, "edit"])->middleware("permission:edit-kontak");

    Route::put("/kontak/{kontak}", [KontakController::class, "update"])->middleware("permission:edit-kontak");

    Route::delete("/kontak/{kontak}", [KontakController::class, "destroy"])->middleware("permission:delete-kontak");

    Route::get("/memo", [MemoController::class, "index"]);

    Route::get("/memo/{ncr}/create", [MemoController::class, "create"])->middleware("permission:add-memo");

    Route::get("/memo/{ncr}/edit", [MemoController::class, "edit"])->middleware("permission:edit-memo");

    Route::put("/memo/{ncr}", [MemoController::class, "update"])->middleware("permission:edit-memo");

    Route::delete("/memo/{ncr}", [MemoController::class, "destroy"])->middleware("permission:delete-memo");

    Route::post("/memo/{ncr}", [MemoController::class, "store"])->middleware("permission:add-memo");

    Route::post("/ncr/report", [NcrController::class, "report"]);

    Route::get("/memo/{ncr}", [MemoController::class, "show"]);

    Route::get('/memo/{ncr}/cetak', [MemoController::class, 'createPDF']);
});

Route::get("/validate", [NcrController::class, "validate"]);

Route::get("/login", [LoginController::class, "index"])->name("login");

Route::post("/login", [LoginController::class, "login"]);

Route::post("/logout", [LoginController::class, "logout"])->name("logout");
