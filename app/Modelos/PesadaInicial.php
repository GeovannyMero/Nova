<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class PesadaInicial extends Model
{
    protected $table = "tbl_pesadainicial";
    protected $primaryKey = "eCodReg";
    public $timestamps = false;
}
