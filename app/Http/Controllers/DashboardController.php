<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Log_operator;
use App\Models\Parkir;

class DashboardController extends Controller
{
    public function index()
    {


        $data = [
            'log' => Log_operator::with('operator','shift')->whereDate('created_at', Carbon::today())->orderBy('created_at','DESC')->get(),
            
            'tiket_tercetak' => Parkir::count(),
            'tiket_keluar' => Parkir::where('status','keluar')->count(),
            'tiket_expired' => Parkir::where('status','expired')->count(),

            'tiket_tercetak_today' => Parkir::whereDate('created_at', Carbon::today())->count(),
            'tiket_keluar_today' => Parkir::whereDate('created_at', Carbon::today())->where('status','keluar')->count(),
            'tiket_expired_today' => Parkir::whereDate('created_at', Carbon::today())->where('status','expired')->count(),

            'hari_ini' => Parkir::whereDate('created_at', Carbon::today())->sum('tarif'),
            'minggu_ini' => Parkir::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('tarif'),
            'bulan_ini' => Parkir::whereMonth('created_at', Carbon::today()->month)->sum('tarif'),
            'tahun_ini' => Parkir::whereYear('created_at', Carbon::today()->year)->sum('tarif'),
        ];
        return view('dashboard.dashboard-02', $data);
    }
}
