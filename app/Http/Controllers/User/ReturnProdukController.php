<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReturnProdukRequest;
use App\Models\ReturnProduk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ReturnProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.return.listreturn', [
            'returns' =>  ReturnProduk::user()->get()
        ]);
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
    public function store(ReturnProdukRequest $request)
    {
        ReturnProduk::create($request->validated());
        Alert::success('Success', 'Return berhasil dilakukan');

        return redirect()->route('return.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnProduk  $returnProduk
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnProduk $returnProduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnProduk  $returnProduk
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnProduk $returnProduk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReturnProduk  $returnProduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReturnProduk $returnProduk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnProduk  $returnProduk
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnProduk $returnProduk)
    {
        //
    }
}
