<?php

namespace App\Http\Controllers;

use App\Models\Ncr;
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
        dd($request->all());
    }
}
