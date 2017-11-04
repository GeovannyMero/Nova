<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection as Collection;
use App\Modelos\Opcion;
use App\Modelos\Sistema;


class OpcionController extends Controller
{
    public function index(){
    	$sistema = \DB::table('tbl_opcion')
    	->join('Tbl_sistema','Tbl_sistema.eCodReg','=','tbl_opcion.eCodSistema')
    	->select('tbl_opcion.eCodReg','tbl_sistema.aNombre as siste','tbl_opcion.aNombre','tbl_opcion.aEstado')
    	->get();
       	 $opcion = Opcion::all();
    	// dd(\DB::table('tbl_opcion')->join('Tbl_sistema','Tbl_sistema.eCodReg','=','tbl_opcion.eCodSistema')->select('Tbl_sistema.aNombre as siste','tbl_opcion.aNombre')->get());
    	return view('admin.seguridad.opciones.listarOpciones')->with('sistema',$sistema)->with('opcion',$opcion);
    }
       public function create(){
    	 $sistema = Sistema::all();
    
    	return view('admin.seguridad.opciones.registrarOpcion')->with('sistema',$sistema);
    }
     public function store(Request $request){
    	if($request->eCodReg == '')
    	{
    		$opcion = new Opcion;
    	}else{
    			$opcion = Opcion::find($request->eCodReg);
    		}

    	//$this->validator($request->all())->validate();
    	$opcion->aNombre = $request->aNombreO;
		$opcion->eCodSistema = $request->aNombre;
		$opcion->aEstado= $request->aEstado;

    	if($opcion->save())

    		Session::flash('message', 'Opción registrado con exito');
    	
    	return redirect('/opciones');

    }
     public function edit($id){
        $opcion = Opcion::find($id);
         
       $sistema = Sistema::all();
        return  view ('admin.seguridad.opciones.registrarOpcion')->with('opcion',$opcion)->with('sistema',$sistema);
    }
       
}
