<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class CicloCliente extends Model
{
    //
    protected $table = "tbl_ciclo_cliente";
    protected $primaryKey = "eCodReg";
    public $timestamps = false;
}
