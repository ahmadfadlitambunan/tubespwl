<?php

namespace App\Http\Controllers;

use Excel;
use App\Models\Grade;
use App\Models\Saving;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Exports\ExportSiswaPerkelas;
use Illuminate\Support\Facades\Auth;

class DashboardGuruInputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Grade::where('user_id', auth()->user()->id)->get();

        foreach($classes as $item){
            $class_id = $item['id'];
        }

        return view("guru.show", [
            'classes' => $classes,
            'students' => Student::where('grade_id', $class_id)->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $input)
    {
        $classes = Grade::where('user_id', auth()->user()->id)->get();

        $depo =  Saving::select('deposit', 'created_at')->where('student_id', $input->id)->where('status', '1')->paginate(7);

        return view("guru.input", [
            'student' => $input,
            'classess' => $classes,
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
    public function edit($id)
    {}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'deposit' => 'required|max:6'
        ]);
        
        $student_nis = $request->nis;
        $students = Student::where('nis', $student_nis)->get();

        foreach ($students as $item){
            $student_id = $item['id'];
        }

        $input_savings = [
            'student_id' => $student_id,
            'user_id' => auth()->user()->id,
            'method_id' => 1,
            'deposit' => $request->deposit,
            'status' => 1
        ];

        Saving::create($input_savings);

        return redirect('/guru')->with('success', 'Tabungan Berhasil Diinput!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function exportExcel()
    {
        $classes = Grade::where('user_id', Auth::guard('user')->user()->id)->get();
        foreach($classes as $item){
            $name = $item['name'];
        }
        return Excel::download(new ExportSiswaPerkelas, $name . '.xlsx');
    }
}
