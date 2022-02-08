<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Parkir;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->parkir = new Parkir();
    }

    public function index()
    {
        return view('tiket.index');
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
        //
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
    public function destroy(Request $request, $id)
    {
        $parkir = Parkir::where(['barcode_id' => $request->barcode_id , 'status' => 'masuk'])->first()->toArray();
        if($parkir){
            $create =  $this->parkir->move_parkir()->insert($parkir);
            if($create){
                Parkir::where(['barcode_id' => $request->barcode_id , 'status' => 'masuk'])->delete();
                $message = $request->barcode_id. ' Berhasil dihapus';
            }else{
                $message = $request->barcode_id. ' Rungkad error 404';
            }
           
        }else{
            $message = $request->barcode_id. ' tidak ditemukan';
        }

        return redirect()->back()->with('message', $message);
    }
}
