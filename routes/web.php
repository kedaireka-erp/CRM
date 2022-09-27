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
    
    Route::resource('ncr', NcrController::class);
    
    Route::resource('kontak', KontakController::class);
    
    Route::get("/memo", [MemoController::class, "index"]);
    
    Route::get("/memo/{ncr}/create", [MemoController::class, "create"]);

    Route::get("/memo/{ncr}/edit", [MemoController::class, "edit"]);

    Route::put("/memo/{ncr}", [MemoController::class, "update"]);

    Route::delete("/memo/{ncr}", [MemoController::class, "destroy"]);

    Route::post("/memo/{ncr}", [MemoController::class, "store"]);

    Route::post("/ncr/validasi/{ncr}", [NcrController::class, "validasi"]);

    Route::post("/ncr/report", [NcrController::class, "report"]);

    Route::get("/memo/{ncr}", [MemoController::class, "show"]);

    Route::get("/role", [RoleController::class, "index"]);

    Route::post("/role/{user}", [RoleController::class, "update"]);

    Route::get('/memo/{ncr}/cetak', [MemoController::class, 'createPDF']);
});

Route::group(['middleware' => ['role:admin','permission:add-kontak|edit-kontak|delete-kontak|add-ncr|edit-ncr|delete-ncr|create-memo|edit-memo|delete-memo']], function () {
    Route::get('/', [DashboardController::class, "index"]);
    
    Route::resource('ncr', NcrController::class);
    
    Route::resource('kontak', KontakController::class);
    
    Route::get("/memo", [MemoController::class, "index"]);
    
    Route::get("/memo/{ncr}/create", [MemoController::class, "create"]);

    Route::get("/memo/{ncr}/edit", [MemoController::class, "edit"]);

    Route::put("/memo/{ncr}", [MemoController::class, "update"]);

    Route::delete("/memo/{ncr}", [MemoController::class, "destroy"]);

    Route::post("/memo/{ncr}", [MemoController::class, "store"]);

    Route::post("/ncr/validasi/{ncr}", [NcrController::class, "validasi"]);

    Route::post("/ncr/report", [NcrController::class, "report"]);

    Route::get("/memo/{ncr}", [MemoController::class, "show"]);

    Route::get("/role", [RoleController::class, "index"]);

    Route::post("/role/{user}", [RoleController::class, "update"]);

    Route::get('/memo/{ncr}/cetak', [MemoController::class, 'createPDF']);
});

Auth::routes(["register"=>false]);