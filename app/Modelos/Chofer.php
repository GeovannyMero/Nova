<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    
    protected $table = "tbl_chofer";
    protected $primaryKey = "eCodReg";
    public $timestamps = false;
}
