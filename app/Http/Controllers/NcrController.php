<?php

namespace App\Http\Controllers;

use App\Models\Ncr;
use Illuminate\Http\Request;

class NcrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("ncr.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ncr  $ncr
     * @return \Illuminate\Http\Response
     */
    public function show(Ncr $ncr)
    {
        //
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
}
