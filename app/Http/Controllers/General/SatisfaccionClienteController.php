<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Modelos\Cliente;
use App\Modelos\Camion;
use App\Http\Controllers\Controller;
use Excel;
class SatisfaccionClienteController extends Controller
{
    public function index(){
    	$cliente = Cliente::where('aEstado','A')->get();
        $placa = Camion::where('aEstado','A')->get();
        	return view ('admin.reportes.SatisfaccionCliente.satisfaccionCliente')->with('cliente',$cliente)->with('placa',$placa);
    }

    public function create($desde, $hasta , $idCliente, $placa){
        //dd($placa);//
    	if($idCliente <> 0 && $placa == 'null')
        {
            $seguimiento = \DB::table('tbl_clienteproducto')
            ->leftJoin('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
            ->leftJoin('tbl_clientes','tbl_clientes.eCodReg','=','tbl_ciclo_cliente.eCodCliente')
            ->leftJoin('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
        //    ->leftJoin('tbl_detallesseguimiento', 'tbl_ciclo.eCodReg', '=', 'tbl_detallesseguimiento.eCodCiclo')
        ->leftJoin('tbl_detallesseguimiento', 'tbl_detallesseguimiento.eCodClienteProducto', '=', 'tbl_clienteproducto.eCodReg')
            ->select('tbl_clientes.eCodReg as eCodReg' , 'tbl_ciclo.dFechaLLegada as fecha',
            'tbl_clientes.aNombre as cliente','tbl_ciclo.eCodCamion as eCodCamion',
            'tbl_ciclo.aPlacaCamion as placa' ,'tbl_clienteproducto.aNombreProducto as producto',
            'tbl_detallesseguimiento.bCantidadBool  as cantidadB', 'tbl_detallesseguimiento.bTiempoBool as tiempoB',
            'tbl_detallesseguimiento.bCalidadBool as calidadB','tbl_detallesseguimiento.aCorreccionTiempo as tiempo',
            'tbl_detallesseguimiento.aCorrecionCantidad as cantidad', 'tbl_detallesseguimiento.aCorrecionCalidad as calidad')
            ->where('tbl_clientes.eCodReg', $idCliente)
            ->where('tbl_clienteproducto.eTipoProducto', 'PT')
            ->whereBetween('tbl_ciclo.dFechaLLegada', array($desde , $hasta))
            ->get();
//dd($seguimiento);
        return view('admin.reportes.SatisfaccionCliente.previaSatisfaccionCliente')->with('seguimiento',$seguimiento);

        }elseif ($idCliente <> 0 && $placa <> 'null') {
          $seguimiento = \DB::table('tbl_clienteproducto')
            ->leftJoin('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
            ->leftJoin('tbl_clientes','tbl_clientes.eCodReg','=','tbl_ciclo_cliente.eCodCliente')
            ->leftJoin('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
        //    ->leftJoin('tbl_detallesseguimiento', 'tbl_ciclo.eCodReg', '=', 'tbl_detallesseguimiento.eCodCiclo')
        ->leftJoin('tbl_detallesseguimiento', 'tbl_detallesseguimiento.eCodClienteProducto', '=', 'tbl_clienteproducto.eCodReg')
            ->select('tbl_clientes.eCodReg as eCodReg' , 'tbl_ciclo.dFechaLLegada as fecha',
            'tbl_clientes.aNombre as cliente','tbl_ciclo.eCodCamion as eCodCamion',
            'tbl_ciclo.aPlacaCamion as placa' ,'tbl_clienteproducto.aNombreProducto as producto',
            'tbl_detallesseguimiento.bCantidadBool  as cantidadB', 'tbl_detallesseguimiento.bTiempoBool as tiempoB',
            'tbl_detallesseguimiento.bCalidadBool as calidadB','tbl_detallesseguimiento.aCorreccionTiempo as tiempo',
            'tbl_detallesseguimiento.aCorrecionCantidad as cantidad', 'tbl_detallesseguimiento.aCorrecionCalidad as calidad')
            ->where('tbl_clientes.eCodReg', $idCliente)
            ->where('tbl_clienteproducto.eTipoProducto', 'PT')
            ->where('tbl_ciclo.eCodCamion',$placa)
            ->whereBetween('tbl_ciclo.dFechaLLegada', array($desde , $hasta))
            ->get();
//dd($seguimiento);
        return view('admin.reportes.SatisfaccionCliente.previaSatisfaccionCliente')->with('seguimiento',$seguimiento);

        }
        elseif($idCliente == 0 && $placa == 'null')
        {
          $seguimiento = \DB::table('tbl_clienteproducto')
            ->leftJoin('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
            ->leftJoin('tbl_clientes','tbl_clientes.eCodReg','=','tbl_ciclo_cliente.eCodCliente')
            ->leftJoin('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
          //  ->leftJoin('tbl_detallesseguimiento', 'tbl_ciclo.eCodReg', '=', 'tbl_detallesseguimiento.eCodCiclo')
              ->leftJoin('tbl_detallesseguimiento', 'tbl_detallesseguimiento.eCodClienteProducto', '=', 'tbl_clienteproducto.eCodReg')
            ->select('tbl_clientes.eCodReg as eCodReg' , 'tbl_ciclo.dFechaLLegada as fecha',
            'tbl_clientes.aNombre as cliente','tbl_ciclo.eCodCamion as eCodCamion',
            'tbl_ciclo.aPlacaCamion as placa' ,'tbl_clienteproducto.aNombreProducto as producto',
            'tbl_detallesseguimiento.bCantidadBool  as cantidadB', 'tbl_detallesseguimiento.bTiempoBool as tiempoB',
            'tbl_detallesseguimiento.bCalidadBool as calidadB','tbl_detallesseguimiento.aCorreccionTiempo as tiempo',
            'tbl_detallesseguimiento.aCorrecionCantidad as cantidad', 'tbl_detallesseguimiento.aCorrecionCalidad as calidad')
           // ->where('tbl_clientes.eCodReg', $idCliente)
           ->where('tbl_clienteproducto.eTipoProducto', 'PT')
            ->whereBetween('tbl_ciclo.dFechaLLegada', array($desde , $hasta))
            ->get();

        return view('admin.reportes.SatisfaccionCliente.previaSatisfaccionCliente')->with('seguimiento',$seguimiento);


        }elseif ($idCliente == 0 && $placa <> 'null') {
             $seguimiento = \DB::table('tbl_clienteproducto')
            ->leftJoin('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
            ->leftJoin('tbl_clientes','tbl_clientes.eCodReg','=','tbl_ciclo_cliente.eCodCliente')
            ->leftJoin('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
        //    ->leftJoin('tbl_detallesseguimiento', 'tbl_ciclo.eCodReg', '=', 'tbl_detallesseguimiento.eCodCiclo')
        ->leftJoin('tbl_detallesseguimiento', 'tbl_detallesseguimiento.eCodClienteProducto', '=', 'tbl_clienteproducto.eCodReg')
            ->select('tbl_clientes.eCodReg as eCodReg' , 'tbl_ciclo.dFechaLLegada as fecha',
            'tbl_clientes.aNombre as cliente','tbl_ciclo.eCodCamion as eCodCamion',
            'tbl_ciclo.aPlacaCamion as placa' ,'tbl_clienteproducto.aNombreProducto as producto',
            'tbl_detallesseguimiento.bCantidadBool  as cantidadB', 'tbl_detallesseguimiento.bTiempoBool as tiempoB',
            'tbl_detallesseguimiento.bCalidadBool as calidadB','tbl_detallesseguimiento.aCorreccionTiempo as tiempo',
            'tbl_detallesseguimiento.aCorrecionCantidad as cantidad', 'tbl_detallesseguimiento.aCorrecionCalidad as calidad')
            //->where('tbl_clientes.eCodReg', $idCliente)
            ->where('tbl_clienteproducto.eTipoProducto', 'PT')
            ->where('tbl_ciclo.eCodCamion',$placa)
            ->whereBetween('tbl_ciclo.dFechaLLegada', array($desde , $hasta))
            ->get();
//dd($seguimiento);
        return view('admin.reportes.SatisfaccionCliente.previaSatisfaccionCliente')->with('seguimiento',$seguimiento);

        }
 }
    public function ExcelReport(Request $request){

        Excel::create('NovaCD', function($excel) use($request){
            $excel->sheet('SatisfaccionCliente',function($sheet) use($request){
                 if($request->despacho <> 0)
                 {
                    $seguimiento = \DB::table('tbl_clienteproducto')
                    ->leftJoin('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
                    ->leftJoin('tbl_clientes','tbl_clientes.eCodReg','=','tbl_ciclo_cliente.eCodCliente')
                    ->leftJoin('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
                    //->leftJoin('tbl_producto','tbl_producto.eCodReg','=','tbl_clienteproducto.eCodProducto')
                  //  ->leftJoin('tbl_detallesseguimiento',  'tbl_detallesseguimiento.eCodCiclo', '=','tbl_ciclo.eCodReg')
                    ->leftJoin('tbl_detallesseguimiento', 'tbl_detallesseguimiento.eCodClienteProducto', '=', 'tbl_clienteproducto.eCodReg')
                    ->select('tbl_clientes.eCodReg as eCodReg' , 'tbl_ciclo.dFechaLLegada as fecha',
                    'tbl_clientes.aNombre as cliente','tbl_ciclo.eCodCamion as eCodCamion',
                    'tbl_ciclo.aPlacaCamion as placa' ,'tbl_clienteproducto.aNombreProducto as producto',
                    'tbl_detallesseguimiento.bCantidadBool  as cantidadB', 'tbl_detallesseguimiento.bTiempoBool as tiempoB',
                    'tbl_detallesseguimiento.bCalidadBool as calidadB','tbl_detallesseguimiento.aCorreccionTiempo as tiempo',
                    'tbl_detallesseguimiento.aCorrecionCantidad as cantidad', 'tbl_detallesseguimiento.aCantidad as ca',
                    'tbl_detallesseguimiento.aCorrecionCalidad as calidad', 'tbl_clienteproducto.codigo as codigo',
                    'tbl_clienteproducto.eCodReg as eCodPro', 'tbl_detallesseguimiento.aCalidad as cal', 'tbl_detallesseguimiento.aTiempo as t')

                    ->where('tbl_clientes.eCodReg', $request->despacho)
                    ->where('tbl_clienteproducto.eTipoProducto', 'PT')
                    ->whereBetween('tbl_ciclo.dFechaLLegada', array($request->fd , $request->fh))
                    ->get();

                     $sheet->loadView('admin.reportes.SatisfaccionCliente.excelSatisfaccion',['seguimiento'=>$seguimiento]);


                 }
                 else
                 {
                        $seguimiento = \DB::table('tbl_clienteproducto')
                        ->leftJoin('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
                        ->leftJoin('tbl_clientes','tbl_clientes.eCodReg','=','tbl_ciclo_cliente.eCodCliente')
                        ->leftJoin('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
                        //->leftJoin('tbl_producto','tbl_producto.eCodReg','=','tbl_clienteproducto.eCodProducto')
                        //->leftJoin('tbl_detallesseguimiento',  'tbl_detallesseguimiento.eCodCiclo', '=','tbl_ciclo.eCodReg')
                        ->leftJoin('tbl_detallesseguimiento', 'tbl_detallesseguimiento.eCodClienteProducto', '=', 'tbl_clienteproducto.eCodReg')
                        ->select('tbl_clientes.eCodReg as eCodReg' , 'tbl_ciclo.dFechaLLegada as fecha',
                        'tbl_clientes.aNombre as cliente','tbl_ciclo.eCodCamion as eCodCamion',
                        'tbl_ciclo.aPlacaCamion as placa' ,'tbl_clienteproducto.aNombreProducto as producto',
                        'tbl_detallesseguimiento.bCantidadBool  as cantidadB', 'tbl_detallesseguimiento.bTiempoBool as tiempoB',
                        'tbl_detallesseguimiento.bCalidadBool as calidadB','tbl_detallesseguimiento.aCorreccionTiempo as tiempo',
                        'tbl_detallesseguimiento.aCorrecionCantidad as cantidad', 'tbl_detallesseguimiento.aCantidad as ca',
                        'tbl_detallesseguimiento.aCorrecionCalidad as calidad', 'tbl_clienteproducto.codigo as codigo',
                        'tbl_clienteproducto.eCodReg as eCodPro', 'tbl_detallesseguimiento.aCalidad as cal', 'tbl_detallesseguimiento.aTiempo as t')

                       // ->where('tbl_clientes.eCodReg', $request->despacho)
                        ->where('tbl_clienteproducto.eTipoProducto', 'PT')
                        ->whereBetween('tbl_ciclo.dFechaLLegada', array($request->fd , $request->fh))
                        ->get();

                        $sheet->loadView('admin.reportes.SatisfaccionCliente.excelSatisfaccion',['seguimiento'=>$seguimiento]);


                 }
             });
        })->export('xls');
    }
}
