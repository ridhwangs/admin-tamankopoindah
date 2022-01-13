<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;
    protected $connection = 'db_parkir';
    protected $table = "operator";

    public function last_login(){
        return $this->setConnection('db_parkir')->belongsTo('App\Models\Log_operator','operator_id','operator_id');
    }
}

