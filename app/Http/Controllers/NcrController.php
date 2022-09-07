<?php

namespace App\Http\Controllers;

use App\Models\Ncr;
use App\Models\Kontak;
use App\Models\ItemNcr;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class NcrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ncrs = Ncr::get();
        return view("ncr.index", [
            "title" => "NCR"
        ],compact("ncrs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Kontak= Kontak::get();
        $ItemNcr= ItemNcr::get();
        return view("ncr.create", [
            "title" => "NCR"
        ], compact("Kontak", "ItemNcr"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ncrs = Ncr::create([
            "nama_mitra" => $request->nama_mitra,
            "nama_projek" => $request->nama_projek,
            "nomor_ncr" => $request->nomor_ncr,
            "nomor_fppp" => $request->nomor_fppp,
            "tanggal_ncr" => $request->tanggal_ncr,
            "pelapor" => $request->pelapor,
            "nomor_memo" => $request->nomor_memo,
            "tanggal_memo" => $request->tanggal_memo,
            "alamat_pengiriman" => $request->alamat_pengiriman,
            "deadline_pengambilan" =>$request->deadline_pengambilan,
            "kontak_id" =>$request->kontak_id,
            "item_id" =>$request->item_id,
        ]);

        return redirect("/ncr");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ncr  $ncr
     * @return \Illuminate\Http\Response
     */
    public function show(Ncr $ncr)
    {
        return view ("ncr.validasi", [
            "title" => "NCR",
            "ncr" => $ncr,
            "validators" => $ncr->Kontak()->orderBy("kontak_ncr.id", "asc")->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ncr  $ncr
     * @return \Illuminate\Http\Response
     */
    public function edit(Ncr $ncr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ncr  $ncr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ncr $ncr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ncr  $ncr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ncr $ncr)
    {
        //
    }

    public function validasi (Request $request) {
        if ($request->user != DB::table("kontak_ncr")->where("id", $request->id)->first()->kontak_id) {
            return response()->json(["message" => "anda bukan user tersebut"], 403);
        } else {
            if ($request->posisi == 0 || DB::table('kontak_ncr')->where("id", $request->id - 1)->first()->validated == 1) {
                DB::table('kontak_ncr')->where("id", $request->id)->update([
                    "validated" => $request->checked
                ]);
                return response()->json( User::find($request->user), 200);
            } else {
                return response()->json(["message" => "anda gagal validasi"], 406);
            }
        }
    }
}