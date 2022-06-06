<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
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

        $pending = Saving::where('status', NULL)
                           ->whereNotNull('image')
                           ->count();

        $area_chart = Saving::select(
                                DB::raw("(SUM(deposit)) as Total"),
                                DB::raw("MONTHNAME(created_at) as month_name")
                      ) -> whereYear('created_at', date('Y'))
                        -> orderBy('created_at', 'asc')
                        -> groupBy('month_name')
                        -> get();

        $success = Saving::where('status', '1')->count();
        $fail = Saving::where('status', '0')->count();
        $unverified = Saving::where('status', NULL)->whereNotNull('image')->count();
                    
        return view('admins.index', [
            'monthly' => $monthly,
            'daily' => $daily,
            'annual' => $annual,
            'pending' => $pending,
            'visual_admn' => $area_chart,
            'donut' => collect([$success, $fail, $unverified])
        ]);
    }

    public function search(Request $request)
    {   
        $admins = User::where('name', 'like', '%' . request('search') . '%')
                            ->orWhere('nip', 'like', '%' . request('search') . '%')
                            ->where('level', 'admin')
                            ->get();

        $gurus = User::where('name', 'like', '%' . request('search') . '%')
                                ->orWhere('nip', 'like', '%' . request('search') . '%')
                                ->where('level', 'guru')
                                ->get();

        $siswas = Student::where('name', 'like', '%' . request('search') . '%')
                        ->orWhere('nis', 'like', '%' . request('search') . '%')
                        ->get();

        $beritas = Post::where('title', 'like', '%' . request('search') . '%')
                        ->orWhere('body', 'like', '%' . request('search') . '%')
                        ->get();

        return view('admins.search', [
            'admins' => $admins,
            'gurus' => $gurus,
            'siswas' => $siswas,
            'beritas' => $beritas
        ]);
    }
}
