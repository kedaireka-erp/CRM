<?php

namespace App\Http\Controllers;

use App\Models\Ncr;
use App\Models\ItemNcr;
use Illuminate\Http\Request;

class MemoController extends Controller
{
    public function index()
    {
        return view('memo.index', [
            "title" => "Memo",
            "ncrs" => Ncr::whereNotNull("nomor_memo")->get()
        ]);
    }

    public function create(Ncr $ncr)
    {
        return view('memo.create', [
            "title" => "Memo",
            "ncr" => $ncr
        ]);
    }

    public function store(Ncr $ncr, Request $request) {
        $ncr->update([
            "nomor_memo" => $request->data_item["nomor_memo"],
            "tanggal_memo" => $request->data_item["tanggal_memo"],
            "deadline_pengambilan" => $request->data_item["deadline_pengambilan"],
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
}
