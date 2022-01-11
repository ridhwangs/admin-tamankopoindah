<?php

namespace App\Models\Pengaturan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifFlat extends Model
{
    use HasFactory;
    protected $connection = 'db_parkir';
    protected $table = "tarif_flat";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'kendaraan_id',
        'nama_kendaraan',
        'kategori',
        'created_by',
        'created_at',
    ];

    public function kendaraan()
    {
        return $this->setConnection('db_parkir')->hasOne('App\Models\Kendaraan','kendaraan_id');
    }
}
