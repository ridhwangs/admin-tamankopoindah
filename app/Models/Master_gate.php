<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_gate extends Model
{
    use HasFactory;
    protected $connection = 'db_parkir';
    protected $table = "master_gate";
}
