<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    
     protected $table = "tbl_ClienteVisit";
    protected $primaryKey = "eCodReg";
    public $timestamps = false;
}
