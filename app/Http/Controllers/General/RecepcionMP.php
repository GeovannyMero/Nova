<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection as Collection;
use App\Modelos\Camion;
use App\Modelos\Proveedor;
use App\Modelos\CicloCliente;
use App\Modelos\Producto;
use App\Modelos\ClienteProducto;
use App\Modelos\Ciclo;
use Carbon\Carbon;
use Excel;

class RecepcionMP extends Controller
{
    public function index(){
      $camion = \DB::table('tbl_ciclo')
      ->join('tbl_camion','tbl_camion.eCodReg','=','tbl_ciclo.eCodCamion')
      ->select('tbl_camion.eCodReg','tbl_camion.aPlaca')
      ->where('tbl_ciclo.eCodFlujo',1)
      ->where('tbl_camion.aEstado','A')
      ->get();
     //dd($camion);
        return view('admin.recepcionMP.bucarMP')->with('camion',$camion);
    }

    public function create($desde, $hasta, $id){
        $mp = \DB::table('tbl_ciclo')
        ->join('tbl_camion','tbl_camion.eCodReg','=','tbl_ciclo.eCodCamion')
        ->join('tbl_chofer','tbl_chofer.eCodReg','=','tbl_ciclo.eCodChofer')
        ->select('tbl_ciclo.eCodReg as cod','tbl_camion.aPlaca','tbl_chofer.eCodReg as eCodChofer',
          'tbl_chofer.aNombre','tbl_chofer.aCompaTrans as cia')
        ->whereBetween('tbl_ciclo.dfechaLLegada',array($desde,$hasta))
        ->where('tbl_camion.eCodReg',$id)
        ->get();
        return view('admin.recepcionMP.recepcionMP')->with('mp',$mp);
    }

    public function show($id){
      //LLegada
         $ciclo = \DB::table('tbl_ciclo')
      ->join('tbl_camion','tbl_camion.eCodReg','tbl_ciclo.eCodCamion')
      ->join('tbl_chofer','tbl_chofer.eCodReg','tbl_ciclo.eCodChofer')
      ->select('tbl_ciclo.eCodReg', 'tbl_ciclo.dFechaLLegada as fecha','tbl_ciclo.dHoraLLegada as hora',
       'tbl_ciclo.aTicket as ticket', 'tbl_camion.aPlaca as placa', 'tbl_chofer.aNombre','tbl_ciclo.aCedulaChofer as cedula')
      ->where('tbl_ciclo.eCodReg',$id)
      ->where('tbl_ciclo.eCodFlujo',1)
      ->get();

      //Ingreso
      $ingreso = \DB::table('tbl_ingreso')
      ->join('tbl_ciclo','tbl_ciclo.eCodReg','tbl_ingreso.eCodCiclo')
      ->where('tbl_ciclo.eCodReg',$id)
      ->where('tbl_ciclo.eCodFlujo',1)
      ->get();

      //Historial de carga
      $hcarga =\DB::table('tbl_historialcarga')
      ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_historialcarga.eCodCiclo')
      ->select('tbl_historialcarga.dFechaCarga as fecha', 'tbl_historialcarga.aProcedencia as procedencia', 
      'tbl_historialcarga.aGuiaRemision as guia', 'tbl_historialcarga.aInsumo as insumo')
      ->where('tbl_ciclo.eCodReg',$id)
      ->where('tbl_ciclo.eCodFlujo',1)
      ->get();

      //Historial de limpieza
      $hLimpieza = \DB::table('tbl_historiallimpieza')
      ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_historiallimpieza.eCodCiclo')
      ->select('tbl_historiallimpieza.dFechaLimpieza as fecha', 'tbl_historiallimpieza.aMetodoLimpieza as MLim', 'tbl_historiallimpieza.aAgenteLimpieza as ALim',
      'tbl_historiallimpieza.aMetodoFumigacion as MFumi','tbl_historiallimpieza.aAgentefumigacion as AFumi')
       ->where('tbl_ciclo.eCodReg',$id)
      ->where('tbl_ciclo.eCodFlujo',1)
      ->get();

        //Aprbacion
      $apro = \DB::table('tbl_aprobacion')
      ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_aprobacion.eCodCiclo')
      ->select('tbl_aprobacion.eCodReg','tbl_aprobacion.aAprobacionFinan as bfina','tbl_aprobacion.aAprobFinanObservaciones as fina','tbl_aprobacion.aProduccionCalidad as bpro',
        'tbl_aprobacion.aProduccionCalidadObservaciones as pro','tbl_aprobacion.aLogistica as blog', 'tbl_aprobacion.aLogisticaObservaciones as log')
      ->where('tbl_ciclo.eCodReg',$id)
      ->where('tbl_ciclo.eCodFlujo',1)
      ->get();

       //pesada inicial
      $PI = \DB::table('tbl_pesadainicial')
      ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_pesadainicial.eCodCiclo')
      ->select('tbl_pesadainicial.dHoraPesadaIni as hora','tbl_pesadainicial.aNoTicketPI as ticket','tbl_pesadainicial.ePesoInicial as peso','tbl_pesadainicial.eNumeroPedido as pedido',
        'tbl_pesadainicial.dFechaPesadaIni as fecha','tbl_ciclo.eCodReg')
      ->where('tbl_ciclo.eCodReg',$id)
      ->where('tbl_ciclo.eCodFlujo',1)
      ->get();

      //inspeccion
      $insp = \DB::table('tbl_inspeccion')
      ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_inspeccion.eCodCiclo')
      ->select('tbl_inspeccion.dFechaInspeccion as fecha', 'tbl_inspeccion.aCubierto', 'tbl_inspeccion.aLona', 'tbl_inspeccion.aDesinfeccion',
        'tbl_inspeccion.aLimpieza', 'tbl_inspeccion.aInsectos', 'tbl_inspeccion.aContaminantes', 'tbl_inspeccion.aObservaciones', 'tbl_inspeccion.aResultado',
        'tbl_ciclo.eCodReg')
      ->where('tbl_ciclo.eCodFlujo',1)
      ->where('tbl_ciclo.eCodReg',$id)
      ->get();

      //descarga
      $carga = \DB::table('tbl_movimiento')
      ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_movimiento.eCodCiclo')
      ->where('tbl_ciclo.eCodFlujo',1)
          ->where('tbl_ciclo.eCodReg',$id)
      ->get();

      //peso de salida
      $pesoS = \DB::table('tbl_pesadafinal')
      ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_pesadafinal.eCodCiclo')
      ->select('tbl_ciclo.eCodReg', 'tbl_pesadafinal.dFechaPesada as fecha', 'tbl_pesadafinal.dHoraPesada as hora', 'tbl_pesadafinal.aNoTicketPF as ticket','tbl_pesadafinal.ePesoFinal as peso', 'tbl_pesadafinal.ePesoProd as pesoP')
      ->where('tbl_ciclo.eCodFlujo',1)
          ->where('tbl_ciclo.eCodReg',$id)
      ->get();

      //Salida
      $salida = \DB::table('tbl_salida')
      ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_salida.eCodCiclo')
      ->select('tbl_salida.dFechaSalida as fecha', 'tbl_salida.dHoraSalida as hora', 'tbl_salida.aObservaciones as obs', 'tbl_salida.eCodCiclo as ciclo')
      ->where('tbl_ciclo.eCodFlujo',1)
          ->where('tbl_ciclo.eCodReg',$id)
      ->get();
      //dd($hLimpieza);
      return view ('admin.recepcionMP.detallesMP')->with('ciclo',$ciclo)->with('ingreso',$ingreso)->with('hcarga',$hcarga)->with('hLimpieza',$hLimpieza)->with('apro',$apro)->with('PI',$PI)->with('insp',$insp)->with('carga',$carga)->with('pesoS',$pesoS)->with('salida',$salida);
    }

    public function reporteMP(){
      $placa = Camion::all()->where('aEstado','A');
      $camion = Proveedor::all()->where('aEstado','A');
      
      return view('admin.reportes.recepcionMP.buscarMP')->with('camion',$camion)-> with('placa',$placa);

    }
    public function showReport($desde, $hasta, $idPro, $idCamion){
      $mp = \DB::table('tbl_clienteproducto')
            ->join('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
            ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
            ->join('tbl_proveedor','tbl_ciclo_cliente.eCodCliente','=','tbl_proveedor.eCodReg')
            ->select('tbl_ciclo.dFechaLLegada as fecha','tbl_clienteproducto.aNumDoc as doc','tbl_clienteproducto.aNumTransaccion as tran',
            'tbl_clienteproducto.eTipoProducto as tipo','tbl_clienteproducto.aNumEntidad as entidad','tbl_ciclo.aTicket as ticket',
            'tbl_proveedor.aRazonSocial as cliente','tbl_ciclo.aPlacaCamion as placa','tbl_ciclo.aNombreChofer as chofer',
            'tbl_clienteproducto.aNombreProducto as producto','tbl_clienteproducto.aNumGuia as guia',
            'tbl_clienteproducto.codigo as codigo', 'tbl_clienteproducto.aLote as lote', 'tbl_clienteproducto.bodega_transaccion as bodega', 'tbl_clienteproducto.dcto_resp as dcto',
            'tbl_clienteproducto.observacion as obs', 'tbl_clienteproducto.eSacos as sacos')
            ->whereBetween('tbl_ciclo.dFechaLLegada',[$desde,$hasta])
            ->where('tbl_proveedor.eCodReg',$idPro)
            ->where('tbl_clienteproducto.eTipoProducto', 'MP')
            ->get();
            //dd($mp);
            return view ('admin.reportes.recepcionMP.reporteMP')->with('mp',$mp);
    }
    public function ExcelMP(Request $request)
    {
     Excel::create('NovaCD', function($excel) use($request){
       $excel->sheet('ControlLotesDespacho',function($sheet) use($request){
        $mp = \DB::table('tbl_clienteproducto')
            ->join('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
            ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
            ->join('tbl_proveedor','tbl_ciclo_cliente.eCodCliente','=','tbl_proveedor.eCodReg')
            ->select('tbl_ciclo.dFechaLLegada as fecha','tbl_clienteproducto.aNumDoc as doc','tbl_clienteproducto.aNumTransaccion as tran',
            'tbl_clienteproducto.eTipoProducto as tipo','tbl_clienteproducto.aNumEntidad as entidad','tbl_ciclo.aTicket as ticket',
            'tbl_proveedor.aRazonSocial as cliente','tbl_ciclo.aPlacaCamion as placa','tbl_ciclo.aNombreChofer as chofer',
            'tbl_clienteproducto.aNombreProducto as producto','tbl_clienteproducto.aNumGuia as guia',
            'tbl_clienteproducto.codigo as codigo', 'tbl_clienteproducto.aLote as lote', 'tbl_clienteproducto.bodega_transaccion as bodega', 'tbl_clienteproducto.dcto_resp as dcto',
            'tbl_clienteproducto.observacion as obs', 'tbl_clienteproducto.eSacos as sacos')
            ->whereBetween('tbl_ciclo.dFechaLLegada',[$request->fd,$request->fh])
            ->where('tbl_proveedor.eCodReg',$request->aPlaca)
            ->where('tbl_clienteproducto.eTipoProducto', 'MP')
            ->get();
             $sheet->loadView('admin.reportes.recepcionMp.excelMP',['mp'=>$mp]);
       });
     })->export('xls', [
     'Set-Cookie'  => 'fileDownload=true;'
]);
    }
}
