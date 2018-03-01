<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection as Collection;
use App\Modelos\Camion;
use App\Modelos\Cliente;
use App\Modelos\CicloCliente;
use App\Modelos\Producto;
use App\Modelos\ClienteProducto;
use App\Modelos\Ciclo;
use Carbon\Carbon;
use Datatables;


class DespachoClienteController extends Controller
{
  //pantalla de Busqueda
    public function index(){
    //  dd(Ciclo::find(1)->Ingreso());
      $camion = \DB::table('tbl_camion')
      ->join('tbl_ciclo','tbl_ciclo.eCodCamion','=','tbl_camion.eCodReg')
      ->where('tbl_camion.aEstado','A')
      ->select('tbl_camion.eCodReg as eCodReg', 'tbl_camion.aPlaca as placa', 'tbl_ciclo.aTicket as ticket')
      ->get();
     // dd($camion);
      $cliente = Cliente::where('aEstado','A')->get();
        	return view('admin.DespachoCliente.buscar')->with('camion',$camion)->with('cliente',$cliente);
    }

      //muestra datos de la busqueda
    public function create($desde, $hasta, $placa ,$apro ){
//     dd($apro);

        $camion = Camion::all();
        $cliente = Cliente::all();
        if($placa <> 0 && $apro == 'null' ){
//dd('1');
          $ciclo1= \DB::table('tbl_ciclo')
         // ->join('tbl_aprobacion', 'tbl_aprobacion.eCodCiclo','=','tbl_ciclo.eCodReg')
          ->join('tbl_camion','tbl_camion.eCodReg','=','tbl_ciclo.eCodCamion')
          ->join('tbl_chofer','tbl_chofer.eCodReg','=','tbl_ciclo.eCodChofer')

          ->select('tbl_ciclo.eCodReg as cod','tbl_camion.aPlaca','tbl_chofer.eCodReg as eCodChofer','tbl_chofer.aNombre','tbl_chofer.aCompaTrans as cia')
          ->where('tbl_ciclo.eCodCamion',$placa)
        //  ->where('tbl_aprobacion.aResultado',$apro)
          ->get();
        }elseif ($placa <> 0 && $apro <> 'null') {
//dd('2');
          $ciclo1= \DB::table('tbl_ciclo')
          ->join('tbl_aprobacion', 'tbl_aprobacion.eCodCiclo','=','tbl_ciclo.eCodReg')
          ->join('tbl_camion','tbl_camion.eCodReg','=','tbl_ciclo.eCodCamion')
          ->join('tbl_chofer','tbl_chofer.eCodReg','=','tbl_ciclo.eCodChofer')

          ->select('tbl_ciclo.eCodReg as cod','tbl_camion.aPlaca','tbl_chofer.eCodReg as eCodChofer','tbl_chofer.aNombre','tbl_chofer.aCompaTrans as cia')
          ->where('tbl_ciclo.eCodCamion',$placa)
          ->where('tbl_aprobacion.aResultado',$apro)
          ->get();
        }
        elseif($placa == 0 && $apro == 'null'){
          //dd('3');
          $ciclo1= \DB::table('tbl_ciclo')
          ->join('tbl_camion','tbl_camion.eCodReg','=','tbl_ciclo.eCodCamion')
          ->join('tbl_chofer','tbl_chofer.eCodReg','=','tbl_ciclo.eCodChofer')
          ->join('tbl_aprobacion', 'tbl_aprobacion.eCodCiclo','=','tbl_ciclo.eCodReg')
          ->select('tbl_ciclo.eCodReg as cod','tbl_camion.aPlaca','tbl_chofer.eCodReg as eCodChofer',
          'tbl_chofer.aNombre','tbl_chofer.aCompaTrans as cia','tbl_aprobacion.aResultado as estado')
          //->where('tbl_ciclo.eCodCamion',$placa)
          ->get();
        }else{
          //dd('4');
          $ciclo1= \DB::table('tbl_ciclo')
          ->join('tbl_camion','tbl_camion.eCodReg','=','tbl_ciclo.eCodCamion')
          ->join('tbl_chofer','tbl_chofer.eCodReg','=','tbl_ciclo.eCodChofer')
          ->join('tbl_aprobacion', 'tbl_aprobacion.eCodCiclo','=','tbl_ciclo.eCodReg')
          ->select('tbl_ciclo.eCodReg as cod','tbl_camion.aPlaca','tbl_chofer.eCodReg as eCodChofer','tbl_chofer.aNombre','tbl_chofer.aCompaTrans as cia')
          ->get();
        }

//dd($ciclo1);

       return view('admin.DespachoCliente.despachoCliente')->with('camion',$camion)->with('cliente',$cliente)->with('ciclo1',$ciclo1);
        }



      public function producto($idCliente,$idCiclo){
      //  dd($idCiclo);
        $producto = Producto::where('aTipo','Producto')->get();
        $cliente = Cliente::where('eCodReg',$idCliente)->first();
        //dump($cliente);
        $ciclo=CicloCliente::where('eCodCiclo',$idCiclo)->first();
     // dd($ciclo->eCodReg);
        if(count($ciclo->eCodReg)>0){
          $prod = \DB::table('tbl_clienteproducto')
          ->join('tbl_ciclo_cliente','tbl_ciclo_cliente.eCodReg','=','tbl_clienteproducto.eCodCicloCliente')
          //->join('tbl_producto','tbl_producto.eCodReg','=','tbl_clienteproducto.eCodProducto')
          ->select('tbl_clienteproducto.codigo as eCodProducto','tbl_clienteproducto.aNombreProducto as aNombreProducto', 'tbl_clienteproducto.eSacos as eSacos','tbl_clienteproducto.ePesoPT as ePesoPT')
          ->where('tbl_ciclo_cliente.eCodCiclo',$idCiclo)
          ->where('tbl_ciclo_cliente.eCodCliente',$idCliente)
          ->where('tbl_clienteproducto.eTipoProducto', 'PT')
          ->get();
         // dd($prod);


        }
        return view ('admin.DespachoCliente.ingresoProducto')->with('producto',$producto)->with('cliente',$cliente)->with('prod',$prod);
    }

    public function storeProducto(Request $request){
       //dd($request->all());
        if($request->eCodReg != ''){
          $clienteProd = new ClienteProducto;
          $id = CicloCliente::where('eCodCliente',$request->eCodReg)->first();
        // dd($id->eCodReg);
          $clienteProd->eCodCicloCliente =  $id->eCodReg;
          $clienteProd->eCodProducto = $request->aNombre;
          $clienteProd->eSacos = $request->sacos;
          $clienteProd->ePesoPT = $request->peso;

          if($clienteProd->save()){
            return redirect('/despachoCliente');
          }



        }

       /*$arr = $request->aNombre;
       $flag = false;
       $cicloCliente =0;

       $idCliente = $request->eCodReg;
       $producto = Producto::all();
        $cliente = Cliente::where('eCodReg',$idCliente)->get()->first();
        $ciclo=CicloCliente::select('eCodReg')->where('eCodCliente',$idCliente)->get()->toArray();
        if(count($ciclo)>0){
            $prod = (ClienteProducto::where('eCodCicloCliente',$ciclo)->get());
          //  dd(Producto::select('aNombre')->whereIn('eCodReg',$prod)->get());

        }
       if(count($arr)>0){
             $cicloCliente =1;
        for($i=0;$i<count($arr);$i++){
            $clienteProducto = ClienteProducto::where('eCodcicloCliente',$cicloCliente)->get()->first();
            if($clienteProducto == null){
                $clienteProducto = new clienteProducto;
            }
            $clienteProducto->eCodCicloCliente = $cicloCliente;
            $clienteProducto->eCodProducto = $arr;
            if($clienteProducto->save())
                $flag = true;
        }
        if($flag)
            Session::flash('message', 'Producto agragado con éxito');
        else
             Session::flash('warning', 'Ocurrio un problema al agregar los productos');

         $url = '/Inproducto/'.$cicloCliente;
       }
       //return redirect('/clientesDespacho');
        return view ('admin.DespachoCliente.ingresoProducto')->with('producto',$producto)->with('cliente',$cliente)->with('prod',$prod);
    */
    }


    public function store(Request $request){
       // dd($request->eCodReg);
       /* */$arr = $request->aClientes;
        $flag = false;
        $ciclo = 0;
       // if(count($arr) > 0){
            // Traer el ciclo
            $ciclo = $request->eCodReg;
            for($i=0;$i<count($arr);$i++){
                //$cliente = Cliente::where('eCodReg',$arr[$i])->get();
                $cicloCliente = CicloCliente::where('eCodCiclo',$ciclo)->where('eCodCliente',$arr[$i])->get()->first();
                if($cicloCliente == null){
                    $cicloCliente = new CicloCliente;
                }
                $cicloCliente->eCodCiclo = $ciclo;
                $cicloCliente->eCodCliente = $arr[$i];

                if($cicloCliente->save())
                    $flag = true;
            }
       // }


        if($flag)
            Session::flash('message', 'Cliente agragado con éxito');
        else
            Session::flash('warning', 'Ocurrio un problema al agregar los clientes');

        $url = '/despachoCliente/';


        return redirect($url);
    }

    function search($fecha,$placa,$ticket){

    $clienteDespacho = collect();
    $clienteCliclo = collect();
    $camion = Camion::select('aPlaca')->where('eCodReg',$placa)->get()->first();

    $ciclo= Ciclo::select('eCodReg')->where('aTicket',$ticket)->where('aPlacaCamion',$placa)->get()->first();

      return  redirect ('/despachoCliente/' + 1);

    }

    function detallesPT($id){
      $ciclo = \DB::table('tbl_ciclo')
      ->join('tbl_camion','tbl_camion.eCodReg','tbl_ciclo.eCodCamion')
      ->join('tbl_chofer','tbl_chofer.eCodReg','tbl_ciclo.eCodChofer')
      ->select('tbl_ciclo.eCodReg', 'tbl_ciclo.dFechaLLegada as fecha','tbl_ciclo.dHoraLLegada as hora',
       'tbl_ciclo.aTicket as ticket', 'tbl_camion.aPlaca as placa', 'tbl_chofer.aNombre','tbl_ciclo.aCedulaChofer as cedula')
      ->where('tbl_ciclo.eCodReg',$id)
      ->where('tbl_ciclo.eCodFlujo',2)
      ->get();
//dd($ciclo);
      //Ingreso
    /*  $ingreso = \DB::table('tbl_ingreso')
      ->join('tbl_ciclo','tbl_ciclo.eCodReg','tbl_ingreso.eCodCiclo')
      ->where('tbl_ciclo.eCodReg',$id)
      ->where('tbl_ciclo.eCodFlujo',2)
      ->get();*/
      $ingreso = Ciclo::find($id)->Ingreso();
      dd(Datatables::of($ingreso)->make(true));

      //Aprbacion
      $apro = \DB::table('tbl_aprobacion')
      ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_aprobacion.eCodCiclo')

      ->select('tbl_aprobacion.eCodReg','tbl_aprobacion.aAprobacionFinan as bfina','tbl_aprobacion.aAprobFinanObservaciones as fina','tbl_aprobacion.aProduccionCalidad as bpro',
        'tbl_aprobacion.aProduccionCalidadObservaciones as pro','tbl_aprobacion.aLogistica as blog', 'tbl_aprobacion.aLogisticaObservaciones as log')
      ->where('tbl_ciclo.eCodReg',$id)
      ->where('tbl_ciclo.eCodFlujo',2)
      ->get();

      //pesada inicial
      $PI = \DB::table('tbl_pesadainicial')
      ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_pesadainicial.eCodCiclo')
      ->select('tbl_pesadainicial.dHoraPesadaIni as hora','tbl_pesadainicial.aNoTicketPI as ticket','tbl_pesadainicial.ePesoInicial as peso','tbl_pesadainicial.eNumeroPedido as pedido',
        'tbl_pesadainicial.dFechaPesadaIni as fecha','tbl_ciclo.eCodReg')
      ->where('tbl_ciclo.eCodReg',$id)
      ->where('tbl_ciclo.eCodFlujo',2)
      ->get();

//inspeccion
      $insp = \DB::table('tbl_inspeccion')
      ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_inspeccion.eCodCiclo')
      ->select('tbl_inspeccion.dFechaInspeccion as fecha', 'tbl_inspeccion.aCubierto', 'tbl_inspeccion.aLona', 'tbl_inspeccion.aDesinfeccion',
        'tbl_inspeccion.aLimpieza', 'tbl_inspeccion.aInsectos', 'tbl_inspeccion.aContaminantes', 'tbl_inspeccion.aObservaciones', 'tbl_inspeccion.aResultado',
        'tbl_ciclo.eCodReg')
      ->where('tbl_ciclo.eCodFlujo',2)
          ->where('tbl_ciclo.eCodReg',$id)
      ->get();

      //carga
      $carga = \DB::table('tbl_movimiento')
      ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_movimiento.eCodCiclo')
      ->where('tbl_ciclo.eCodFlujo',2)
          ->where('tbl_ciclo.eCodReg',$id)
      ->get();

      //peso de salida
      $pesoS = \DB::table('tbl_pesadafinal')
      ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_pesadafinal.eCodCiclo')
      ->select('tbl_ciclo.eCodReg', 'tbl_pesadafinal.dFechaPesada as fecha', 'tbl_pesadafinal.dHoraPesada as hora', 'tbl_pesadafinal.aNoTicketPF as ticket','tbl_pesadafinal.ePesoFinal as peso', 'tbl_pesadafinal.ePesoProd as pesoP')
      ->where('tbl_ciclo.eCodFlujo',2)
          ->where('tbl_ciclo.eCodReg',$id)
      ->get();

      //Salida
      $salida = \DB::table('tbl_salida')
      ->join('tbl_ciclo','tbl_ciclo.eCodReg','=','tbl_salida.eCodCiclo')
      ->select('tbl_salida.dFechaSalida as fecha', 'tbl_salida.dHoraSalida as hora', 'tbl_salida.aObservaciones as obs', 'tbl_salida.eCodCiclo as ciclo')
      ->where('tbl_ciclo.eCodFlujo',2)
          ->where('tbl_ciclo.eCodReg',$id)
      ->get();
    // dd($salida);
      return view('admin.DespachoCliente.detallesPT')->with('ciclo',$ciclo)->with('ingreso',$ingreso)->with('apro',$apro)->with('PI',$PI)->with('insp',$insp)->with('carga',$carga)->with('pesoS',$pesoS)->with('salida',$salida);

    }
}
