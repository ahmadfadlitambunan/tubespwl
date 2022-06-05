<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Saving;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Http\Request;

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
    public function show($nis)
    {
        $classes = Grade::where('user_id', auth()->user()->id)->get();
        $students = Student::where('nis', $nis)->get();
        foreach ($students as $item){
            $id = $item['id'];
        }
        $depo =  Saving::select('deposit')->where('student_id', $id)->where('status', '1')->pluck('deposit')->sum();

        return view("guru.input", [
            'students' => $students,
            'classess' => $classes,
            'sum_depo' => $depo
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
}
