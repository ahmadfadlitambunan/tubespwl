<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Auth;

class AdmGuruController extends Controller
{
    public function index()
    {
        return view('profile.admin.index', [
            'user' => Auth::guard('user')->user()
        ]);
    }

    public function edit()
    {
        return view('profile.admin.edit', [
            'user' => Auth::guard('user')->user()
        ]);
    }

    
    public function store(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255',
            'image' => 'image|file|max:1024',
            'gender' => 'required',
        ];


        if($request->email != $user->email) {
            $rules['email'] = 'required|email|unique:users';
        }

        if($request->email != $user->email) {
            $rules['phone_no'] = 'required|max:15|unique:users';
        }

        $validated = $request->validate($rules);
        
        if($request->file('image')) {
            $validated['image'] = $request->file('image')->store('profile-images');
        }
        
        User::where('id', $user->id)->update($validated);
        
        return redirect()->route('adm-gru.index')->with('success', "Profile Berhasil Diubah");
        
    }
    
    
    public function reset()
    {
        return view('profile.admin.ubahpass', );
    }


    public function updatePass(Request $request)
    {
       $rules = [
            'oldPass' => 'required',
            'newPass' => 'required|min:5|confirmed',
            'newPass_confirmation' => 'required',
        ];
        
        $validated = $request->validate($rules);
        
        if(Auth::guard('user')->check())
        {
            $current_user = Auth::guard('user')->user();
            if(Hash::check($request->oldPass, $current_user->password ))
            {
                $current_user->update([
                    'password' => bcrypt($validated['newPass'])
                ]);
                return redirect()->route('adm-gru.index')->with('success', 'Password berhasil diubah');
            } else {
                return redirect()->back()->with('error', 'Password lama tidak sesuai');
            }
        }
    }  

}
