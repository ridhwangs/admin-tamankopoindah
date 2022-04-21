<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Log_operator;
use App\Models\Parkir;
use App\Models\ParkirLocal;
use App\Models\Master_gate;
use App\Models\Sync;

use Carbon\Carbon;

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
            'tiket_keluar_detail' => Parkir::selectRaw('COUNT(*) AS qty_cetak, kategori')->groupBy('kategori')->where('status','keluar')->where($where)->whereDate('check_out', $today)->get(),
            'tiket_expired' => Parkir::selectRaw('COUNT(*) AS qty_cetak, kategori')->groupBy('kategori')->where('status','expired')->whereDate('check_in', $today)->get(),
           
            'hari_ini' => Parkir::with('kendaraan')->selectRaw('SUM(tarif) AS sum, kendaraan_id')->groupBy('kendaraan_id')->where($where)->whereDate('check_out', $today)->get(),
            'minggu_ini' => Parkir::with('kendaraan')->selectRaw('SUM(tarif) AS sum, kendaraan_id')->groupBy('kendaraan_id')->whereBetween('check_out', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get(),
            'bulan_ini' => Parkir::with('kendaraan')->selectRaw('SUM(tarif) AS sum, kendaraan_id')->groupBy('kendaraan_id')->whereMonth('check_out', Carbon::today()->month)->get(),
            'tahun_ini' =>  Parkir::with('kendaraan')->selectRaw('SUM(tarif) AS sum, kendaraan_id')->groupBy('kendaraan_id')->whereYear('check_out', Carbon::today()->year)->get(),

            'master_gate' => Master_gate::get(),
            'filter_operator_dashboard' => Parkir::with('operator')->where('status','keluar')->groupBy('operator_id')->get(),
            'filter_shift_dashboard' => Parkir::with('shift')->where('status','keluar')->groupBy('shift_id')->get(),
            
            'tiket_tercetak_local' => ParkirLocal::selectRaw('COUNT(*) AS qty_cetak, kategori')->groupBy('kategori')->whereDate('check_in', $today)->get(),
            'tiket_keluar_local' => ParkirLocal::selectRaw('COUNT(*) AS qty_cetak, kategori')->groupBy('kategori')->where('status','keluar')->where($where)->whereDate('check_out', $today)->get(),
            'log_sync' => Sync::orderBy('id', 'DESC')->first(),
        ];
        return view('dashboard.dashboard-02', $data);
    }

    public function posting(Request $request)
    {   
        DB::transaction(function () {
            ParkirLocal::chunk(200, function ($query) {
                foreach ($query as $rows) {
                
                    $data = [
                        'no_ticket' => $rows->no_ticket,
                        'barcode_id' => $rows->barcode_id,
                        'rfid' => $rows->rfid,
                        'image_in' => $rows->image_in,
                        'image_out' => $rows->image_out,
                        'check_in' => $rows->check_in,
                        'check_out' => $rows->check_out,
                        'kategori' => $rows->kategori,
                        'kendaraan_id' => $rows->kendaraan_id,
                        'kategori_update' => $rows->kategori_update,
                        'no_kend' => $rows->no_kend,
                        'tarif' => $rows->tarif,
                        'bayar' => $rows->bayar,
                        'keterangan' => $rows->keterangan,
                        'status' => $rows->status,
                        'operator_id' => $rows->operator_id,
                        'shift_id' => $rows->shift_id,
                        'created_by' => $rows->created_by,
                    ];
                    $datalog = [
                        'created_by' => Auth::user()->email,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    DB::connection('db_parkir')->table('log_sync')->insert($datalog);
                    DB::connection('db_parkir')->table('parkir')->insert($data);
                    DB::connection('db_parkir_local')->table('parkir')->where('parkir_id', $rows->parkir_id)->delete();
                    
                }
            });
        }); 

        return back()->withInput();
    }
}
