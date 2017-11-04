<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Ciclo;
use App\Modelos\Camion;
use Barryvdh\DomPDF\Facade as PDF;
use App;
use Excel;
class PlacasChoferController extends Controller
{
    public function index(){

        $camion = Camion::all()->where('aEstado','A');
        return view('admin.reportes.PlacasChofer.buscarPlaca')->with('camion',$camion);
    }

        public function create($desde, $hasta, $placa){
          if($placa <> 0)
          {
             $res = \DB::table('tbl_clienteproducto')
            ->join('tbl_ciclo_cliente', 'tbl_ciclo_cliente.eCodReg', '=', 'tbl_clienteproducto.eCodCicloCliente')
            ->join('tbl_ciclo', 'tbl_ciclo.eCodReg', '=' ,'tbl_ciclo_cliente.eCodCiclo')
            ->join('tbl_camion', 'tbl_camion.eCodReg', '=', 'tbl_ciclo.eCodCamion')
            ->join('tbl_chofer','tbl_chofer.eCodCamion','=','tbl_camion.eCodReg')
            ->join('tbl_clientes', 'tbl_clientes.eCodReg', '=', 'tbl_ciclo_cliente.eCodCliente')
            ->join('tbl_salida', 'tbl_salida.eCodCiclo','=','tbl_ciclo.eCodReg')
            ->select('tbl_ciclo.dFechaLLegada as fechaI', 'tbl_camion.aPlaca as placa',
                'tbl_clientes.aNombre as cliente', 'tbl_clienteproducto.aNombreProducto as producto',
                'tbl_chofer.aNombre as chofer', 'tbl_ciclo.dHoraLLegada as horaI', 'tbl_salida.dFechaSalida as fechaS',
                'tbl_salida.dHoraSalida as horaS', 'tbl_chofer.aCompaTrans as cia')
           ->whereBetween('tbl_ciclo.dFechaLLegada', [$desde, $hasta])
            ->where('tbl_camion.eCodReg', $placa)
            ->where('tbl_chofer.aEstado','A')
            ->where('tbl_clienteproducto.eTipoProducto', 'PT')
            ->get();
            //dd($res);

            return view('admin.reportes.PlacasChofer.previaPlacasChofer')->with('res',$res);

          }
          else
          {
             $res = \DB::table('tbl_clienteproducto')
            ->join('tbl_ciclo_cliente', 'tbl_ciclo_cliente.eCodReg', '=', 'tbl_clienteproducto.eCodCicloCliente')
            ->join('tbl_ciclo', 'tbl_ciclo.eCodReg', '=' ,'tbl_ciclo_cliente.eCodCiclo')
            ->join('tbl_camion', 'tbl_camion.eCodReg', '=', 'tbl_ciclo.eCodCamion')
            ->join('tbl_chofer','tbl_chofer.eCodCamion','=','tbl_camion.eCodReg')
            ->join('tbl_clientes', 'tbl_clientes.eCodReg', '=', 'tbl_ciclo_cliente.eCodCliente')
           ->join('tbl_salida', 'tbl_salida.eCodCiclo','=','tbl_ciclo.eCodReg')
            ->select('tbl_ciclo.dFechaLLegada as fechaI', 'tbl_camion.aPlaca as placa',
                'tbl_clientes.aNombre as cliente', 'tbl_clienteproducto.aNombreProducto as producto',
                'tbl_chofer.aNombre as chofer', 'tbl_ciclo.dHoraLLegada as horaI', 'tbl_salida.dFechaSalida as fechaS',
                'tbl_salida.dHoraSalida as horaS', 'tbl_chofer.aCompaTrans as cia')
            ->whereBetween('tbl_ciclo.dFechaLLegada', [$desde, $hasta])
            ->where('tbl_clienteproducto.eTipoProducto', 'PT')
            //->where('tbl_camion.eCodReg', $placa)
            ->where('tbl_chofer.aEstado','A')
            ->get();
            //dd($res);

            return view('admin.reportes.PlacasChofer.previaPlacasChofer')->with('res',$res);
          }

        }





    public function show(){
    	$placachofer = Ciclo::all();


 	 $pdf = App::make('dompdf.wrapper');
	$pdf->loadView('admin.reportes.PlacasChofer.pdfPlacasChofer' ,['placachofer'=>$placachofer]);
	return $pdf->stream('PlacasChofer.pdf');
    }

    public function ExcelReporte(Request $request){
        //dd($request->all());
    	 Excel::create('NovaCD', function($excel)  use($request){

    $excel->sheet('PlacasChofer', function($sheet)  use($request) {
        if($request->aPlaca <> 0 )
        {
             $placachofer =  \DB::table('tbl_clienteproducto')
            ->join('tbl_ciclo_cliente', 'tbl_ciclo_cliente.eCodReg', '=', 'tbl_clienteproducto.eCodCicloCliente')
            ->join('tbl_ciclo', 'tbl_ciclo.eCodReg', '=' ,'tbl_ciclo_cliente.eCodCiclo')
            ->join('tbl_camion', 'tbl_camion.eCodReg', '=', 'tbl_ciclo.eCodCamion')
            ->join('tbl_chofer','tbl_chofer.eCodCamion','=','tbl_camion.eCodReg')
            ->join('tbl_clientes', 'tbl_clientes.eCodReg', '=', 'tbl_ciclo_cliente.eCodCliente') ->join('tbl_salida', 'tbl_salida.eCodCiclo','=','tbl_ciclo.eCodReg')
            ->select('tbl_ciclo.dFechaLLegada as fechaI', 'tbl_camion.aPlaca as placa',
                'tbl_clientes.aNombre as cliente', 'tbl_clienteproducto.aNombreProducto as producto',
                'tbl_chofer.aNombre as chofer', 'tbl_ciclo.dHoraLLegada as horaI', 'tbl_salida.dFechaSalida as fechaS',
                'tbl_salida.dHoraSalida as horaS', 'tbl_chofer.aCompaTrans as cia')
             ->whereBetween('tbl_ciclo.dFechaLLegada',[$request->fd,$request->fh])
            ->where('tbl_camion.eCodReg', $request->aPlaca)
             ->where('tbl_chofer.aEstado','A')
             ->where('tbl_clienteproducto.eTipoProducto', 'PT')
             ->get();

       $sheet->loadView('admin.reportes.PlacasChofer.excelPlacasChofer',['placachofer'=>$placachofer]);
        }
        else
        {
             $placachofer =  \DB::table('tbl_clienteproducto')
            ->join('tbl_ciclo_cliente', 'tbl_ciclo_cliente.eCodReg', '=', 'tbl_clienteproducto.eCodCicloCliente')
            ->join('tbl_ciclo', 'tbl_ciclo.eCodReg', '=' ,'tbl_ciclo_cliente.eCodCiclo')
            ->join('tbl_camion', 'tbl_camion.eCodReg', '=', 'tbl_ciclo.eCodCamion')
            ->join('tbl_chofer','tbl_chofer.eCodCamion','=','tbl_camion.eCodReg')
            ->join('tbl_clientes', 'tbl_clientes.eCodReg', '=', 'tbl_ciclo_cliente.eCodCliente')
           ->join('tbl_salida', 'tbl_salida.eCodCiclo','=','tbl_ciclo.eCodReg')
            ->select('tbl_ciclo.dFechaLLegada as fechaI', 'tbl_camion.aPlaca as placa',
                'tbl_clientes.aNombre as cliente', 'tbl_clienteproducto.aNombreProducto as producto',
                'tbl_chofer.aNombre as chofer', 'tbl_ciclo.dHoraLLegada as horaI', 'tbl_salida.dFechaSalida as fechaS',
                'tbl_salida.dHoraSalida as horaS', 'tbl_chofer.aCompaTrans as cia')
              ->whereBetween('tbl_ciclo.dFechaLLegada',[$request->fd,$request->fh])
              ->where('tbl_clienteproducto.eTipoProducto', 'PT')
           // ->where('tbl_camion.eCodReg', $request->aPlaca)
             ->where('tbl_chofer.aEstado','A')
             ->get();

       $sheet->loadView('admin.reportes.PlacasChofer.excelPlacasChofer',['placachofer'=>$placachofer]);
        }


    });

})->export('xls');
    }
}
