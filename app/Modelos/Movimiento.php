<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    
    protected $table = "tbl_movimiento";
    protected $primaryKey = "eCodReg";
    public $timestamps = false;
}
