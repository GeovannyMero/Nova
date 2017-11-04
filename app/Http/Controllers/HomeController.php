<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection as Collection;
use App\User;
use DB;
use App\Modelos\Perfil;
use App\Modelos\Ciclo;
use App\Modelos\Ingreso;
use App\Modelos\Aprobacion;
use App\Modelos\PesadaInicial;
use App\Modelos\Inspeccion;
use App\Modelos\Movimiento;
use App\Modelos\PesadaFinal;
use App\Modelos\Salida;
use App\Modelos\ClienteProducto;
use App\Modelos\UsuarioPerfil;
use Validator;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciclo = Ciclo::whereDate('dFechaLLegada', date("Y-m-d "))->count();
        $ingreso = Ingreso::whereDate('dtFechaIngreso', date("Y-m-d "))->count();
        $aprobacionSi = Aprobacion::where('aResultado','SI')->whereDate('dFechaAprobacion', date("Y-m-d"))->count();
        $aprobacionNo = Aprobacion::where('aResultado','NO')->whereDate('dFechaAprobacion',date("Y-m-d"))->count();
        $inspeccionSi = Inspeccion::where('aResultado', 'SI')->whereDate('dFechaInspeccion',date("Y-m-d"))->count();
        $inspeccionNo = Inspeccion::where('aResultado', 'NO')->whereDate('dFechaInspeccion',date("Y-m-d"))->count();
        $pesadaI = PesadaInicial::whereDate('dFechaPesadaIni', date("Y-m-d "))->count();
        $movimiento = Movimiento::whereDate('dFechaIniMovimiento', date("Y-m-d "))->count();
        $pesadaF = PesadaFinal::whereDate('dFechaPesada', date("Y-m-d "))->count();
        $salida = Salida::whereDate('dFechaSalida', date("Y-m-d "))->count();
        $in = Ciclo::where('aIncidente','si')->whereDate('dFechaLLegada', date("Y-m-d "))->count();
       $pt =  \DB::table('tbl_clienteproducto')->select(DB::raw('count(*) as count, eTipoProducto', 'aNombreProducto as nombre'))->groupBy('eTipoProducto')->get();
    // dd($pt);

        //dd($ciclo);
         return view('admin.dasboard.home')->with('ciclo',$ciclo)->with('ingreso',$ingreso)->with('aprobacionSi',$aprobacionSi)->with('inspeccionSi',$inspeccionSi)->with('inspeccionNo',$inspeccionNo)->with('aprobacionNo',$aprobacionNo)->with('pesadaI',$pesadaI)->with('movimiento',$movimiento)->with('pesadaF',$pesadaF)->with('salida',$salida)->with('in',$in)->with('pt',$pt);

    }
    public function getTokens()
    {
        return view('home.personal-tokens');
    }

    public function getClients()
    {
        return view('home.personal-clients');
    }

    public function getAuthorizedClients()
    {
        return view('home.authorized-clients');
    }
}
