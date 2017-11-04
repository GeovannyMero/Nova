<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class ClienteProducto extends Model
{
        protected $table = "tbl_clienteProducto";
    protected $primaryKey = "eCodReg";
    public $timestamps = false;
}
