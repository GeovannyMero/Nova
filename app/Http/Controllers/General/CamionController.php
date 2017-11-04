<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection as Collection;
use App\Modelos\Camion;
use App\Modelos\Estructura;


class CamionController extends Controller
{
    public function index(){
    	//$camion = Camion::all();
        $camion = \DB::table('tbl_camion')
            ->join('tbl_estructura','tbl_estructura.eCodReg','=','tbl_camion.eCodEstructura')
            ->select('tbl_camion.eCodReg','tbl_camion.aplaca as placa','tbl_camion.aMarca as marca','tbl_camion.aModelo as modelo','tbl_camion.aAnio as an','tbl_estructura.aNombre as estructura' ,'tbl_camion.aObservacion as observacion')
            ->where('tbl_camion.aEstado','A')
            ->get();
           //dd($camion);
    	return view ('admin.maestros.camion.listarCamion')->with('camion',$camion);
    }

     protected function validator(array $data)
    {
        return Validator::make($data, [
            'aPlaca' => 'required|max:7|unique:tbl_camion',
           // 'aMarca' => 'required',
            'eCodEstructura' => 'required',

        ],
      [
        'required' => 'Este campo es requerido',
      //  'eCodEstructura.required' => 'Este campo es requerido',
        //'aMarca.required' => 'Este campo es requerido',
        'unique' => 'Este campo ya existe',
      ]);
    }
    public function create(){
    	 $camion = new Camion;
         $estructura = Estructura::all();

    	return view('admin.maestros.camion.registrarCamion')->with('camion',$camion)->with('estructura',$estructura);
    }
    public function store(Request $request){

    	if($request->eCodReg == '')
    	{
    		$camion = new Camion;

    	}

    	$this->validator($request->all())->validate();
        //$cliente->eCodReg = $request->eCodReg;
   		$camion->aPlaca = $request->aPlaca;
   		$camion->aMarca = $request->aMarca;
   		$camion->aModelo = $request->aModelo;
   		$camion->aAnio =  $request->aAnio;
      $camion->aUserCreated = Auth::user()->name;
    	$camion->aUserUpdate = Auth::user()->name;
    	$camion->dDateCreate =  date("Y-m-d H:i:s") ;
    	$camion->dDateUpdate = date("Y-m-d H:i:s");
    	$camion->aEstado = 'A';
      $camion->eCodEstructura = $request->eCodEstructura;
      $camion->aObservacion = $request->aObservacion;

    	if($camion->save())


    	return Session::flash('message', 'Camión registrado con éxito');

    }
    public function update(Request $request){


      if($request->eCodReg <> ''){

          $camion = Camion::find($request->eCodReg);
      }

      //$this->validator($request->all())->validate();
        //$cliente->eCodReg = $request->eCodReg;
      $camion->aPlaca = $request->aPlaca;
      $camion->aMarca = $request->aMarca;
      $camion->aModelo = $request->aModelo;
      $camion->aAnio =  $request->aAnio;
      $camion->aUserCreated = Auth::user()->name;
      $camion->aUserUpdate = Auth::user()->name;
      $camion->dDateCreate =  date("Y-m-d H:i:s") ;
      $camion->dDateUpdate = date("Y-m-d H:i:s");
      $camion->aEstado = 'A';
      $camion->eCodEstructura = $request->eCodEstructura;
      $camion->aObservacion = $request->aObservacion;

      if($camion->save())


      return Session::flash('message', 'Camión actualizado con éxito');

    }
     public function edit($id){
        $camion = Camion::find($id);
        $camio = Camion::where('eCodReg',$id)->select('eCodEstructura')->get()->toArray();
       // dd($camio);
        $estructur = Estructura::where('eCodReg',$camio)->get()->first();
        $estructura = Estructura::all();
        //dd($estructur);
        return  view ('admin.maestros.camion.registrarCamion')->with('camion',$camion)->with('estructura',$estructura)->with('estructur',$estructur);
    }

     public function delete($id){
       if( \DB::table('tbl_camion')->where('eCodReg',$id)->update(['aEstado' => 'I']))
        //Session::flash('message', 'Conductor eliminado con exito');
      return  Session::flash('message', 'Camion eliminado con éxito');
    }

    public function getPlaca(){
      $camiones= Camion::all();
      return $this->showAll($camiones);
    }
}
