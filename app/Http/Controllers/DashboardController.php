<?php

namespace App\Http\Controllers;

use App\Models\Ncr;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index () {
        $ncr = [];
        if (Kontak::withTrashed()->where("user_id", auth()->user()->id)->first()) {
            $ncr = Ncr::whereHas("Kontak", function($ncr) {
                $ncr->where("kontak_id", Kontak::withTrashed()->where("user_id", auth()->user()->id)->first()->id)->where("validated", 0);
            })->get()->filter(function ($value) {
                return $value->Kontak->filter(function($kontak, $key) {
                    if ($kontak->id == Kontak::withTrashed()->where("user_id", auth()->user()->id)->first()->id) {
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
            })->values()->all();
        }
        return view('dashboard', [
            "title" => "Home",
            "ncr_open" => Ncr::where("status", "open")->count(),
            "ncr_closed" => Ncr::where("status", "closed")->count(),
            "ncr_confirmed" => Ncr::where("status", "confirmed")->count(),
            "memo" => Ncr::where("nomor_memo", "!=", null)->count(),
            "need_approval" => $ncr
        ]);
    }
}
