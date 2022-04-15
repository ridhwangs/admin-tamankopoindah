<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Absensi extends Model
{
    use HasFactory;
    protected $connection = 'db_parkir';
    protected $table = "parkir";

    
    public function absensi_mingguan()
    {
        $query = DB::connection('db_parkir')
            ->table('parkir')
            ->join('member', 'member.rfid', '=', 'parkir.rfid')
            ->where('member.keterangan','KARYAWAN GOR + BERLAKU UNTUK ABSEN')
            ->whereNotNull('parkir.rfid')
            // ->groupBy(DB::raw("DATE(check_in)"),'parkir.rfid')
            ->orderBy('member.nama','asc')
            ->orderBy('parkir.check_in','asc');
        return $query;
    }
}
