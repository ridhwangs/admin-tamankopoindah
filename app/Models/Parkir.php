<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Parkir extends Model
{
    use HasFactory;
    protected $connection = 'db_parkir';
    protected $table = "parkir";
    protected $primaryKey = "parkir_id";

    public function move_parkir()
    {
        $query = DB::connection('db_parkir')->table('move_parkir');
        return $query;
    }

    public function kendaraan()
    {
        return $this->setConnection('db_parkir')->belongsTo('App\Models\Kendaraan','kendaraan_id','kendaraan_id');
    }

    public function operator()
    {
        return $this->setConnection('db_parkir')->belongsTo('App\Models\Operator','operator_id','operator_id');
    }

    public function shift()
    {
        return $this->setConnection('db_parkir')->belongsTo('App\Models\Shift','shift_id','shift_id');
    }

    public function member()
    {
        return $this->setConnection('db_parkir')->belongsTo('App\Models\Member','rfid','rfid');
    }
    
}
