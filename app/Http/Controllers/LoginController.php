<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    // untuk Login
    public function logManage(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::guard('user')->attempt(['nip' => $request->username, 'password' => $request->password ]))
        {
            if(Auth::guard('user')->user()->level === 'admin')
                return redirect('/admin');
            elseif(Auth::guard('user')->user()->level === 'guru')
                return redirect('/guru');
        }
        elseif(Auth::guard('student')->attempt(['nis' => $request->username, 'password' => $request->password ]))
        {
            return redirect('/siswa');
        }

        return back()->with('loginError', 'Login Failed!');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        } elseif (Auth::guard('student')->check()) {
            Auth::guard('student')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
