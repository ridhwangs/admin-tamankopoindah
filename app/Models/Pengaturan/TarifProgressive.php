<?php

namespace App\Models\Pengaturan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifProgressive extends Model
{
    use HasFactory;
    protected $connection = 'db_parkir';
    protected $table = "tarif_progressive";

    public function kendaraan()
    {
        return $this->setConnection('db_parkir')->hasOne('App\Models\Kendaraan','kendaraan_id');
    }
}
