<?php

namespace App\Http\Controllers;

use App\Models\Ncr;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $ncr = [];
        $ncrs = Ncr::get();
        $kontak_ncr = DB::table("kontak_ncr")->get();
        if ($kontak_id = Kontak::withTrashed()->where("user_id", auth()->user()->id)->latest()->first()) {
            $ncr = Ncr::whereHas("Kontak", function ($ncr) use ($kontak_id) {
                $ncr->where("kontak_id", $kontak_id->id)->where("validated", 0);
            })->get()->filter(function ($ncr) use ($kontak_id, $kontak_ncr) {
                return $ncr->Kontak->filter(function ($kontak, $key) use ($kontak_id, $kontak_ncr) {
                    if ($kontak->id == $kontak_id->id) {
                        if ($key == 0) {
                            return true;
                        } else {
                            if ($kontak_ncr->where("id", $kontak->pivot->id - 1)->first()->validated == 1) {
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
            "ncr_open" => $ncrs->where("status", "open")->count(),
            "ncr_closed" => $ncrs->where("status", "closed")->count(),
            "ncr_confirmed" => $ncrs->where("status", "confirmed")->count(),
            "memo" => $ncrs->where("nomor_memo", "!=", null)->count(),
            "need_approval" => $ncr
        ]);
    }
}
