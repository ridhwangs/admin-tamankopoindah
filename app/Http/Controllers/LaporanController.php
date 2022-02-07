<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Parkir;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        switch ($id) {
            case 'masuk':
                $data = [
                    'parkir' => Parkir::where('status', 'masuk')->orderBy('check_in', 'DESC')->get(),
                ];
                return view('laporan.masuk.index', $data);
                break;
            case 'keluar':
                $today = Carbon::today();
                $where = [
                    'status' => 'keluar',
                ];

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
                    'parkir' => Parkir::with('kendaraan','operator','shift')->where($where)->whereDate('check_out', $today)->orderBy('check_out', 'DESC')->get(),
                    'filter_operator_dashboard' => Parkir::with('operator')->where('status','keluar')->groupBy('operator_id')->get(),
                    'filter_shift_dashboard' => Parkir::with('shift')->where('status','keluar')->groupBy('shift_id')->get(),
                ];
                return view('laporan.keluar.index', $data);
                break;
            default:
                # code...
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
