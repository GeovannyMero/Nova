<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Inspeccion extends Model
{
  protected $table = "tbl_inspeccion";
   protected $primaryKey = "eCodReg";
   public $timestamps = false;
}
