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
        if (Kontak::where("nama", auth()->user()->name)->first() != null) {
            $ncr = Ncr::whereHas("Kontak", function($ncr) {
                $ncr->where("kontak_id", Kontak::where("nama", auth()->user()->name)->first()->id)->where("validated", 0);
            })->get()->filter(function ($value) {
                return $value->Kontak->filter(function($kontak, $key) {
                    if ($kontak->id == Kontak::where("nama", auth()->user()->name)->first()->id) {
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
            "ncr_open" => 10,
            "ncr_closed" => 20,
            "ncr_total" => 30,
            "need_approval" => $ncr
        ]);
    }
}
