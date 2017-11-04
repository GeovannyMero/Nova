<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    //
    protected $table = "tbl_ingreso";
    protected $primaryKey = "eCodReg";
    public $timestamps = false;

    public function ciclo(){
      return $this->belongsTo('App\Modelos\Ciclo');
    }
}
