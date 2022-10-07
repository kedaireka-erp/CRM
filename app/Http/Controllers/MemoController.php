<?php

namespace App\Http\Controllers;

use App\Models\Ncr;
use App\Models\ItemNcr;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MemoController extends Controller
{
    public function index()
    {
        return view('memo.index', [
            "title" => "Memo",
            "ncrs" => Ncr::whereNotNull("nomor_memo")->whereNull("delete_memo")->get()
        ]);
    }

    public function create(Ncr $ncr)
    {
        $jumlah = Ncr::whereNotNull("nomor_memo")->whereNull("delete_memo")->whereMonth("tanggal_memo", "=", Carbon::now()->month)->whereYear("tanggal_memo", "=", Carbon::now()->year)->count() + 1;
        $nomor_memo = $jumlah;

        while ($jumlah < 100) {
            $nomor_memo = "0" . $nomor_memo;
            $jumlah *= 10;
        }

        if ($ncr->nomor_memo == null || $ncr->delete_memo != null) {
            return view('memo.create', [
                "title" => "Memo",
                "ncr" => $ncr,
                "jumlah_memo" => $nomor_memo,
            ]);
        }


        return redirect("/ncr");
    }

    public function store(Ncr $ncr, Request $request)
    {
        $ncr->update([
            "nomor_memo" => $request->data_item["nomor_memo"],
            "tanggal_memo" => $request->data_item["tanggal_memo"],
            "deadline_pengambilan" => $request->data_item["deadline_pengambilan"],
            "alamat_pengiriman" => $request->data_item["alamat_pengiriman"],
            "delete_memo" => null
        ]);

        foreach ($request->data_item["data_item"] as $item) {
            ItemNcr::find($item["item_id"])->update([
                "tipe_item" => $item["tipe_item"],
                "jumlah" => $item["jumlah"],
                "daun" => $item["daun"],
                "warna" => $item["warna"],
                "lebar" => $item["lebar"],
                "tinggi" => $item["tinggi"],
                "alasan" => $item["alasan"],
                "keterangan" => $item["keterangan"],
                "return_barang" => $item["return"],
                "charge" => $item["charge"],
                "bukaan" => $item["bukaan"],
            ]);
        }

        return response()->json($ncr, 200);
    }

    public function edit(Ncr $ncr)
    {
        return view("memo.edit", [
            "title" => "Memo",
            "ncr" => $ncr,
            "items" => $ncr->ItemNcr->filter(function ($item) {
                return $item->tipe_item != null && $item->alasan != null && $item->keterangan != null && $item->return_barang != null && $item->charge != null && $item->bukaan != null && $item->jumlah != null;
            })
        ]);
    }

    public function update(Request $request, Ncr $ncr)
    {
        $ncr->update([
            "nomor_memo" => $request->data_item["nomor_memo"],
            "tanggal_memo" => $request->data_item["tanggal_memo"],
            "deadline_pengambilan" => $request->data_item["deadline_pengambilan"],
            "alamat_pengiriman" => $request->data_item["alamat_pengiriman"],
        ]);

        ItemNcr::where("ncr_id", $ncr->id)->update([
            "tipe_item" => null,
            "jumlah" => null,
            "alasan" => null,
            "keterangan" => null,
            "return_barang" => null,
            "charge" => null,
            "bukaan" => null,
        ]);

        foreach ($request->data_item["data_item"] as $item) {
            ItemNcr::find($item["id"])->update([
                "tipe_item" => $item["tipe_item"],
                "jumlah" => $item["jumlah"],
                "daun" => $item["daun"],
                "warna" => $item["warna"],
                "lebar" => $item["lebar"],
                "tinggi" => $item["tinggi"],
                "alasan" => $item["alasan"],
                "keterangan" => $item["keterangan"],
                "return_barang" => $item["return_barang"],
                "charge" => $item["charge"],
                "bukaan" => $item["bukaan"],
            ]);
        }

        return response()->json([
            "status" => "success",
            "message" => "Memo berhasil diupdate"
        ], 200);
    }

    public function destroy(Ncr $ncr)
    {
        $ncr->update([
            "delete_memo" => Carbon::now()
        ]);

        ItemNcr::where("ncr_id", $ncr->id)->update([
            "tipe_item" => null,
            "jumlah" => null,
            "alasan" => null,
            "keterangan" => null,
            "return_barang" => null,
            "charge" => null,
            "bukaan" => null,
        ]);

        return redirect("/memo");
    }

    public function show(Ncr $ncr)
    {
        return view("memo.show", [
            "title" => "Memo",
            "ncr" => $ncr,
            "items" => $ncr->ItemNcr->filter(function ($item) {
                return $item->tipe_item != null && $item->alasan != null && $item->keterangan != null && $item->return_barang != null && $item->charge != null && $item->bukaan != null && $item->jumlah != null;
            })
        ]);
    }

    public function createPDF(Ncr $ncr)
    {

        $pdf = Pdf::loadView('memo.cetak', [
            "title" => "Memo",
            "ncrs" => $ncr,
            "items" => $ncr->ItemNcr->filter(function ($item) {
                return $item->tipe_item != null && $item->alasan != null && $item->keterangan != null && $item->return_barang != null && $item->charge != null && $item->bukaan != null && $item->jumlah != null;
            })
        ]);
        $pdf->setPaper('A4', 'potrait');

        return $pdf->stream('memo.pdf');
    }
}
