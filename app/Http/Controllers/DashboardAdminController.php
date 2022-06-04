<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Saving;
use App\Models\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{

    public function index()
    {
        
        $monthly = Saving::whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'))
                    ->sum('deposit');

        $annual = Saving::whereYear('created_at', date('Y'))
                    ->sum('deposit');

        $daily = Saving::whereDate('created_at', Carbon::today())->sum('deposit');

        $pending = Saving::where('method_id', 2)
                    ->where('status', NULL)
                    ->count();

        $area_chart = Saving::select(
                                DB::raw("(SUM(deposit)) as Total"),
                                DB::raw("MONTHNAME(created_at) as month_name")
                      ) -> whereYear('created_at', date('Y'))
                        -> groupBy('month_name')
                        -> get();
                    
        return view('admins.index', [
            'monthly' => $monthly,
            'daily' => $daily,
            'annual' => $annual,
            'pending' => $pending,
            'AllStudent' => Student::all()->count(),
            'visual_admn' => $area_chart

        ]);
    }
}
