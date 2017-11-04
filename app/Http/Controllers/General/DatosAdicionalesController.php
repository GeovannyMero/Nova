<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Sql;
use App\Modelos\Ciclo;
use App\Modelos\Cliente;
use App\Modelos\CicloCliente;
use App\Modelos\ClienteProducto;


class DatosAdicionalesController extends Controller
{
    //
    public function index(){
    	return view('admin.CargarDatosAdicionales.datosAdicionales');
    }


public function store(Request $request){
//dd($request->all());
    if($request->tipo == 'PT'){
      //  dd('PT');
        if(Input::hasFile('import_file')){
        $path =  Input::file('import_file')->getRealPath();
        $data = Excel::load($path, function($reader)
        {
          $torarray = $reader->all();
          $t = $torarray->first()->keys()->toArray();
          //dd($t[1] == 'tipo');
        })->get();
//dd($data);
        if(!empty($data) && $data->count())
        {
          foreach ($data as $key=>$value)
          {
            $d = ($data->first()->keys()->toArray());
        // dd($d);
              if($d[0] == "fecha" && $d[1] == 'tipo' && $d[2] == 'doc_no' && $d[3] == 'tran_no' && $d[4] == 'no_entidad' && $d[5] == 'cliente_sistema' && $d[6] == 'ticket_peso' &&
              $d[7] == 'guia' && $d[8] == 'placa' && $d[9] == 'chofer' && $d[10] == 'codigo' && $d[11] == 'descripcion' && $d[12] == 'lote' && $d[13] == 'sacos' && $d[14] == 'pesokg' &&
              $d[15] == 'bodega_transaccion' && $d[16] == 'dcto_resp' && $d[17] == 'um' && $d[18] == 'observacion')
                {
                  if($value->ticket_peso <> ''){
                  //  dd('ok');
                    $codCi = (Ciclo::where('aTicket',$value->ticket_peso)->get()->first());
                  //  dd($codCi);
                    //dd(CicloCliente::where('eCodCiclo',$codCi->eCodReg)->get()->first());
                    //if(CicloCliente::where('eCodCiclo',$codCi->eCodReg)->get()->first() == false)
                      if(ClienteProducto::where('aNumDoc',$value->doc_no)->where('aLote',$value->lote)->get()->first() == false)
                      {
    //  dd(Ciclo::where('aTicket',$value->ticket_peso)->get()->first());
                          if(	\DB::insert("insert into tbl_ciclo_cliente (eCodCiclo, eCodCliente) select DISTINCT (select  distinct tbl_ciclo.eCodReg from tbl_ciclo where aticket =   '$value->ticket_peso'),   tbl_clientes.eCodReg   from tbl_clientes where eCodExtCliente =  '$value->no_entidad' ") == true)
                          {
                              $c = (Ciclo::where('aTicket',$value->ticket_peso)->get()->first());
                              $idC = CicloCliente::where('eCodCiclo',$c->eCodReg)->get()->first();
                              \DB::table('tbl_clienteproducto')->insert(['eCodCicloCliente'=>$idC->eCodReg,   'codigo' => $value->codigo ,'aNombreProducto' => $value->descripcion , 'eSacos' => $value->sacos, 'ePesoPT' => $value->pesokg , 'aNumDoc' => $value->doc_no , 'aNumTransaccion' => $value->tran_no, 'aNumEntidad' => $value->no_entidad, 'aNumGuia' => $value->guia , 'eTipoProducto' => 'PT', 'aLote' => $value->lote,
                              'bodega_transaccion' => $value->bodega_transaccion, 'dcto_resp' => $value->dcto_resp, 'um' => $value->um, 'observacion' => $value->observacion]);

                          Session::flash('message', 'Datos adicionales cargados con éxito');
                          }


                      }else{
                          Session::flash('warning', 'Datos adicionales ya existen');
                          }
                      }else{
                        Session::flash('warning', 'Formato incorrecto');
                        return redirect('/datosAdicionales');
                      }
                      }
                        }
                          }
                            return back();
                          }else{
                             Session::flash('warning', 'Seleccione un archivo');
                              return redirect('/datosAdicionales');
                            }
                          }else{
                              //MATERIA PRIMA
                              if(Input::hasFile('import_file')){
                              $path =  Input::file('import_file')->getRealPath();
                              $data = Excel::load($path, function($reader)
                              {
                                $torarray = $reader->all();
                                $t = $torarray->first()->keys()->toArray();
                                })->get();
                             // dd($data);
                                  if(!empty($data) && $data->count()){
                                      foreach ($data as $key=>$value){
                                          $d = ($data->first()->keys()->toArray());
                                         // dd($d);
                                          if($d[0] == 'fecha' && $d[1] == 'tipo' && $d[2] == 'doc_no' && $d[3] == 'tran_no' && $d[4] == 'no_entidad' && $d[5] == 'proveedor' && $d[6] == 'ticket_peso' &&
                                          $d[7] == 'placa' && $d[8] == 'chofer' && $d[9] == 'codigo' && $d[10] == 'descripcion' && $d[11] == 'lote' && $d[12] == 'sacos' && $d[13] == 'pesokg' &&
                                          $d[14] == 'humedad' && $d[15] == 'gran' && $d[16] == 'insectos' && $d[17] == 'densidad' && $d[18] == 'origen'&&
                                          $d[19] == 'bodega_transaccion' && $d[20] == 'dcto_resp' && $d[21] == 'um' &&  $d[22] == 'observacion' ){
                                         // dd('entro')  ;
                                            $codCi = (Ciclo::where('aTicket',$value->ticket_peso)->get()->first());
                                          //  dd($codCi);
                                            if(ClienteProducto::where('aNumDoc',$value->doc_no)->where('aLote',$value->lote)->get()->first() == false){
                                                if(	\DB::insert("insert into tbl_ciclo_cliente (eCodCiclo, eCodCliente) select DISTINCT (select  distinct tbl_ciclo.eCodReg from tbl_ciclo where aticket =   '$value->ticket_peso'),   tbl_proveedor.eCodReg   from tbl_proveedor where eCodExtProvee =  '$value->no_entidad' ") == true){

                                                  $c = (Ciclo::where('aTicket',$value->ticket_peso)->get()->first());
                                                  $idC = CicloCliente::where('eCodCiclo',$c->eCodReg)->get()->first();
                                                  \DB::table('tbl_clienteproducto')->insert(['eCodCicloCliente'=>$idC->eCodReg,   'codigo' => $value->codigo ,'aNombreProducto' => $value->descripcion , 'eSacos' => $value->sacos, 'ePesoPT' => $value->pesokg , 'aNumDoc' => $value->doc_no , 'aNumTransaccion' => $value->tran_no, 'aNumEntidad' => $value->no_entidad,
                                                  'eTipoProducto' => 'MP', 'aLote' => $value->lote, 'eHumedad' => $value->humedad, 'eGran' => $value->gran, 'aInsectos' => $value->insectos, 'eDensidad' => $value->densidad, 'aOrigen' => $value->origen,
                                                  'bodega_transaccion' => $value->bodega_transaccion, 'dcto_resp' => $value->dcto_resp, 'um' => $value->um, 'observacion' => $value->observacion]);
                                                //  return redirect('/datosAdicionales');
                                          return    Session::flash('message', 'Datos adicionales cargados con éxito');
                                                //  dd('Entro');
                                                }
                                            }else{
                                                Session::flash('warning', 'Datos adicionales ya existen');
                                                return redirect('/datosAdicionales');

                                            }
                                          }else{
                                            Session::flash('warning', 'Formato incorrecto');
                                            return redirect('/datosAdicionales');
                                          }


                                      }

                                  }
                            }else{
                              Session::flash('warning', 'Seleccione un archivo');
                               return redirect('/datosAdicionales');
                            }

                          }


}//endif

                      }
