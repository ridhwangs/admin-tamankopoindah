<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Member extends Model
{
    use HasFactory;
    protected $connection = 'db_parkir';
    protected $table = "member";

    public function kendaraan()
    {
        return $this->setConnection('db_parkir')->belongsTo('App\Models\Kendaraan','kendaraan_id','kendaraan_id');
    }

    public function member_transaksi()
    {
        $query = DB::connection('db_parkir')->table('member_transaksi');
        return $query;
    }
}
