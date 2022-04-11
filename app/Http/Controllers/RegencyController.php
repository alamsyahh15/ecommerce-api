<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegencyRequest;
use App\Http\Requests\UpdateRegencyRequest;
use App\Models\Regency;

class RegencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreRegencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegencyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Regency  $regency
     * @return \Illuminate\Http\Response
     */
    public function show(Regency $regency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Regency  $regency
     * @return \Illuminate\Http\Response
     */
    public function edit(Regency $regency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegencyRequest  $request
     * @param  \App\Models\Regency  $regency
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegencyRequest $request, Regency $regency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Regency  $regency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Regency $regency)
    {
        //
    }
}
