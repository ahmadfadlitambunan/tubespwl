<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;

class KelasCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.kelas.index', [
            'grades' => Grade::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.kelas.create', [
            'users' => User::where('level', 'guru')->get()
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
        $validated = $request->validate([
            'name' => 'required',
            'user_id' => 'required'
        ]);
        Grade::create($validated);
        return redirect()->route('kelas.index')->with('success', "Data Kelas Baru Telah Ditambahkan");
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
    public function edit(Grade $kela)
    {
        return view('admins.kelas.edit', [
            'kelas' => $kela,
            'users' => User::where('level', 'guru')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $kela)
    {
        $validated = $request->validate([
            'name' => 'required',
            'user_id' => 'required'
        ]);
        Grade::where('id', $kela->id)->update($validated);
        return redirect()->route('kelas.index')->with('success', "Data Kelas Baru Telah Berubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $kela)
    {
        Grade::destroy($kela->id);

        return redirect()->route('kelas.index')->with('success', "Data Kelas Berhasil Dihapus");
    }
}
