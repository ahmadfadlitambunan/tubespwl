<?php

namespace App\Http\Controllers;


use Auth;
use App\Models\Saving;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Exports\ExportHistory;
use Excel;
use Carbon\Carbon;

class StudentController extends Controller
{

    public function index()
    {

        $monthly = Saving::whereMonth('created_at', date('m'))
            ->where('user_id', Auth::guard('student')->user()->id)
            ->whereYear('created_at', date('Y'))
            ->where('status', '1')
            ->sum('deposit');

        $total = Saving::where('user_id', Auth::guard('student')->user()->id)
            ->where('status', '1')
            ->sum('deposit');

        $daily = Saving::whereDate('created_at', Carbon::today())
            ->where('user_id', Auth::guard('student')->user()->id)
            ->where('status', '1')
            ->sum('deposit');

            
        return view('students.index', [
            'monthly' => $monthly,
            'daily' => $daily,
            'total' => $total,
        ]);
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

        return redirect()->route('siswa.history')->with('success', "Tabungan Anda Sedang Diproses");
    }

    public function history()
    {
        return view('students.history', [
            'savings' => Saving::where('student_id', Auth::guard('student')->user()->id)
                                ->where('status', '1')
                                ->whereNotNull('user_id')
                                ->get(),
        ]);
    }

    public function exportExcel()
    {
        return Excel::download(new ExportHistory, "History_Tabungan.xlsx");
    }
}
