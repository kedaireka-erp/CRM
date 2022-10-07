<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("kontak.index", [
            "title" => "Kontak",
            "kontaks" => Kontak::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("kontak.create", [
            "title" => "Kontak",
            "users" => User::whereNotIn("id", Kontak::get()->pluck("user_id"))->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Kontak::create([
            'nama' => User::find($request->kontak)->name,
            "user_id" => $request->kontak,
            'nomor_whatsapp' => $request->nomor_whatsapp,
            'divisi' => $request->divisi
        ]);
        return redirect('/kontak');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function show(Kontak $kontak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function edit(Kontak $kontak)
    {
        //
        return view("kontak.edit", [
            "title" => "Kontak",
            "users" => User::whereNotIn("id", Kontak::whereNot("user_id", $kontak->user_id)->get()->pluck("user_id"))->get(),
            "kontak" => $kontak
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kontak $kontak)
    {
        $kontak->update([
            'nama' => User::find($request->kontak)->name,
            "user_id" => $request->kontak,
            'nomor_whatsapp' => $request->nomor_whatsapp,
            'divisi' => $request->divisi,
        ]);

        return redirect('/kontak');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kontak $kontak)
    {
        $kontak->delete();
        return redirect("/kontak");
    }
}
