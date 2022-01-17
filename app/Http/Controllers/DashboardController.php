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
            
            'tiket_tercetak_detail' => Parkir::selectRaw('COUNT(*) AS qty_cetak, kategori')->groupBy('kategori')->whereDate('created_at', Carbon::today())->get(),
            'tiket_keluar_detail' => Parkir::selectRaw('COUNT(*) AS qty_cetak, kategori')->groupBy('kategori')->where('status','keluar')->whereDate('created_at', Carbon::today())->get(),
            'tiket_expired' => Parkir::selectRaw('COUNT(*) AS qty_cetak, kategori')->groupBy('kategori')->where('status','expired')->whereDate('created_at', Carbon::today())->get(),
           
            'hari_ini' => Parkir::with('kendaraan')->selectRaw('SUM(tarif) AS sum, kendaraan_id')->groupBy('kendaraan_id')->whereDate('created_at', Carbon::today())->get(),
            'minggu_ini' => Parkir::with('kendaraan')->selectRaw('SUM(tarif) AS sum, kendaraan_id')->groupBy('kendaraan_id')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get(),
            'bulan_ini' => Parkir::with('kendaraan')->selectRaw('SUM(tarif) AS sum, kendaraan_id')->groupBy('kendaraan_id')->whereMonth('created_at', Carbon::today()->month)->get(),
            'tahun_ini' =>  Parkir::with('kendaraan')->selectRaw('SUM(tarif) AS sum, kendaraan_id')->groupBy('kendaraan_id')->whereYear('created_at', Carbon::today()->year)->get(),
        ];
        return view('dashboard.dashboard-02', $data);
    }
}
