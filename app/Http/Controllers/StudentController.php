<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Saving;
use App\Models\Payment;
use Auth;

class StudentController extends Controller
{

    public function index()
    {
        return view('students.index');
    }

    public function menabung()
    {
        return view('students.menabung',[
            'payments' => Payment::all(),      
        ]);
    }

    public function create(Request $request)
    {

        $validated = $request->validate([
            'deposit' => 'required',
            'method_id' => 'required',
            'image' => 'required|image|max:1024',
            'payment_id' => 'required'
        ]);

        if($request->file('image')) {
            $validated['image'] = $request->file('image')->store('saving-images');
        }

        $validated['student_id'] = Auth::guard('student')->user()->id;

        Saving::create($validated);

        return redirect()->route('history')->with('success', "Tabungan Anda Sedang Diproses");
    }

    public function history()
    {
        return view('students.history', [
            'savings' => Saving::where('student_id', Auth::guard('student')->user()->id)->get(),
        ]);
    }
}
