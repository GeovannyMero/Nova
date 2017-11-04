<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "tbl_clientes";
    protected $primaryKey = "eCodReg";
    public $timestamps = false;
}
  