<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection as Collection;
use App\Modelos\Cliente;
use Barryvdh\DomPDF\Facade as PDF;
use Excel;

use App;
use App\Modelos\Llegada;
use App\Modelos\Ingreso;
use App\Modelos\Salida;
use App\Modelos\Ciclo;
use App\Modelos\PesadaFinal;
use App\Modelos\ClienteProducto;
use Carbon;
class ReportesController extends Controller
{
    //
    public function IndexDespacho(){

    	/**/$camion = Cliente::all()->where('aEstado','A');
    	return view ('admin.reportes.despacho')->with('camion',$camion);
    	/* $pdf = PDF::loadView('admin.email');
   		 return $pdf->download('prueba.pdf');*/
    }

    //convierte a pdf
  public function VerDespacho(){
    $salida = Salida::select('dFechaSalida')->get();

        $cliente = \DB::table('tbl_ciclo')
      ->join('tbl_llegada','tbl_llegada.eCodCiclo','=','tbl_ciclo.eCodReg')
      ->join('tbl_clientes','tbl_clientes.eCodReg','=','tbl_llegada.eCodCliente')
      ->join('tbl_ingreso','tbl_ingreso.eCodCiclo','=','tbl_ciclo.eCodReg')
      ->join('tbl_salida','tbl_salida.eCodCiclo','=','tbl_ciclo.eCodReg')
      ->join('tbl_pesadafinal','tbl_pesadafinal.eCodCiclo','=','tbl_ciclo.eCodReg')
      ->join('tbl_pesadainicial','tbl_pesadainicial.eCodCiclo','=','tbl_ciclo.eCodReg')
      ->select('tbl_ciclo.eCodReg','tbl_llegada.dFechaLLegada as fecha','tbl_ingreso.hHoraIngreso as hora','tbl_clientes.aNombre as clie','tbl_salida.dFechaSalida as salida', 'tbl_pesadafinal.eCantidadSacos as sacos','tbl_pesadafinal.dFechaPesada as pesadafinal','tbl_clientes.eCodReg','tbl_ciclo.aPlacaCamion as placa','tbl_ciclo.aNombreChofer as chofer','tbl_pesadainicial.dHoraPesada as pesadainicial','tbl_pesadafinal.ePesoProd as peso')
      ->get();
     $pdf = App::make('dompdf.wrapper');
	   $pdf->loadView('admin.reportes.reporteDespacho' ,['cliente'=>$cliente])->setPaper('a3', 'landscape')->setWarnings(false);
	   return $pdf->stream('Despacho.pdf');
  }

//exporta a excel
  public function ExcelDespacho(Request $request){

    Excel::create('NovaCD', function($excel) use($request)  {
      $excel->setTitle('Our new awesome title');
      $excel->sheet('Despacho', function($sheet) use($request) {
        if($request->aPlaca <> 0)
        {
          $cliente = ClienteProducto::join('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
          ->join('tbl_clientes','tbl_clientes.eCodReg','=','tbl_ciclo_cliente.eCodCliente')
          ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
          ->join('tbl_ingreso','tbl_ingreso.eCodCiclo','=','tbl_ciclo.eCodReg')
          ->join('tbl_salida','tbl_salida.eCodCiclo','=','tbl_ciclo.eCodReg')
          ->join('tbl_pesadafinal','tbl_pesadafinal.eCodCiclo','=','tbl_ciclo.eCodReg')
          ->join('tbl_pesadainicial','tbl_pesadainicial.eCodCiclo','=','tbl_ciclo.eCodReg')
          ->select('tbl_ciclo.eCodReg','tbl_ciclo.dFechaLLegada as fecha',
          'tbl_ingreso.hHoraIngreso as hora',
          'tbl_salida.dFechaSalida as salida', 'tbl_clienteproducto.eSacos as sacos',
          'tbl_pesadafinal.dFechaPesada as pesadafinal',
          'tbl_ciclo.aPlacaCamion as placa','tbl_ciclo.aNombreChofer as chofer',
          'tbl_pesadainicial.dHoraPesadaIni as pesadainicial','tbl_pesadafinal.ePesoProd as peso',
          'tbl_clienteproducto.eTipoProducto as tipo', 'tbl_clienteproducto.aNumDoc as doc',
          'tbl_clienteproducto.aNumTransaccion as trans', 'tbl_clienteproducto.aNumEntidad as entidad',
          'tbl_clienteproducto.aNumGuia as guia','tbl_ciclo.aTicket as ticket', 'tbl_clienteproducto.aNumGuia as guia',
          'tbl_clientes.aNombre as cliente' , 'tbl_ciclo.dHoraLLegada as horaLL')
          ->whereBetween('tbl_ciclo.dFechaLLegada',[$request->fd,$request->fh])
          ->where('tbl_clientes.eCodReg',$request->aPlaca)
          ->where('tbl_clienteproducto.eTipoProducto', 'PT')
          ->get();


          $sheet->loadView('admin.reportes.excelReporteDespacho' ,['cliente'=>$cliente]);

        }
        else
          {
            $cliente = ClienteProducto::join('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
            ->join('tbl_clientes','tbl_clientes.eCodReg','=','tbl_ciclo_cliente.eCodCliente')
            ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
            ->join('tbl_ingreso','tbl_ingreso.eCodCiclo','=','tbl_ciclo.eCodReg')
            ->join('tbl_salida','tbl_salida.eCodCiclo','=','tbl_ciclo.eCodReg')
            ->join('tbl_pesadafinal','tbl_pesadafinal.eCodCiclo','=','tbl_ciclo.eCodReg')
            ->join('tbl_pesadainicial','tbl_pesadainicial.eCodCiclo','=','tbl_ciclo.eCodReg')
            ->select('tbl_ciclo.eCodReg','tbl_ciclo.dFechaLLegada as fecha',
            'tbl_ingreso.hHoraIngreso as hora',
            'tbl_salida.dFechaSalida as salida', 'tbl_clienteproducto.eSacos as sacos',
            'tbl_pesadafinal.dFechaPesada as pesadafinal',
            'tbl_ciclo.aPlacaCamion as placa','tbl_ciclo.aNombreChofer as chofer',
            'tbl_pesadainicial.dHoraPesadaIni as pesadainicial','tbl_pesadafinal.ePesoProd as peso',
            'tbl_clienteproducto.eTipoProducto as tipo', 'tbl_clienteproducto.aNumDoc as doc',
            'tbl_clienteproducto.aNumTransaccion as trans', 'tbl_clienteproducto.aNumEntidad as entidad',
            'tbl_clienteproducto.aNumGuia as guia','tbl_ciclo.aTicket as ticket', 'tbl_clienteproducto.aNumGuia as guia',
            'tbl_clientes.aNombre as cliente' , 'tbl_ciclo.dHoraLLegada as horaLL')
            ->whereBetween('tbl_ciclo.dFechaLLegada',[$request->fd,$request->fh])
            ->where('tbl_clienteproducto.eTipoProducto', 'PT')
            //->where('tbl_clientes.eCodReg',$request->aPlaca)
            ->get();


            $sheet->loadView('admin.reportes.excelReporteDespacho' ,['cliente'=>$cliente]);

            }




    });

})->export('xls');
}
  public function previaDespacho($desde, $hasta, $idCliente){

    if($idCliente <> 0 )
    {
        $cliente = \DB::table('tbl_clienteproducto')
        ->join('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
        ->join('tbl_clientes','tbl_clientes.eCodReg','=','tbl_ciclo_cliente.eCodCliente')
        ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
        ->join('tbl_ingreso','tbl_ingreso.eCodCiclo','=','tbl_ciclo.eCodReg')
        ->join('tbl_salida','tbl_salida.eCodCiclo','=','tbl_ciclo.eCodReg')
        ->join('tbl_pesadafinal','tbl_pesadafinal.eCodCiclo','=','tbl_ciclo.eCodReg')
        ->join('tbl_pesadainicial','tbl_pesadainicial.eCodCiclo','=','tbl_ciclo.eCodReg')
        ->select('tbl_ciclo.eCodReg','tbl_ciclo.dFechaLLegada as fecha',
        'tbl_ingreso.hHoraIngreso as hora',
        'tbl_salida.dFechaSalida as salida', 'tbl_clienteproducto.eSacos as sacos',
        'tbl_pesadafinal.dFechaPesada as pesadafinal',
        'tbl_ciclo.aPlacaCamion as placa','tbl_ciclo.aNombreChofer as chofer',
        'tbl_pesadainicial.dHoraPesadaIni as pesadainicial','tbl_clienteproducto.ePesoPT as peso',
        'tbl_clienteproducto.eTipoProducto as tipo', 'tbl_clienteproducto.aNumDoc as doc',
        'tbl_clienteproducto.aNumTransaccion as trans', 'tbl_clienteproducto.aNumEntidad as entidad',
        'tbl_clienteproducto.aNumGuia as guia','tbl_ciclo.aTicket as ticket', 'tbl_clienteproducto.aNumGuia as guia',
        'tbl_clientes.aNombre as cliente', 'tbl_ciclo.dHoraLLegada as horaLL')
        ->where('tbl_clienteproducto.eTipoProducto', 'PT')
        ->whereBetween('tbl_ciclo.dFechaLLegada', [$desde, $hasta])
        ->where('tbl_clientes.eCodReg',$idCliente)
        ->get();

        return view ('admin.reportes.vistaDespacho')->with('cliente',$cliente);

    }
    else
    {
        $cliente = \DB::table('tbl_clienteproducto')
        ->join('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
        ->join('tbl_clientes','tbl_clientes.eCodReg','=','tbl_ciclo_cliente.eCodCliente')
        ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_ciclo_cliente.eCodCiclo')
        ->join('tbl_ingreso','tbl_ingreso.eCodCiclo','=','tbl_ciclo.eCodReg')
        ->join('tbl_salida','tbl_salida.eCodCiclo','=','tbl_ciclo.eCodReg')
        ->join('tbl_pesadafinal','tbl_pesadafinal.eCodCiclo','=','tbl_ciclo.eCodReg')
        ->join('tbl_pesadainicial','tbl_pesadainicial.eCodCiclo','=','tbl_ciclo.eCodReg')
        ->select('tbl_ciclo.eCodReg','tbl_ciclo.dFechaLLegada as fecha',
        'tbl_ingreso.hHoraIngreso as hora',
        'tbl_salida.dFechaSalida as salida', 'tbl_clienteproducto.eSacos as sacos',
        'tbl_pesadafinal.dFechaPesada as pesadafinal',
        'tbl_ciclo.aPlacaCamion as placa','tbl_ciclo.aNombreChofer as chofer',
        'tbl_pesadainicial.dHoraPesadaIni as pesadainicial','tbl_clienteproducto.ePesoPT as peso',
        'tbl_clienteproducto.eTipoProducto as tipo', 'tbl_clienteproducto.aNumDoc as doc',
        'tbl_clienteproducto.aNumTransaccion as trans', 'tbl_clienteproducto.aNumEntidad as entidad',
        'tbl_clienteproducto.aNumGuia as guia','tbl_ciclo.aTicket as ticket', 'tbl_clienteproducto.aNumGuia as guia',
        'tbl_clientes.aNombre as cliente', 'tbl_ciclo.dHoraLLegada as horaLL')
        ->where('tbl_clienteproducto.eTipoProducto', 'PT')
        ->whereBetween('tbl_ciclo.dFechaLLegada', [$desde, $hasta])
        //->where('tbl_clientes.eCodReg',$idCliente)
        ->get();

        return view ('admin.reportes.vistaDespacho')->with('cliente',$cliente);

    }
     }



}
