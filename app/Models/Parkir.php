<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parkir extends Model
{
    use HasFactory;
    protected $connection = 'db_parkir';
    protected $table = "parkir";

    public function kendaraan()
    {
        return $this->setConnection('db_parkir')->belongsTo('App\Models\Kendaraan','kendaraan_id','kendaraan_id');
    }
}
