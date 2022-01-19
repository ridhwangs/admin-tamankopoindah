<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Log_operator;
use App\Models\Parkir;
use App\Models\Master_gate;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $where = [];

        $today = Carbon::today();
        if(!empty($request->tanggal)){
            $today = $request->tanggal;
        }

        $operator_id = 0;
        if(!empty($request->operator_id)){
            $operator_id = $request->operator_id;
            $where['operator_id'] = $operator_id;
        }

        $shift_id = 0;
        if(!empty($request->shift_id)){
            $shift_id = $request->shift_id;
            $where['shift_id'] = $shift_id;
        }

        $data = [
            'log' => Log_operator::with('operator','shift')->whereDate('created_at', $today)->orderBy('created_at','DESC')->get(),

            'tiket_tercetak_detail' => Parkir::selectRaw('COUNT(*) AS qty_cetak, kategori')->groupBy('kategori')->whereDate('check_in', $today)->get(),
            'tiket_keluar_detail' => Parkir::selectRaw('COUNT(*) AS qty_cetak, kategori')->groupBy('kategori')->where('status','keluar')->where($where)->whereDate('check_in', $today)->get(),
            'tiket_expired' => Parkir::selectRaw('COUNT(*) AS qty_cetak, kategori')->groupBy('kategori')->where('status','expired')->whereDate('check_in', $today)->get(),
           
            'hari_ini' => Parkir::with('kendaraan')->selectRaw('SUM(tarif) AS sum, kendaraan_id')->groupBy('kendaraan_id')->where($where)->whereDate('check_in', $today)->get(),
            'minggu_ini' => Parkir::with('kendaraan')->selectRaw('SUM(tarif) AS sum, kendaraan_id')->groupBy('kendaraan_id')->whereBetween('check_in', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get(),
            'bulan_ini' => Parkir::with('kendaraan')->selectRaw('SUM(tarif) AS sum, kendaraan_id')->groupBy('kendaraan_id')->whereMonth('check_in', Carbon::today()->month)->get(),
            'tahun_ini' =>  Parkir::with('kendaraan')->selectRaw('SUM(tarif) AS sum, kendaraan_id')->groupBy('kendaraan_id')->whereYear('check_in', Carbon::today()->year)->get(),

            'master_gate' => Master_gate::get(),
            'filter_operator_dashboard' => Parkir::with('operator')->where('status','keluar')->groupBy('operator_id')->get(),
            'filter_shift_dashboard' => Parkir::with('shift')->where('status','keluar')->groupBy('shift_id')->get(),
        ];
        return view('dashboard.dashboard-02', $data);
    }
}
