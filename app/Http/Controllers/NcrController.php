<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ncr;
use App\Models\Fppp;
use App\Models\Kontak;
use App\Models\ItemNcr;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        ], compact("ncrs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Ncr $ncr)
    {
        $fppps = Fppp::get();

        // $fppps = $fppps->filter(function ($fppp) {
        //     return $fppp->wo->count() > 0;
        // });

        $array = [];

        foreach ($fppps as $fppp) {
            $nama_mitra = $fppp->Quotation->Aplikator->aplikator;
            $nomor_fppp = $fppp->fppp_no;
            $nama_proyek = $fppp->Quotation->nama_proyek;
            // $alamat = $fppp->wo[0]->alamat;
            $items = [];
            foreach ($fppp->Quotation->Item as $item) {
                $items[] = [
                    "id" => $item->id,
                    "nama_item" => $item->kode_tipe,
                    "kode_item" => $item->kode_item,
                    "daun" => $item->daun,
                    "warna" => $item->kode_warna,
                    "panjang" => $item->panjang,
                    "lebar" => $item->lebar,
                    "jumlah" => $item->qty,
                    "harga" => $item->harga,
                ];
            }

            $array[] = [
                "nama_mitra" => $nama_mitra,
                "nomor_fppp" => $nomor_fppp,
                "nama_proyek" => $nama_proyek,
                "alamat" => "Alamat",
                "item" => $items,
            ];
        }

        $fppp = collect($array);

        $Kontak = Kontak::get();
        $jumlah = Ncr::WhereMonth('tanggal_ncr', Carbon::now()->month)->WhereYear('tanggal_ncr', Carbon::now()->year)->count() + 1;
        $nomor_ncr = $jumlah;

        while ($jumlah < 100) {
            $nomor_ncr = "0" . $nomor_ncr;
            $jumlah *= 10;
        }
        return view("ncr.create", [
            "title" => "NCR",
            "jumlah_ncr" => $nomor_ncr,
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
            'bukti_kecacatan' => 'mimes:pdf|max:2024',
            "item_id" => "required",
            "kontak_id" => "required"
        ]);

        if ($request->file('bukti_kecacatan')) {
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
            "jenis_ketidaksesuaian" => $request->jenis_ketidaksesuaian,
            "alamat_pengiriman" => $request->alamat_pengiriman,
            "status" => ($request->analisa == null && $request->solusi == null) ? "open" : "closed",
        ]);

        foreach ($request->kontak_id as $kontak) {
            $validator[] = DB::table("kontak_ncr")->insert([
                "kontak_id" => $kontak,
                "ncr_id" => $ncrs->id,
                "validated" => 0
            ]);
        }

        foreach ($request->item_id as $item) {
            $itemNcr = ItemNcr::create([
                "kode_item" => explode("_", $item)[0],
                "nama_item" => explode("_", $item)[1],
                "daun" => explode("_", $item)[2],
                "lebar" => explode("_", $item)[3],
                "tinggi" => explode("_", $item)[4],
                "warna" => explode("_", $item)[5],
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
        return view("ncr.validasi", [
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
            $fppps = Fppp::get();

            // $fppps = $fppps->filter(function ($fppp) {
            //     return $fppp->wo->count() > 0;
            // });

            $array = [];

            foreach ($fppps as $fppp) {
                $nama_mitra = $fppp->Quotation->Aplikator->aplikator;
                $nomor_fppp = $fppp->fppp_no;
                $nama_proyek = $fppp->Quotation->nama_proyek;
                // $alamat = $fppp->wo[0]->alamat;
                $items = [];
                foreach ($fppp->Quotation->Item as $item) {
                    $items[] = [
                        "id" => $item->id,
                        "nama_item" => $item->kode_tipe,
                        "kode_item" => $item->kode_item,
                        "daun" => $item->daun,
                        "warna" => $item->kode_warna,
                        "panjang" => $item->panjang,
                        "lebar" => $item->lebar,
                        "jumlah" => $item->qty,
                        "harga" => $item->harga,
                    ];
                }

                $array[] = [
                    "nama_mitra" => $nama_mitra,
                    "nomor_fppp" => $nomor_fppp,
                    "nama_proyek" => $nama_proyek,
                    "alamat" => "Semarang",
                    "item" => $items,
                ];
            }

            $fppp = collect($array);
            $Kontak = Kontak::get();

            return view("ncr.edit", [
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
        if ($request->file('bukti_kecacatan')) {
            $validateData = $request->validate([
                'bukti_kecacatan' => 'mimes:pdf|max:2024',
                "item_id" => "required",
                "kontak_id" => "required"
            ]);
            $validateData['bukti_kecacatan'] = $request->file('bukti_kecacatan')->store('bukti');
        } else {
            $validateData['bukti_kecacatan'] = $ncr->bukti_kecacatan;
        }

        $barang = "";
        if (Auth::user()->hasRole("Admin")) {
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
                "jenis_ketidaksesuaian" => $request->jenis_ketidaksesuaian ?? $ncr->jenis_ketidaksesuaian,
                "alamat_pengiriman" => $request->alamat_pengiriman ?? $ncr->alamat_pengiriman,
                "analisa" => $request->analisa ?? $ncr->analisa,
                "solusi" => $request->solusi ?? $ncr->solusi,
                "status" => ($request->analisa == null && $request->solusi == null) ? "open" : "closed",
            ]);
            ItemNcr::where('ncr_id', $ncr->id)->delete();

            DB::table("kontak_ncr")->where('ncr_id', $ncr->id)->delete();

            foreach ($request->kontak_id as $kontak) {
                DB::table("kontak_ncr")->insert([
                    "kontak_id" => $kontak,
                    "ncr_id" => $ncr->id,
                    "validated" => 0
                ]);
            }

            foreach ($request->item_id as $item) {
                $itemNcr = ItemNcr::create([
                    "kode_item" => explode("_", $item)[0],
                    "nama_item" => explode("_", $item)[1],
                    "daun" => explode("_", $item)[2],
                    "lebar" => explode("_", $item)[3],
                    "tinggi" => explode("_", $item)[4],
                    "warna" => explode("_", $item)[5],
                    "ncr_id" => $ncr->id
                ]);
            }

            $itemNcr = ItemNcr::where("ncr_id", $ncr->id)->get();
            foreach ($itemNcr as $item) {
                $barang .= $item->kode_item . " - " . $item->nama_item . ", ";
            }

            if ($ncr->status == "closed") {
                Http::post("https://app.whacenter.com/api/send", [
                    "device_id" => "22b7043bacda4e176706e03c46018cbe",
                    "number" => Kontak::find($request->kontak_id[0])->nomor_whatsapp,
                    "message" => "NCR : " . $ncr->nomor_ncr . "\nAda NCR baru yang perlu Anda validasi, berikut data singkatnya:\n\nNomor NCR: " . $request->nomor_ncr . "\nNomor FPPP: " . $request->nomor_fppp . "\nTanggal NCR: " . $request->tanggal_ncr . "\nNama Mitra: " . $request->nama_mitra . "\nNama Proyek: " . $request->nama_proyek . "\nItem: " . $barang . "\nDeskripsi: " . $request->deskripsi . "\nAnalisa: " . $request->analisa . "\nSolusi: " . $request->solusi . "\nPelapor: " . $request->pelapor . "\nJenis Ketidaksesuaian: " . $request->jenis_ketidaksesuaian . "\nAlamat: " . $request->alamat_pengiriman . "\n\nSilahkan klik link berikut untuk lebih detailnya: http://crm.alluresystem.site/validate?ncr=" . base64_encode($ncr->id) . "&nomor=" . base64_encode(Kontak::find($request->kontak_id[0])->nomor_whatsapp),
                ]);
                Http::post("https://app.whacenter.com/api/send", [
                    "device_id" => "22b7043bacda4e176706e03c46018cbe",
                    "number" => Kontak::find($request->kontak_id[0])->nomor_whatsapp,
                    "message" => "",
                    "file" => "http://crm.alluresystem.site/storage/" . $ncr->bukti_kecacatan
                ]);
            }
        } else if (Auth::user()->hasRole("QC")) {
            $ncr->update([
                "analisa" => $request->analisa ?? $ncr->analisa,
                "solusi" => $request->solusi ?? $ncr->solusi,
                "status" => ($request->analisa == null && $request->solusi == null) ? "open" : "closed",
            ]);

            $itemNcr = ItemNcr::where("ncr_id", $ncr->id)->get();
            foreach ($itemNcr as $item) {
                $barang .= $item->kode_item . " - " . $item->nama_item . ", ";
            }

            if ($ncr->status == "closed") {
                Http::post("https://app.whacenter.com/api/send", [
                    "device_id" => "22b7043bacda4e176706e03c46018cbe",
                    "number" => Kontak::find($request->kontak_id[0])->nomor_whatsapp,
                    "message" => "NCR : " . $ncr->nomor_ncr . "\nAda NCR baru yang perlu Anda validasi, berikut data singkatnya:\n\nNomor NCR: " . $request->nomor_ncr . "\nNomor FPPP: " . $request->nomor_fppp . "\nTanggal NCR: " . $request->tanggal_ncr . "\nNama Mitra: " . $request->nama_mitra . "\nNama Proyek: " . $request->nama_proyek . "\nItem: " . $barang . "\nDeskripsi: " . $request->deskripsi . "\nAnalisa: " . $request->analisa . "\nSolusi: " . $request->solusi . "\nPelapor: " . $request->pelapor . "\nJenis Ketidaksesuaian: " . $request->jenis_ketidaksesuaian . "\nAlamat: " . $request->alamat_pengiriman . "\n\nSilahkan klik link berikut untuk lebih detailnya: http://crm.alluresystem.site/validate?ncr=" . base64_encode($ncr->id) . "&nomor=" . base64_encode(Kontak::find($request->kontak_id[0])->nomor_whatsapp),
                ]);
                Http::post("https://app.whacenter.com/api/send", [
                    "device_id" => "22b7043bacda4e176706e03c46018cbe",
                    "number" => Kontak::find($request->kontak_id[0])->nomor_whatsapp,
                    "message" => "",
                    "file" => "http://crm.alluresystem.site/storage/" . $ncr->bukti_kecacatan
                ]);
            }
        } else if (Auth::user()->hasRole("Sales")) {
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
                "jenis_ketidaksesuaian" => $request->jenis_ketidaksesuaian ?? $ncr->jenis_ketidaksesuaian,
                "alamat_pengiriman" => $request->alamat_pengiriman ?? $ncr->alamat_pengiriman,
            ]);
            ItemNcr::where('ncr_id', $ncr->id)->delete();

            DB::table("kontak_ncr")->where('ncr_id', $ncr->id)->delete();

            foreach ($request->kontak_id as $kontak) {
                DB::table("kontak_ncr")->insert([
                    "kontak_id" => $kontak,
                    "ncr_id" => $ncr->id,
                    "validated" => 0
                ]);
            }

            foreach ($request->item_id as $item) {
                $itemNcr = ItemNcr::create([
                    "kode_item" => explode("_", $item)[0],
                    "nama_item" => explode("_", $item)[1],
                    "daun" => explode("_", $item)[2],
                    "lebar" => explode("_", $item)[3],
                    "tinggi" => explode("_", $item)[4],
                    "warna" => explode("_", $item)[5],
                    "ncr_id" => $ncr->id
                ]);
            }
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
        $ncr->delete();

        return redirect("/ncr");
    }

    public function validasi(Request $request)
    {
        $barang = "";
        $itemNcr = ItemNcr::where("ncr_id", $request->ncr_id)->get();
        foreach ($itemNcr as $item) {
            $barang .= $item->kode_item . " - " . $item->nama_item . ", ";
        }

        if (Kontak::withTrashed()->where("user_id", $request->user)->latest()->first()->id != DB::table("kontak_ncr")->where("id", $request->id)->first()->kontak_id) {
            return response()->json(["message" => "anda bukan user tersebut"], 403);
        } else {
            if ($request->posisi == 0 || DB::table('kontak_ncr')->where("id", $request->id - 1)->first()->validated == 1) {
                DB::table('kontak_ncr')->where("id", $request->id)->update([
                    "validated" => $request->checked
                ]);
                if ($request->posisi != DB::table("kontak_ncr")->where("ncr_id", $request->ncr_id)->count() - 1) {
                    $kontak_ncr = DB::table('kontak_ncr')->where("id", $request->id + 1)->first();
                    $ncr = Ncr::find($kontak_ncr->ncr_id);
                    Http::post("https://app.whacenter.com/api/send", [
                        "device_id" => "22b7043bacda4e176706e03c46018cbe",
                        "number" => Kontak::find($kontak_ncr->kontak_id)->nomor_whatsapp,
                        "message" => "Ada NCR baru yang perlu Anda validasi, berikut data singkatnya:\n\nNomor NCR: " . $ncr->nomor_ncr . "\nNomor FPPP: " . $ncr->nomor_fppp . "\nTanggal NCR: " . $ncr->tanggal_ncr . "\nNama Mitra: " . $ncr->nama_mitra . "\nNama Proyek: " . $ncr->nama_proyek . "\nItem: " . $barang . "\nDeskripsi: " . $ncr->deskripsi . "\nAnalisa: " . $ncr->analisa . "\nSolusi: " . $ncr->solusi . "\nPelapor: " . $ncr->pelapor . "\nJenis Ketidaksesuaian: " . $ncr->jenis_ketidaksesuaian . "\nAlamat: " . $ncr->alamat_pengiriman . "\n\nSilahkan klik link berikut untuk lebih detailnya: http://crm.alluresystem.site/validate?ncr=" . base64_encode($ncr->id) . "&nomor=" . base64_encode(Kontak::find($kontak_ncr->kontak_id)->nomor_whatsapp),
                    ]);
                    Http::post("https://app.whacenter.com/api/send", [
                        "device_id" => "22b7043bacda4e176706e03c46018cbe",
                        "number" => Kontak::find($kontak_ncr->kontak_id)->nomor_whatsapp,
                        "message" => "",
                        "file" => "http://crm.alluresystem.site/storage/" . $ncr->bukti_kecacatan
                    ]);
                }
                if (Ncr::find($request->ncr_id)->Kontak->every(function ($kontak) {
                    return $kontak->pivot->validated == 1;
                })) {
                    Ncr::find($request->ncr_id)->update([
                        "status" => "confirmed"
                    ]);
                }
                return response()->json(["message" => "anda berhasil validasi"], 200);
            } else {
                return response()->json(["message" => "anda gagal validasi"], 406);
            }
        }
    }

    public function report(Request $request)
    {
        $ncr = Ncr::whereMonth("created_at", $request->bulan)->whereYear("created_at", $request->tahun)->get();
        $pdf = Pdf::loadView('ncr.report', [
            "ncr_open" => $ncr->where("status", "open"),
            "ncr_closed" => $ncr->where("status", "closed"),
            "ncr_confirmed" => $ncr->where("status", "confirmed"),
            "tanggal" => $request->bulan . "-" . $request->tahun
        ]);
        return $pdf->stream('report_ncr_' . $request->bulan . '_' . $request->tahun . '.pdf');
    }

    public function validate(Request $request)
    {
        if ($request->ncr && $request->nomor) {
            $user = Kontak::where("nomor_whatsapp", base64_decode($request->nomor))->first();
            if ($user) {
                Auth::loginUsingId($user->user->id);
                return redirect("/ncr/" . base64_decode($request->ncr));
            } else {
                return redirect("http://erp.alluresystem.site/");
            }
        } else {
            return redirect("http://erp.alluresystem.site/");
        }
    }
}
