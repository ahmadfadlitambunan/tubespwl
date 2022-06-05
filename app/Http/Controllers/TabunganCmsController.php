<?php

namespace App\Http\Controllers;

use Excel;
use App\Models\Saving;
use Illuminate\Http\Request;
use App\Exports\TabunganExportHarian;
use App\Exports\TabunganExportBulanan;
use Auth;

class TabunganCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.tabungan.index', [
            'savings' => Saving::where('status', '1')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Saving $tabungan)
    {
        return view('admins.tabungan.edit', [
            'tabungan' => $tabungan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Saving $tabungan)
    {
        $rules = [];

        if ($request->deposit != $tabungan->deposit) {
            $rules['deposit'] = 'required';
        } else {
            $validated['deposit'] = $tabungan->deposit;
        }

        $validated = $request->validate($rules);

        Saving::where('id', $tabungan->id)->update($validated);

        return redirect()->route('tabungan.index')->with('success', "Data tabungan telah berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }

    public function needverif()
    {
        $result = Saving::where('status', NULL)
                          ->whereNotNull('image')
                          ->get();

        return view('admins.tabungan.verif', [
            'savings' => $result
        ]);
    }
 
    public function verify(Request $request, Saving $saving)
    {
        
        if($request && $request->status == "pass"){
            $result = $saving->update([
                'status' => 1,
                'user_id' => Auth::guard('user')->user()->id
            ]);
        } elseif ($request && $request->status == "fail") {
            $result = $saving->update([
                'status' => 0,
                'user_id' => Auth::guard('user')->user()->id
            ]);
        }   

        return redirect()->back()->with('success', "Status tabungan telah diubah");  
    }

    public function exportExcelM()
    {
        return Excel::download(new TabunganExportBulanan, "tabungan-bulanan.xlsx");
    }

    public function exportExcelD()
    {
        return Excel::download(new TabunganExportHarian, "tabungan-harian.xlsx");
    }
}
