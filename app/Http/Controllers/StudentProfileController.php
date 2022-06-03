<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Auth;

class StudentProfileController extends Controller
{
    public function index()
    {
        return view('profile.siswa.index', [
            'student' => Student::findOrFail(Auth::guard('student')->user()->id)
        ]);
    }

    public function edit()
    {
        return view('profile.siswa.edit', [
            'student' => Student::findOrFail(Auth::guard('student')->user()->id)
        ]);
    }

    public function store(Request $request, Student $siswa)
    {
        $rules = [
            'name' => 'required|max:255',
            'image' => 'image|file|max:1024',
            'gender' => 'required'
        ];

        $validated = $request->validate($rules);

        if($request->file('image')) {
            $validated['image'] = $request->file('image')->store('profile-images');
        }

        Student::where('id', $siswa->id)->update($validated);

        return redirect()->route('siswa.profile')->with('success', "Profile Berhasil Diubah");

    }

    public function reset()
    {
        return view('profile.siswa.ubahpass', );
    }

    
    public function updatePass(Request $request)
    {
       $rules = [
            'oldPass' => 'required',
            'newPass' => 'required|min:5|confirmed',
            'newPass_confirmation' => 'required',
        ];

        $validated = $request->validate($rules);

        if(Auth::guard('student')->check())
        {
            $current_user = Auth::guard('student')->user();
            if(Hash::check($request->oldPass, $current_user->password ))
            {
                $current_user->update([
                    'password' => bcrypt($validated['newPass'])
                ]);
                return redirect()->route('siswa.profile')->with('success', 'Password berhasil diubah');
            } else {
                return redirect()->back()->with('error', 'Password lama tidak sesuai');
            }
        }
    }  

}
