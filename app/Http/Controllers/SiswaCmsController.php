<?php

namespace App\Http\Controllers;

use Excel;
use App\Models\Grade;
use App\Models\Saving;
use App\Models\Student;
use App\Exports\SiswaAll;
use App\Imports\importSiswa;
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
    public function show(Student $murid)
    {
        $depo =  Saving::select('deposit', 'created_at')->where('student_id', $murid->id)->where('status', '1')->paginate(7);

        return view("admins.murid.show", [
            'student' => $murid,
            'sum_depo' => $depo->sum('deposit'),
            'savings' => $depo
        ]);
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

    public function exportExcel()
    {
        return Excel::download(new SiswaAll, 'Data-Siswa.xlsx');
    }

    public function exportCsv()
    {
        return Excel::download(new SiswaAll, 'Data-Siswa.csv');
    }

    public function importCsv(Request $request)
    {
        $data = $request->file('file');

        $namaFile = $data->getClientOriginalName();

        $data->move('UserData', $namaFile);

        Excel::import(new importSiswa, \public_path('/UserData/' . $namaFile));

        return redirect()->route('murid.index')->with('success', "Data berhasil di-import");
    }
}
