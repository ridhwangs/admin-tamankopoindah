<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log_operator extends Model
{
    use HasFactory;
    protected $connection = 'db_parkir';
    protected $table = "log_operator";
    public $timestamps = false;
    
    protected $fillable = [
        'log_operator_id',
        'operator_id',
        'shift_id',
        'keterangan',
        'created_at',
    ];

    public function operator()
    {
        return $this->setConnection('db_parkir')->belongsTo('App\Models\Operator','operator_id','operator_id');
    }

    public function shift()
    {
        return $this->setConnection('db_parkir')->belongsTo('App\Models\Shift','shift_id','shift_id');
    }
}
