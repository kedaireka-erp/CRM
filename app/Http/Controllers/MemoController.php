<?php

namespace App\Http\Controllers;

use App\Models\Ncr;
use App\Models\ItemNcr;
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
        if ($ncr->nomor_memo == null || $ncr->delete_memo != null) {
            return view('memo.create', [
                "title" => "Memo",
                "ncr" => $ncr
            ]);
        }
        return redirect("/ncr");
    }

    public function store(Ncr $ncr, Request $request) {
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

    public function edit(Ncr $ncr) {
        return view("memo.edit", [
            "title" => "Memo",
            "ncr" => $ncr,
            "items" => $ncr->ItemNcr->filter(function ($item) {
                return $item->tipe_item != null && $item->warna != null && $item->lebar != null && $item->tinggi != null && $item->alasan != null && $item->keterangan != null && $item->return_barang != null && $item->charge != null && $item->bukaan != null;
            })
        ]);
    }

    public function update(Request $request, Ncr $ncr) {
        $ncr->update([
            "nomor_memo" => $request->data_item["nomor_memo"],
            "tanggal_memo" => $request->data_item["tanggal_memo"],
            "deadline_pengambilan" => $request->data_item["deadline_pengambilan"],
            "alamat_pengiriman" => $request->data_item["alamat_pengiriman"],
        ]);

        ItemNcr::where("ncr_id", $ncr->id)->update([
            "tipe_item" => null,
            "warna" => null,
            "lebar" => null,
            "tinggi" => null,
            "alasan" => null,
            "keterangan" => null,
            "return_barang" => null,
            "charge" => null,
            "bukaan" => null,
        ]);

        foreach ($request->data_item["data_item"] as $item) {
            ItemNcr::find($item["id"])->update([
                "tipe_item" => $item["tipe_item"],
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

    public function destroy (Ncr $ncr) {
        $ncr->update([
            "delete_memo" => Carbon::now()
        ]);

        ItemNcr::where("ncr_id", $ncr->id)->update([
            "tipe_item" => null,
            "warna" => null,
            "lebar" => null,
            "tinggi" => null,
            "alasan" => null,
            "keterangan" => null,
            "return_barang" => null,
            "charge" => null,
            "bukaan" => null,
        ]);

        return redirect("/memo");
    }
}
