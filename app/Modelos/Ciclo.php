<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    //
    protected $table = "tbl_ciclo";
    protected $primaryKey = "eCodReg";
    public $timestamps = false;

    public function ingreso(){
      return $this->hasMany('App\Modelos\Ingreso');
    }
}
