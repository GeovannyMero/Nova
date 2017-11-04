<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class UsuarioPerfil extends Model
{
    //
       protected $table = "tbl_usuarioperfil";
    protected $primaryKey = "eCodReg";
    public $timestamps = false;
}
