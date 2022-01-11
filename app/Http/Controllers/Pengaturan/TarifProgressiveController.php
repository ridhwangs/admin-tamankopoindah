<?php

namespace App\Http\Controllers\Pengaturan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Pengaturan\TarifProgressive;

class TarifProgressiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
    public function show($id)
    {
        $data = [
            'tarif_progressive' => TarifProgressive::where('api_key', $id)->with('kendaraan')->get(),
            'api_key' => $id, 
        ];
        return view('pengaturan.tarif_progressive', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $api_key)
    {
        $id = $request->id;
        $tarif_1 = $request->tarif_1;
        $tarif_2 = $request->tarif_2;
        $tarif_3 = $request->tarif_3;
        $tarif_4 = $request->tarif_4;
        $tarif_5 = $request->tarif_5;

        foreach ($id as $key => $value) {
            $data = [
                'tarif_1' => $tarif_1[$key],
                'tarif_2' => $tarif_2[$key],
                'tarif_3' => $tarif_3[$key],
                'tarif_4' => $tarif_4[$key],
                'tarif_5' => $tarif_5[$key],
                'created_by' => Auth::user()->email,
            ];
            TarifProgressive::where('id', $id[$key])->update($data);
        }

        return redirect()->back()->with('message', 'Semua data berhasil disimpan!');
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
