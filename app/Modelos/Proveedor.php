<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //
    protected $table = "tbl_proveedor";
    protected $primaryKey = "eCodReg";
    public $timestamps = false;
}
