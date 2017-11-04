<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection as Collection;
use App\Modelos\Perfil;

class PerfilController extends Controller
{
	//presenta toda la lista de ls perfiles
    public function index(){
    	$perfil = Perfil::all();
    	return view ('admin.listarPerfiles')->with('perfil',$perfil);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'aNombre' => 'required|max:255|unique:tbl_perfil',          
        ]);
    }


    //nos envia a la ventana de registro perfil
    public function create(){
    return view('admin.registrarperfil');
    }
    // guarda los perfiles
   public function store(Request $request){
    	if($request->eCodReg == '')
    	{
    		$perfil = new Perfil;
    	}else{
    			$perfil = Perfil::find($request->eCodReg);
    		}

    	//$this->validator($request->all())->validate();

    	$perfil->aNombre = $request->aNombre;
        $perfil->eCodExtProduc = $request->$eCodExtProduc;
    	$perfil->aUserCreated ='ge';
    	$perfil->aUserUpdate = 'geo';
    	$perfil->dDateCreate =  date("Y-m-d H:i:s") ;
    	$perfil->dDateUpdate = date("Y-m-d H:i:s");
    	$perfil->aEstado = 'A';


    	if($perfil->save())
    		Session::flash('message', 'Perfil registrado con exito');
    	
    	return redirect('/perfiles');

    }
}
