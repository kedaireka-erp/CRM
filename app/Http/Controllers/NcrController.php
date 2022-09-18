<?php

namespace App\Http\Controllers;

use App\Models\Ncr;
use App\Models\Kontak;
use App\Models\ItemNcr;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class NcrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ncrs = Ncr::whereNot("status", "confirmed")->latest()->get();
        $confirms = Ncr::where("status", "confirmed")->latest()->get();
        return view("ncr.index", [
            "title" => "NCR",
            "confirms" => $confirms,
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
        $validateData = $request->validate([
            'bukti_kecacatan'=> 'file|max:2024'
        ]);

        if($request->file('bukti_kecacatan')){
            $validateData['bukti_kecacatan'] = $request->file('bukti_kecacatan')->store('bukti');
        }

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
            "bukti_kecacatan" => $validateData['bukti_kecacatan'],
            "jenis_ketidaksesuaian" =>$request->jenis_ketidaksesuaian,
            "alamat_pengiriman" => $request->alamat_pengiriman,
            "status" => ($request->analisa == null && $request->solusi == null) ? "open" : "closed",
        ]);

        foreach($request->kontak_id as $kontak){
            $validator[] = DB::table("kontak_ncr")->insert([
                "kontak_id" => $kontak,
                "ncr_id" => $ncrs->id,
                "validated" => 0
            ]);
        }

        Http::get("https://app.whacenter.com/api/send", [
            "device_id" => "0c3716536ed62ab28dca153271d515b8",
            "number" => Kontak::find($request->kontak_id[0])->nomor_whatsapp,
            "message" => "Ada NCR baru yang perlu anda validasi, berikut data singkatnya:\n\nNomor NCR: ".$request->nomor_ncr."\nNomor FPPP: ".$request->nomor_fppp."\nTanggal NCR: ".$request->tanggal_ncr."\nNama Mitra: ".$request->nama_mitra."\nNama Proyek: ".$request->nama_proyek."\nDeskripsi: ".$request->deskripsi."\nAnalisa: ".$request->analisa."\nSolusi: ".$request->solusi."\nPelapor: ".$request->pelapor."\nJenis Ketidaksesuaian: ".$request->jenis_ketidaksesuaian."\nAlamat: ".$request->alamat_pengiriman."\n\nSilahkan klik link berikut untuk validasi: http://162.243.167.174/".$ncrs->id,
        ]);
        Http::get("https://app.whacenter.com/api/send", [
            "device_id" => "0c3716536ed62ab28dca153271d515b8",
            "number" => Kontak::find($request->kontak_id[0])->nomor_whatsapp,
            "message" => "",
            "file" => "http://162.243.167.174/storage/".$ncrs->bukti_kecacatan
        ]);

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
        if ($ncr->Kontak->every(function ($kontak) {
            return $kontak->pivot->validated == 0;
        })) {
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
                "validators" => $ncr->Kontak()->orderBy("kontak_ncr.id", "asc")->get(),
                "fppps" => $fppp->where("nomor_fppp", $ncr->nomor_fppp)->first()
            ], compact("Kontak", "ncr", "fppp"));
        }

        return redirect("/ncr");
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
        $validateData = $request->validate([
            'bukti_kecacatan'=> 'file|max:2024'
        ]);

        if($request->file('bukti_kecacatan')){
            $validateData['bukti_kecacatan'] = $request->file('bukti_kecacatan')->store('bukti');
        } else {
            $validateData['bukti_kecacatan'] = $ncr->bukti_kecacatan;
        }
        
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
            "bukti_kecacatan" => $validateData['bukti_kecacatan'] ?? $ncr->bukti_kecacatan,
            "jenis_ketidaksesuaian" =>$request->jenis_ketidaksesuaian ?? $ncr->jenis_ketidaksesuaian,
            "alamat_pengiriman" => $request->alamat_pengiriman ?? $ncr->alamat_pengiriman,
            "kontak_id" => $request->kontak_id ?? $ncr->kontak_id,
            "status" => ($request->analisa == null && $request->solusi == null) ? "open" : "closed",
        ]);

        ItemNcr::where('ncr_id', $ncr->id)->delete();

        DB::table("kontak_ncr")->where('ncr_id', $ncr->id)->delete();
        
        foreach($request->kontak_id as $kontak){
            DB::table("kontak_ncr")->insert([
                "kontak_id" => $kontak,
                "ncr_id" => $ncr->id,
                "validated" => 0
            ]);
        }

        Http::get("https://app.whacenter.com/api/send", [
            "device_id" => "0c3716536ed62ab28dca153271d515b8",
            "number" => Kontak::find($request->kontak_id[0])->nomor_whatsapp,
            "message" => "NCR : ". $ncr->nomor_ncr ."\nBaru saja Diedit dan perlu anda validasi, berikut data singkatnya:\n\nNomor NCR: ".$request->nomor_ncr."\nNomor FPPP: ".$request->nomor_fppp."\nTanggal NCR: ".$request->tanggal_ncr."\nNama Mitra: ".$request->nama_mitra."\nNama Proyek: ".$request->nama_proyek."\nDeskripsi: ".$request->deskripsi."\nAnalisa: ".$request->analisa."\nSolusi: ".$request->solusi."\nPelapor: ".$request->pelapor."\nJenis Ketidaksesuaian: ".$request->jenis_ketidaksesuaian."\nAlamat: ".$request->alamat_pengiriman."\n\nSilahkan klik link berikut untuk validasi: http://162.243.167.174/".$ncr->id,
        ]);
        Http::get("https://app.whacenter.com/api/send", [
            "device_id" => "0c3716536ed62ab28dca153271d515b8",
            "number" => Kontak::find($request->kontak_id[0])->nomor_whatsapp,
            "message" => "",
            "file" => "http://162.243.167.174/storage/".$ncr->bukti_kecacatan
        ]);

        foreach($request->item_id as $item){
            ItemNcr::create([
                "kode_item" => explode("-", $item)[0],
                "nama_item" => explode("-", $item)[1],
                "ncr_id" => $ncr->id
            ]);
        }

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
        if (Kontak::withTrashed()->where("user_id", $request->user)->first()->id != DB::table("kontak_ncr")->where("id", $request->id)->first()->kontak_id) {
            return response()->json(["message" => "anda bukan user tersebut"], 403);
        } else {
            if ($request->posisi == 0 || DB::table('kontak_ncr')->where("id", $request->id - 1)->first()->validated == 1) {
                DB::table('kontak_ncr')->where("id", $request->id)->update([
                    "validated" => $request->checked
                ]);
                if ($request->posisi != DB::table("kontak_ncr")->where("ncr_id", $request->ncr_id)->count() - 1) {
                    $kontak_ncr = DB::table('kontak_ncr')->where("id", $request->id + 1)->first();
                    $ncr = Ncr::find($kontak_ncr->ncr_id);
                    Http::get("https://app.whacenter.com/api/send", [
                        "device_id" => "0c3716536ed62ab28dca153271d515b8",
                        "number" => Kontak::find($kontak_ncr->kontak_id)->nomor_whatsapp,
                        "message" => "Ada NCR baru yang perlu anda validasi, berikut data singkatnya:\n\nNomor NCR: ".$ncr->nomor_ncr."\nNomor FPPP: ".$ncr->nomor_fppp."\nTanggal NCR: ".$ncr->tanggal_ncr."\nNama Mitra: ".$ncr->nama_mitra."\nNama Proyek: ".$ncr->nama_proyek."\nDeskripsi: ".$ncr->deskripsi."\nAnalisa: ".$ncr->analisa."\nSolusi: ".$ncr->solusi."\nPelapor: ".$ncr->pelapor."\nJenis Ketidaksesuaian: ".$ncr->jenis_ketidaksesuaian."\nAlamat: ".$ncr->alamat_pengiriman."\n\nSilahkan klik link berikut untuk validasi: http://162.243.167.174/".$ncr->id,
                    ]);
                    Http::get("https://app.whacenter.com/api/send", [
                        "device_id" => "0c3716536ed62ab28dca153271d515b8",
                        "number" => Kontak::find($kontak_ncr->kontak_id)->nomor_whatsapp,
                        "message" => "",
                        "file" => "http://162.243.167.174/storage/".$ncr->bukti_kecacatan
                    ]);
                }
                if (Ncr::find($request->ncr_id)->Kontak->every(function($kontak) {
                    return $kontak->pivot->validated == 1;
                })) {
                    Ncr::find($request->ncr_id)->update([
                        "status" => "confirmed"
                    ]);
                }
                return response()->json( ["message" => "anda berhasil validasi"], 200);
            } else {
                return response()->json(["message" => "anda gagal validasi"], 406);
            }
        }
    }

    public function report (Request $request) {
        $ncr = Ncr::whereMonth("created_at", $request->bulan)->whereYear("created_at", $request->tahun)->get();
        $pdf = Pdf::loadView('ncr.report', [
            "ncrs" => $ncr
        ]);
        return $pdf->download('report_ncr_'.$request->bulan.'_'.$request->tahun.'.pdf');
    }
}