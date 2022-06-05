<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Grade;
use Illuminate\Http\Request;

class SiswaCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.murid.index', [
            'students' => Student::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.murid.create', [
            'grades' => Grade::where('id',  '>', 0)->get()
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
            'grade_id' => 'required',
            'name' => 'required',
            'nis' => 'required|digits:5',
            'gender' => 'required',
            'password' => 'required|min:5'
        ]);

        $validated['password'] = bcrypt($request->password);
        Student::create($validated);

        return redirect()->route('murid.index')->with('success', "Data Siswa Baru Telah Ditambahkan");
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
    public function edit(Student $murid)
    {
        return view('admins.murid.edit', [
            'murid' => $murid,
            'grades' => Grade::where('id',  '>', 0)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $murid)
    {
        $rules = [
            'name' => 'required',
            'nis' => 'required|digits:5',
            'gender' => 'required'
        ];

        if ($request->password == '') {
            $validated['password'] = $murid->password;
        } else {
            $rules['password'] = 'min:5';
        }

        $validated = $request->validate($rules);

        if ($request->password) {
            $validated['password'] = bcrypt($request->password);
        }

        Student::where('id', $murid->id)->update($validated);

        return redirect()->route('murid.index')->with('success', "Data Murid Berhasil Diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $murid)
    {
        Student::destroy($murid->id);

        return redirect()->route('murid.index')->with('success', "Data Murid Berhasil Dihapus");
    }
}
