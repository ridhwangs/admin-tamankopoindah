<?php

namespace App\Models\Pengaturan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifMember extends Model
{
    use HasFactory;
    protected $connection = 'db_parkir';
    protected $table = "tarif_member";

    public function kendaraan()
    {
        return $this->setConnection('db_parkir')->hasOne('App\Models\Kendaraan','kendaraan_id');
    }
}
