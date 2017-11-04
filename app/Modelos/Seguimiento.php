<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    //
    protected $table = "tbl_detallesSeguimiento";
    protected $primaryKey = "eCodReg";
    public $timestamps = false;

}
