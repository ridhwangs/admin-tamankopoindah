<?php

namespace App\Models\Pengaturan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifSetting extends Model
{
    
    use HasFactory;
    
    protected $connection = 'db_parkir';
    protected $table = "tarif_setting";
}
