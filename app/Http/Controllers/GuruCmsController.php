<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\GuruExport;
use Illuminate\Http\Request;
use Excel;


class GuruCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.guru.index', [
            'teachers' => User::where('level', 'guru')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.guru.create');
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
            'email' => 'required|email|max:255|unique:users',
            'nip' => 'required|digits:7',
            'gender' => 'required',
            'phone_no' => 'required:dns|digits:12|unique:users',
            'level' => 'required',
            'password' => 'required|min:5'
        ]);

        $validated['password'] = bcrypt($request->password);
        User::create($validated);

        return redirect()->route('guru.index')->with('success', "Data Guru Baru Telah Ditambahkan");
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
    public function edit(User $guru)
    {
        return view('admins.guru.edit', [
            'guru' => $guru
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $guru)
    {
        $rules = [
            'name' => 'required',
            'nip' => 'required|digits:7',
            'level' => 'required'
        ];

        if ($request->email != $guru->email) {
            $rules['email'] = 'required|email|unique:users';
        }

        if ($request->phone_no != $guru->phone_no) {
            $rules['phone_no'] = 'required:dns|digits:12|unique:users';
        }

        if ($request->password == '') {
            $validated['password'] = $guru->password;
        } else {
            $rules['password'] = 'min:5';
        }


        $validated = $request->validate($rules);

        if ($request->password) {
            $validated['password'] = bcrypt($request->password);
        }

        User::where('id', $guru->id)->update($validated);

        return redirect()->route('guru.index')->with('success', "Data Guru Berhasil Diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $guru)
    {
        User::destroy($guru->id);

        return redirect()->route('guru.index')->with('success', "Data Guru Berhasil Dihapus");
    }

    public function exportExcel()
    {
        return Excel::download(new GuruExport, "Data-Guru.xlsx");
    }
}
