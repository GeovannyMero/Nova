<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection as Collection;
use App\Modelos\ClienteProducto;
use App\Modelos\Ciclo;
use App\Modelos\CicloCliente;
use App\Modelos\Cliente;
use App\Modelos\Camion;
use App\Modelos\Producto;

use App\Modelos\Seguimiento;
use Carbon\Carbon;


class SeguimientoController extends Controller
{
    //
    public function index($idcliente = 0, $desde = 0, $hasta = 0){
       // dd($idcliente);
        $cliente = Cliente::all()->where('aEstado','A');
        if($idcliente == 0 && $desde == 0 && $hasta == 0)
        {
            $idcliente = 0;
            $desde = "";
            $hasta = "";
        }

        return view('admin.seguimiento.buscarCliente')->with('cliente',$cliente)
                                                      ->with('idcliente',$idcliente)
                                                      ->with('desde',$desde)
                                                      ->with('hasta',$hasta);
    }


    public function create($idcliente = 0, $desde = 0, $hasta = 0){
       // dd($idcliente);
       // $desde = Carbon::parse($request->fd)->format('Y-m-d');
        //$hasta = Carbon::parse($request->fh)->format('Y-m-d');
       // $cliente = Cliente::where('eCodReg',$request->aNombre)->get()->first();
      //dd($cliente->aNombre);
        $cliente = Cliente::all();
         $se = \DB::table('tbl_clienteproducto')

        ->leftJoin('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
        ->leftJoin('tbl_clientes','tbl_clientes.eCodReg','=','tbl_ciclo_cliente.eCodCliente')
        ->leftJoin('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
        //->leftJoin('tbl_producto','tbl_producto.eCodReg','=','tbl_clienteproducto.eCodProducto')
        ->leftJoin('tbl_detallesseguimiento',  'tbl_detallesseguimiento.eCodClienteProducto', '=','tbl_clienteproducto.eCodReg')

       /**/ ->select('tbl_clientes.eCodReg as eCodReg' , 'tbl_ciclo.dFechaLLegada as fecha',
            'tbl_clientes.aNombre as cliente','tbl_ciclo.eCodCamion as eCodCamion',
            'tbl_ciclo.aPlacaCamion as placa' ,'tbl_clienteproducto.aNombreProducto as producto',
            'tbl_detallesseguimiento.bCantidadBool  as cantidadB', 'tbl_detallesseguimiento.bTiempoBool as tiempoB',
            'tbl_detallesseguimiento.bCalidadBool as calidadB','tbl_detallesseguimiento.aCorreccionTiempo as tiempo',
            'tbl_detallesseguimiento.aCorrecionCantidad as cantidad', 'tbl_clienteproducto.eCodReg as Cod',
            'tbl_detallesseguimiento.aCorrecionCalidad as calidad', 'tbl_clienteproducto.codigo as codigo', 'tbl_clienteproducto.eCodReg as eCodPro')
        ->where('tbl_clienteproducto.eTipoProducto','PT')
        ->where('tbl_clientes.eCodReg', $idcliente)

        ->whereBetween('tbl_ciclo.dFechaLLegada', array($desde , $hasta))
        ->get();


       return view('admin.seguimiento.seguimiento')->with('se',$se) ;
        //return Response::json($se, $cliente);
    }

    public function show($idcliente,$idcamion, $codigo, $desde, $hasta, $cod){
      // dd(Seguimiento::where('eCodClienteProducto',$cod)->get());
        $fecha = (Ciclo::where('eCodCamion',$idcamion)->get()->first());
        $camion = Camion::where('eCodReg',$idcamion)->get()->first();
        $pro = ClienteProducto::where('eCodReg',$codigo)->get()->first();
      //  dd($pro);
        $cliente = Cliente::where('eCodReg',$idcliente)->get()->first();
        $seg = Seguimiento::all()->first();
        if((Seguimiento::where('eCodClienteProducto',$cod)->get()->first()) == ''){
          $se = new Seguimiento;
        }else{
         // dd('pk');
          $se = \DB::table('tbl_clienteproducto')
             ->leftJoin('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
             ->leftJoin('tbl_clientes','tbl_clientes.eCodReg','=','tbl_ciclo_cliente.eCodCliente')
             ->leftJoin('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
             //->leftJoin('tbl_producto','tbl_producto.eCodReg','=','tbl_clienteproducto.eCodProducto')
             ->leftJoin('tbl_detallesseguimiento',  'tbl_detallesseguimiento.eCodClienteProducto', '=','tbl_clienteproducto.eCodReg')
             ->select('tbl_clientes.eCodReg as eCodReg' , 'tbl_ciclo.dFechaLLegada as fecha',
             'tbl_clientes.aNombre as cliente','tbl_ciclo.eCodCamion as eCodCamion',
             'tbl_ciclo.aPlacaCamion as placa' ,'tbl_clienteproducto.aNombreProducto as producto',
             'tbl_detallesseguimiento.bCantidadBool  as cantidadB', 'tbl_detallesseguimiento.bTiempoBool as tiempoB',
             'tbl_detallesseguimiento.bCalidadBool as calidadB','tbl_detallesseguimiento.aCorreccionTiempo as tiempo',
             'tbl_detallesseguimiento.aCorrecionCantidad as cantidad', 'tbl_detallesseguimiento.aCantidad as ca',
             'tbl_detallesseguimiento.aCorrecionCalidad as calidad', 'tbl_clienteproducto.codigo as codigo',
             'tbl_clienteproducto.eCodReg as eCodPro', 'tbl_detallesseguimiento.aCalidad as cal',
             'tbl_detallesseguimiento.eCodReg as CodSeg','tbl_detallesseguimiento.aTiempo as t')
             ->where('tbl_clientes.eCodReg', $idcliente)
             ->where('tbl_detallesseguimiento.eCodClienteProducto',$cod)
             ->where('tbl_detallesseguimiento.aCodigoProd',$pro->codigo)
             ->where('tbl_clienteproducto.eTipoProducto','PT')
             ->get()->first();
        }




      return view ('admin.seguimiento.detalles')->with('cliente',$cliente)->with('camion',$camion)
                                                ->with('fecha',$fecha)->with('pro',$pro)->with('se', $se)
                                                ->with('seg', $seg)->with('desde',$desde)->with('hasta',$hasta);
    }
    public function store(Request $request){

//       dd($request->all());
        if($request->eCodReg == ''){
         // dd('ok');
            $detallesSeguimiento = new Seguimiento;
        }
        else{

            $detallesSeguimiento = Seguimiento::find($request->eCodReg);
        }
        $ca = Camion::where('aPlaca',$request->camion)->get()->first();
        $ci = Ciclo::where('eCodCamion',$ca->eCodReg)->get()->first();
       // dd($ci->eCodReg);
            $detallesSeguimiento->acliente = $request->cliente;
            $detallesSeguimiento->aCamion = $request->camion;
            $detallesSeguimiento->dtFecha = $request->fecha;
            $detallesSeguimiento->aTiempo = $request->tiempo;
            $detallesSeguimiento->aCantidad = $request->cantidad;
            $detallesSeguimiento->aCalidad = $request->calidad;
            $detallesSeguimiento->bTiempoBool = $request->tiemporadio;
            $detallesSeguimiento->bCantidadBool = $request->Cantiradio;
            $detallesSeguimiento->bCalidadBool = $request->Caliradio;
            $detallesSeguimiento->aCorreccionTiempo = $request->CorrecTiempo;
            $detallesSeguimiento->aCorrecionCantidad = $request->CorrecCant;
            $detallesSeguimiento->aCorrecionCalidad = $request->CorrecCali;
            $detallesSeguimiento->eCodCiclo = $ci->eCodReg;
            $detallesSeguimiento->eCodClienteProducto = $request->pro;
            $detallesSeguimiento->aCodigoProd = $request->CodPro;

            $url = '/seguimiento' . '/'. $request->idCliente . '/' . $request->desde . '/' . $request->hasta;
            if($detallesSeguimiento->save())
                Session::flash('message', 'Seguimiento registrado con exito');

            //dd($url);

            return redirect($url);
           // return view('admin.seguimiento.seguimiento',compact($request->idcliente, $request->desde , $request->hasta));
           // return $this->index( $request->idCliente ,$request->desde,$request->hasta );
    }

    public function edit($idcliente,$idcamion, $codigo)
    {
        //dd($codigo);
        return;
    }
}
