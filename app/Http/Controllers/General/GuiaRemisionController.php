<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\HistorialCarga;
use App\Modelos\Camion;
use App\Modelos\Cliente;
use App\Modelos\Ciclo;
use App\Modelos\CicloCliente;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class GuiaRemisionController extends Controller
{
    //
    public function index(){
        $camion = Camion::all()->where('aEstado','A');
        $cliente = Cliente::all();
        $guia = \DB::table('tbl_historialcarga')
         ->join('tbl_ciclo','tbl_ciclo.eCodReg','tbl_historialcarga.eCodCiclo')
         ->select('tbl_ciclo.dFechaLLegada as fecha', 'tbl_ciclo.aPlacaCamion as placa',
            'tbl_ciclo.dHoraLLegada as horaI')
         ->get();

    	return view ('admin.guiaRemision.buscar')->with('camion',$camion)->with('cliente',$cliente)->with('guia',$guia);
    }

    public function create ($id){

        return view ('admin.guiaRemision.selecionaArchivo')->with('id',$id);
    }
    public function guia($id){
        $camion = Camion::all();
        $cliente = Cliente::all();
        $guia = \DB::table('tbl_historialcarga')
         ->join('tbl_ciclo','tbl_ciclo.eCodReg','tbl_historialcarga.eCodCiclo')
         ->join('tbl_camion','tbl_camion.eCodReg','=','tbl_ciclo.eCodCamion')
         ->join('tbl_chofer','tbl_chofer.eCodReg','=','tbl_ciclo.eCodChofer')
         ->select('tbl_ciclo.eCodReg','tbl_ciclo.dFechaLLegada as fecha', 'tbl_ciclo.aPlacaCamion as placa',
            'tbl_ciclo.dHoraLLegada as horaI','tbl_chofer.aNombre as nombre')
         ->where('tbl_historialcarga.eCodCiclo',$id)
         ->get();


        return view ('admin.guiaRemision.guia')->with('camion',$camion)->with('cliente',$cliente)->with('guia',$guia);

    }
    public function showg($desde, $hasta, $idCliente)
    {
       // dd($desde);
        /*$fecha = $request->input('fd');
        $placa = $request->input('aPlaca');
        $camion = Camion::where('eCodReg',$placa)->select('aPlaca')->get()->toArray();*/
        $ciclo =\DB::table('tbl_ciclo')
        ->join('tbl_salida','tbl_salida.eCodCiclo' ,'=','tbl_ciclo.eCodReg' )
        ->where('tbl_ciclo.eCodCamion',$idCliente)
        ->whereBetween('dFechaLLegada',array($desde,$hasta))
        ->get();
   //dd($ciclo);
        return view ('admin.guiaRemision.ciclo')->with('ciclo',$ciclo);
    }

    public function store(Request $request){
       // dd($request->import_file->getSize() / 1024 / 1024);
    	//$historialCarga = new HistorialCarga();
    	//$historialCarga->eCodIngreso = 1;

      // $historialCarga->mime = $request->import_file->getClientMimeType();
       //$historialCarga->aNombreFile = $request->import_file->getClientOriginalName();
       // dd($request->eCodReg);
      //dd($request->import_file->getClientMimeType());
        if(Input::hasFile('import_file')){
            if(($request->import_file->getClientMimeType() == 'image/jpeg') || ($request->import_file->getClientMimeType() == 'image/png')  ){
               if(($request->import_file->getSize() / 1024 / 1024) < 1.5){
                   $contenidoImagen = file_get_contents($request->import_file);
                   $imagenBase64 = base64_encode($contenidoImagen);

                 \DB::table('tbl_historialcarga')->where('eCodReg',$request->eCodReg)->update(['aGuiaRemisionFoto' => $imagenBase64]);
                     Session::flash('message', 'Éxito al subir guia de remisión');
                     return redirect('/guia/'. $request->eCodReg);
               }else{
                Session::flash('warning', '<strong>Error:</strong> archivo sobrepasa el limite');
                  return redirect('/guia/'. $request->eCodReg);
               }

            }else{
                 Session::flash('warning', 'Error al subir Guia tipo de formato incorrecto');
             return redirect('/guia/'. $request->eCodReg);
            }

        }else{
            Session::flash('warning', 'Error al subir Guia ningun archivo seleccionado');
             return redirect('/guia/'. $request->eCodReg);
        }





    }

    public function show($id){
       $hCarga = HistorialCarga::where('eCodReg',$id)->get()->first();
       return  "</br><center><img  style =' max-width: 100%;
    height: auto;' border=0 src='data:image/jpg;base64,".$hCarga->aGuiaRemisionFoto."' /></center>";

  //  return view('admin.guiaRemision.imagen')->with('hCarga',$hCarga);
    }
}
