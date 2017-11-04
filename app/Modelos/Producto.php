<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
       protected $table = "tbl_producto";
    protected $primaryKey = "eCodReg";
    public $timestamps = false;
}
