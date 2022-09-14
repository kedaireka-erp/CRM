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
        $fppp= collect([[
            "nama_mitra"=> "UNNES",
            "nama_proyek"=>"Digital Center",
            "nomor_fppp"=>"1/fppp/jendela",
            "alamat" => "Jl. Semarang",
            "item"=> [["nama_item"=>"jendela", "kode_item"=>"a1"], 
            ["nama_item"=>"baju", "kode_item" =>"a2"],["nama_item" => "celana", "kode_item" =>"a3"]]],
            [
            "nama_mitra"=> "ALFAMART",
            "nama_proyek"=>"LP2M",
            "nomor_fppp"=>"2/fppp/baju",
            "alamat" => "Jl. Imam Bonjol",
            "item"=> [["nama_item"=>"baju", "kode_item"=>"b1"], ["nama_item"=>"celana", "kode_item"=>"b2"]]
            ]]);
        $Kontak= Kontak::get();
        // $ItemNcr= ItemNcr::get();
        return view("ncr.create", [
            "title" => "NCR"
        ], compact("Kontak", "fppp"));

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
            "nama_proyek" => $request->nama_proyek,
            "nomor_ncr" => $request->nomor_ncr,
            "nomor_fppp" => $request->nomor_fppp,
            "tanggal_ncr" => $request->tanggal_ncr,
            "deskripsi" => $request->deskripsi,
            "analisa" => $request->analisa,
            "solusi" => $request->solusi,
            "pelapor" => $request->pelapor,
            "bukti_kecacatan" => $request->bukti_kecacatan,
            "jenis_ketidaksesuaian" =>$request->jenis_ketidaksesuaian,
            "alamat_pengiriman" => $request->alamat_pengiriman,
        ]);
        foreach($request->kontak_id as $kontak){
            DB::table("kontak_ncr")->insert([
                "kontak_id" => $kontak,
                "ncr_id" => $ncrs->id,
                "validated" => 0
            ]);
        }
        foreach($request->item_id as $item){
            ItemNcr::create([
                "kode_item" => explode("-", $item)[0],
                "nama_item" => explode("-", $item)[1],
                "ncr_id" => $ncrs->id
            ]);
        }
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
        $fppp= collect([[
            "nama_mitra"=> "UNNES",
            "nama_proyek"=>"Digital Center",
            "nomor_fppp"=>"1/fppp/jendela",
            "alamat" => "Jl. Semarang",
            "item"=> [["nama_item"=>"jendela", "kode_item"=>"a1"], 
            ["nama_item"=>"baju", "kode_item" =>"a2"],["nama_item" => "celana", "kode_item" =>"a3"]]],
            [
            "nama_mitra"=> "ALFAMART",
            "nama_proyek"=>"LP2M",
            "nomor_fppp"=>"2/fppp/baju",
            "alamat" => "Jl. Imam Bonjol",
            "item"=> [["nama_item"=>"baju", "kode_item"=>"b1"], ["nama_item"=>"celana", "kode_item"=>"b2"]]
            ]]);
        $Kontak = Kontak::get();

        return view("ncr.edit",[
            "title" => "NCR",
            "validators" => $ncr->Kontak()->orderBy("kontak_ncr.id", "asc")->get()
        ], compact("Kontak", "ncr", "fppp"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ncr  $ncr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ncr $id)
    {
        $ncr = Ncr::findOrFail($id);
        $ncr->update([
            "nama_mitra" => $request->nama_mitra ?? $ncr->nama_mitra,
            "nama_proyek" => $request->nama_proyek ?? $ncr->nama_proyek,
            "nomor_ncr" => $request->nomor_ncr ?? $ncr->nomor_ncr,
            "nomor_fppp" => $request->nomor_fppp ?? $ncr->nomor_fppp,
            "tanggal_ncr" => $request->tanggal_ncr ?? $ncr->tanggal_ncr,
            "deskripsi" => $request->deskripsi ?? $ncr->deskripsi,
            "analisa" => $request->analisa ?? $ncr->analisa,
            "solusi" => $request->solusi ?? $ncr->solusi,
            "pelapor" => $request->pelapor ?? $ncr->pelapor,
            "bukti_kecacatan" => $request->bukti_kecacatan ?? $ncr->bukti_kecacatan,
            "jenis_ketidaksesuaian" =>$request->jenis_ketidaksesuaian ?? $ncr->jenis_ketidaksesuaian,
            "alamat_pengiriman" => $request->alamat_pengiriman ?? $ncr->alamat_pengiriman,
            "kontak_id" => $request->kontak_id ?? $ncr->kontak_id,
        ]);

        return redirect("/ncr");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ncr  $ncr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ncr $ncr)
    {
        $ncr -> delete();
        
        return redirect("/ncr");
    }

    public function validasi (Request $request) {
        if (Kontak::where("nama", $request->user)->first()->id != DB::table("kontak_ncr")->where("id", $request->id)->first()->kontak_id) {
            return response()->json(["message" => "anda bukan user tersebut"], 403);
        } else {
            if ($request->posisi == 0 || DB::table('kontak_ncr')->where("id", $request->id - 1)->first()->validated == 1) {
                DB::table('kontak_ncr')->where("id", $request->id)->update([
                    "validated" => $request->checked
                ]);
                return response()->json( ["message" => "anda berhasil validasi"], 200);
            } else {
                return response()->json(["message" => "anda gagal validasi"], 406);
            }
        }
    }
}