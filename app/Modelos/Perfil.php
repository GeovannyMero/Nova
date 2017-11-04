<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
       protected $table = "tbl_perfil";
    protected $primaryKey = "eCodReg";
    public $timestamps = false;
}
