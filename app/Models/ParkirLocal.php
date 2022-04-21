<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkirLocal extends Model
{
    use HasFactory;
    protected $connection = 'db_parkir_local';
    protected $table = "parkir";
    protected $primaryKey = "parkir_id";
}
