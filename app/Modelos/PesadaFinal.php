<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class PesadaFinal extends Model
{
    //
    protected $table = "tbl_pesadafinal";
    protected $primaryKey = "eCodReg";
    public $timestamps = false;
    //Carbon\Carbon::createFromTime($sal - $ing)->format('H:i:s')
}
