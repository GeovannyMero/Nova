<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\CicloCliente;
use App\Modelos\Cliente;
use App\Modelos\Camion;
use App\Modelos\ClienteProducto;
use Barryvdh\DomPDF\Facade as PDF;
use App;
use Excel;
use Illuminate\Support\Facades\Input;

class ControlLotesDespachoController extends Controller
{
    public function search(){
        $camion = Cliente::all()->where('aEstado','A');
        $placa = Camion::all()->where('aEstado','A');
        return view('admin.reportes.ControlLotesDespacho.buscar')->with('camion',$camion)->with('placa',$placa);
    }
    public function index($desde, $hasta, $idCliente, $placa){
        //dd($placa);
      if($idCliente <> 0 && $placa == 'null')
      {
       // dd('1');
            $depacho = \DB::table('tbl_clienteproducto')
            ->join('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
            ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
            ->join('tbl_clientes','tbl_ciclo_cliente.eCodCliente','=','tbl_clientes.eCodReg')
            ->select('tbl_ciclo.dFechaLLegada as fecha','tbl_clienteproducto.aNumDoc as doc','tbl_clienteproducto.aNumTransaccion as tran',
            'tbl_clienteproducto.eTipoProducto as tipo','tbl_clienteproducto.aNumEntidad as entidad','tbl_ciclo.aTicket as ticket',
            'tbl_clientes.aNombre as cliente','tbl_ciclo.aPlacaCamion as placa','tbl_ciclo.aNombreChofer as chofer',
            'tbl_clienteproducto.aNombreProducto as producto','tbl_clienteproducto.aNumGuia as guia',
            'tbl_clienteproducto.codigo as codigo', 'tbl_clienteproducto.aLote as lote', 'tbl_clienteproducto.bodega_transaccion as bodega', 'tbl_clienteproducto.dcto_resp as dcto',
            'tbl_clienteproducto.observacion as obs', 'tbl_clienteproducto.eSacos as sacos')
            ->whereBetween('tbl_ciclo.dFechaLLegada',[$desde,$hasta])
            ->where('tbl_clientes.eCodReg',$idCliente)
            ->where('tbl_clienteproducto.eTipoProducto', 'PT')
            ->get();


            return view('admin.reportes.ControlLotesDespacho.previaControlLotesDespacho')->with('depacho',$depacho);

      }elseif ($idCliente <> 0 && $placa <> 'null' ) {
      //  dd('2');
          $depacho = \DB::table('tbl_clienteproducto')
            ->join('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
            ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
            ->join('tbl_clientes','tbl_ciclo_cliente.eCodCliente','=','tbl_clientes.eCodReg')
            ->select('tbl_ciclo.dFechaLLegada as fecha','tbl_clienteproducto.aNumDoc as doc','tbl_clienteproducto.aNumTransaccion as tran',
            'tbl_clienteproducto.eTipoProducto as tipo','tbl_clienteproducto.aNumEntidad as entidad','tbl_ciclo.aTicket as ticket',
            'tbl_clientes.aNombre as cliente','tbl_ciclo.aPlacaCamion as placa','tbl_ciclo.aNombreChofer as chofer',
            'tbl_clienteproducto.aNombreProducto as producto','tbl_clienteproducto.aNumGuia as guia',
            'tbl_clienteproducto.codigo as codigo', 'tbl_clienteproducto.aLote as lote', 'tbl_clienteproducto.bodega_transaccion as bodega', 'tbl_clienteproducto.dcto_resp as dcto',
            'tbl_clienteproducto.observacion as obs', 'tbl_clienteproducto.eSacos as sacos')
            ->whereBetween('tbl_ciclo.dFechaLLegada',[$desde,$hasta])
            ->where('tbl_clientes.eCodReg',$idCliente)
            ->where('tbl_clienteproducto.eTipoProducto', 'PT')
            ->where('tbl_ciclo.eCodCamion',$placa)
            ->get();


            return view('admin.reportes.ControlLotesDespacho.previaControlLotesDespacho')->with('depacho',$depacho);
      }
      elseif($idCliente == 0 && $placa == 'null')
      {
            $depacho = \DB::table('tbl_clienteproducto')
            ->join('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
            ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
            ->join('tbl_clientes','tbl_ciclo_cliente.eCodCliente','=','tbl_clientes.eCodReg')
            ->select('tbl_ciclo.dFechaLLegada as fecha','tbl_clienteproducto.aNumDoc as doc','tbl_clienteproducto.aNumTransaccion as tran',
            'tbl_clienteproducto.eTipoProducto as tipo','tbl_clienteproducto.aNumEntidad as entidad','tbl_ciclo.aTicket as ticket',
            'tbl_clientes.aNombre as cliente','tbl_ciclo.aPlacaCamion as placa','tbl_ciclo.aNombreChofer as chofer',
            'tbl_clienteproducto.aNombreProducto as producto','tbl_clienteproducto.aNumGuia as guia',
            'tbl_clienteproducto.codigo as codigo', 'tbl_clienteproducto.aLote as lote', 'tbl_clienteproducto.bodega_transaccion as bodega', 'tbl_clienteproducto.dcto_resp as dcto',
            'tbl_clienteproducto.observacion as obs', 'tbl_clienteproducto.eSacos as sacos')
            ->whereBetween('tbl_ciclo.dFechaLLegada',[$desde,$hasta])
            ->where('tbl_clienteproducto.eTipoProducto', 'PT')
           // ->where('tbl_clientes.eCodReg',$idCliente)
            ->get();


            return view('admin.reportes.ControlLotesDespacho.previaControlLotesDespacho')->with('depacho',$depacho);

      }
    	   }
    public function show(){
     	$depacho = \DB::table('tbl_clienteproducto')
    	->join('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
    	->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
    	->select('tbl_ciclo.dFechaLLegada as fecha','tbl_clienteproducto.aNumDoc as doc','tbl_clienteproducto.aNumTransaccion as tran',
            'tbl_clienteproducto.eTipoProducto as tipo','tbl_clienteproducto.aNumEntidad as entidad','tbl_ciclo.aTicket as ticket',
            'tbl_clientes.aNombre as cliente','tbl_ciclo.aPlacaCamion as placa','tbl_ciclo.aNombreChofer as chofer',
            'tbl_clienteproducto.aNombreProducto as producto','tbl_clienteproducto.aNumGuia as guia')
    	->get();
    	//dd($depacho);
    	 $pdf = App::make('dompdf.wrapper');
	   $pdf->loadView('admin.reportes.ControlLotesDespacho.pdfControlLotesDespacho' ,['depacho'=>$depacho]);
	   return $pdf->stream('ControlLotesDespacho.pdf');
    }

    //exportar reporte a excel
    public function ExcelReport(Request $request){
//dd($request->all()); idCamion
       Excel::create('NovaCD', function($excel) use($request){
        $excel->sheet('ControlLotesDespacho',function($sheet) use($request){
          if($request->aPlaca <> 0)
          {
                 $depacho = ClienteProducto::join('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
                 ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
                 ->join('tbl_clientes','tbl_ciclo_cliente.eCodCliente','=','tbl_clientes.eCodReg')
                 ->select('tbl_ciclo.dFechaLLegada as fecha','tbl_clienteproducto.aNumDoc as doc','tbl_clienteproducto.aNumTransaccion as tran',
                 'tbl_clienteproducto.eTipoProducto as tipo','tbl_clienteproducto.aNumEntidad as entidad','tbl_ciclo.aTicket as ticket',
                 'tbl_clientes.aNombre as cliente','tbl_ciclo.aPlacaCamion as placa','tbl_ciclo.aNombreChofer as chofer',
                 'tbl_clienteproducto.aNombreProducto as producto','tbl_clienteproducto.aNumGuia as guia',
                 'tbl_clienteproducto.codigo as codigo', 'tbl_clienteproducto.aLote as lote', 'tbl_clienteproducto.bodega_transaccion as bodega', 'tbl_clienteproducto.dcto_resp as dcto',
                 'tbl_clienteproducto.observacion as obs', 'tbl_clienteproducto.eSacos as sacos')
                 ->whereBetween('tbl_ciclo.dFechaLLegada',[$request->fd,$request->fh])
                 ->where('tbl_clientes.eCodReg',$request->aPlaca)
                 ->where('tbl_clienteproducto.eTipoProducto', 'PT')
                 ->get();

                 $sheet->loadView('admin.reportes.ControlLotesDespacho.excelControlLotesDespacho',['depacho'=>$depacho]);

          }
          else
          {
                 $depacho = ClienteProducto::join('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
                 ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
                 ->join('tbl_clientes','tbl_ciclo_cliente.eCodCliente','=','tbl_clientes.eCodReg')
                 ->select('tbl_ciclo.dFechaLLegada as fecha','tbl_clienteproducto.aNumDoc as doc','tbl_clienteproducto.aNumTransaccion as tran',
                 'tbl_clienteproducto.eTipoProducto as tipo','tbl_clienteproducto.aNumEntidad as entidad','tbl_ciclo.aTicket as ticket',
                 'tbl_clientes.aNombre as cliente','tbl_ciclo.aPlacaCamion as placa','tbl_ciclo.aNombreChofer as chofer',
                 'tbl_clienteproducto.aNombreProducto as producto','tbl_clienteproducto.aNumGuia as guia',
                 'tbl_clienteproducto.codigo as codigo', 'tbl_clienteproducto.aLote as lote', 'tbl_clienteproducto.bodega_transaccion as bodega', 'tbl_clienteproducto.dcto_resp as dcto',
                 'tbl_clienteproducto.observacion as obs', 'tbl_clienteproducto.eSacos as sacos')
                 ->whereBetween('tbl_ciclo.dFechaLLegada',[$request->fd,$request->fh])
               //  ->where('tbl_clientes.eCodReg',$request->aPlaca)
                 ->where('tbl_clienteproducto.eTipoProducto', 'PT')
                 ->get();

                 $sheet->loadView('admin.reportes.ControlLotesDespacho.excelControlLotesDespacho',['depacho'=>$depacho]);

          }

            });
        })->export('xls', [
     'Set-Cookie'  => 'fileDownload=true;'
]);

    }
}
