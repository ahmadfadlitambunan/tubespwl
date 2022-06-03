<?php

namespace App\Http\Controllers;

use App\Models\Method;
use Illuminate\Http\Request;

class MetodeCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.metode.index', [
            'methods' => Method::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.metode.create');
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
            'name' => 'required'
        ]);
        Method::create($validated);
        return redirect()->route('metode.index')->with('success', "Data Metode Baru Telah Ditambahkan");
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
    public function edit(Method $metode)
    {
        return view('admins.metode.edit', [
            'metode' => $metode
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Method $metode)
    {
        $rules = [];

        if ($request->name != $metode->name) {
            $rules['name'] = 'required';
        } else {
            $validated['name'] = $metode->name;
        }

        $validated = $request->validate($rules);

        Method::where('id', $metode->id)->update($validated);

        return redirect()->route('metode.index')->with('success', "Data metode telah berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Method $metode)
    {
        Method::destroy($metode->id);

        return redirect()->route('metode.index')->with('success', "Data Metode Berhasil Dihapus");
    }
}
