<?php

use App\Models\Ncr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NcrController;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\KontakController;

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
    $ncr = Ncr::whereHas("Kontak", function($ncr) {
                $ncr->where("kontak_id", auth()->user()->id)->where("validated", 0);
            })->get()->filter(function ($value, $key) {
                return $value->Kontak->filter(function($kontak, $key) {
                    if ($kontak->id == auth()->user()->id) {
                        if ($key == 0) {
                            return true;
                        } else {
                            if (DB::table("kontak_ncr")->where("id", $kontak->pivot->id - 1)->first()->validated == 1) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                })->count() > 0;
            });
    return view('dashboard', [
        "title" => "Home",
        "ncr_open" => 10,
        "ncr_closed" => 20,
        "ncr_total" => 30,
        "need_approval" => $ncr->values()->all()
    ]);
});

Route::resource('ncr', NcrController::class);

Route::resource('kontak', KontakController::class);

Auth::routes();

Route::get("/memo", [MemoController::class, "index"]);

Route::get("/memo/{ncr}/create", [MemoController::class, "create"]);