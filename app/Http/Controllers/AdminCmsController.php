<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.admins.index', [
            'admins' => User::where('level','admin')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.admins.create');
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
            'password' => 'required|min:5',
       ]); 

        $validated['password'] = bcrypt($request->password);
        User::create($validated);

        return redirect()->route('admins.index')->with('success', "Data Admin Baru Telah Ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        return view('admins.admins.edit', [
            'admin' => $admin
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
        $rules = [
            'name' => 'required',
            'nip' => 'required|digits:7',
        ];

        if($request->email != $admin->email) {
            $rules['email'] = 'required|email|unique:users';
        }

        if($request->password == '')
        {
            $validated['password'] = $admin->password;
        } 
        else 
        {
            $rules['password'] = 'min:5';
        }
        
        
        $validated = $request->validate($rules);
        
        if($request->password)
        {
            $validated['password'] = bcrypt($request->password);
        }

        User::where('id', $admin->id)->update($validated);

        return redirect()->route('admins.index')->with('success', "Data Admin Berhasil Diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        User::destroy($admin->id);

        return redirect()->route('admins.index')->with('success', "Data Admin Berhasil Dihapus");
    }
}
