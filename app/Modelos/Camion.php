<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\CicloTransformer;

class Camion extends Model
{
   protected $table = "tbl_camion";
    protected $primaryKey = "eCodReg";
    public $timestamps = false;
    public $transformer = CicloTransformer::class;
}
