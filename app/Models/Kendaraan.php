<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;
    protected $connection = 'db_parkir';
    protected $table = "kendaraan";
    public $timestamps = false;
    
    protected $fillable = [
        'kendaraan_id',
        'nama_kendaraan',
        'kategori',
        'created_by',
        'created_at',
    ];
}
