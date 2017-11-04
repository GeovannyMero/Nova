<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Aprobacion extends Model
{
  protected $table = "tbl_aprobacion";
   protected $primaryKey = "eCodReg";
   public $timestamps = false;
}
