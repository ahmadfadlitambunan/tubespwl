<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PembayaranCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.pembayaran.index', [
            'payments' => Payment::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.pembayaran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'a_n' => 'required|max:255',
            'account_no' => 'required|max:16'
        ]);
        Payment::create($validated);

        return redirect()->route('pembayaran.index')->with('success', "Data Pembayaran Baru Telah Ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $pembayaran)
    {
        return view('admins.pembayaran.edit', [
            'pembayaran' => $pembayaran
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $pembayaran)
    {
        $rules = [
            'name' => 'required',
            'a_n' => 'required|max:255',
            'account_no' => 'required|max:16'
        ];


        $validated = $request->validate($rules);

        Payment::where('id', $pembayaran->id)->update($validated);

        return redirect()->route('pembayaran.index')->with('success', "Data Pembayaran Berhasil Diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $pembayaran)
    {
        Payment::destroy($pembayaran->id);

        return redirect()->route('pembayaran.index')->with('success', "Data Pembayaran Berhasil Dihapus");
    }
}
