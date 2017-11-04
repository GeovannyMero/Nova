<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{
    //
    protected $table = "tbl_sistema";
    protected $primaryKey = "eCodReg";
    public $timestamps = false;
}
