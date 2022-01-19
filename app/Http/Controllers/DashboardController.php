<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Log_operator;
use App\Models\Parkir;
use App\Models\Master_gate;

class DashboardController extends Controller
{
    public function index()
    {


        $data = [
            'log' => Log_operator::with('operator','shift')->whereDate('created_at', Carbon::today())->orderBy('created_at','DESC')->get(),

            'tiket_tercetak_detail' => Parkir::selectRaw('COUNT(*) AS qty_cetak, kategori')->groupBy('kategori')->whereDate('check_in', Carbon::today())->get(),
            'tiket_keluar_detail' => Parkir::selectRaw('COUNT(*) AS qty_cetak, kategori')->groupBy('kategori')->where('status','keluar')->whereDate('check_in', Carbon::today())->get(),
            'tiket_expired' => Parkir::selectRaw('COUNT(*) AS qty_cetak, kategori')->groupBy('kategori')->where('status','expired')->whereDate('check_in', Carbon::today())->get(),
           
            'hari_ini' => Parkir::with('kendaraan')->selectRaw('SUM(tarif) AS sum, kendaraan_id')->groupBy('kendaraan_id')->whereDate('check_in', Carbon::today())->get(),
            'minggu_ini' => Parkir::with('kendaraan')->selectRaw('SUM(tarif) AS sum, kendaraan_id')->groupBy('kendaraan_id')->whereBetween('check_in', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get(),
            'bulan_ini' => Parkir::with('kendaraan')->selectRaw('SUM(tarif) AS sum, kendaraan_id')->groupBy('kendaraan_id')->whereMonth('check_in', Carbon::today()->month)->get(),
            'tahun_ini' =>  Parkir::with('kendaraan')->selectRaw('SUM(tarif) AS sum, kendaraan_id')->groupBy('kendaraan_id')->whereYear('check_in', Carbon::today()->year)->get(),

            'master_gate' => Master_gate::get(),
        ];
        return view('dashboard.dashboard-02', $data);
    }
}
