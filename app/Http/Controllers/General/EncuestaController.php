<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelos\Encuesta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection as Collection;
use App\Modelos\Cliente;
use Validator;

class EncuestaController extends Controller
{

    public function index(){
        $encuesta = \DB::table('tbl_clientevisit')
        ->join('tbl_clientes','tbl_clientes.eCodReg','=','tbl_clientevisit.eCodCliente')
         ->orderBy('aNombre', 'desc')
         //->orderBy('aMes', 'desc')
        ->get();
       // dd($encuesta);
        return view('admin.encuesta.listarEncuesta')->with('encuesta',$encuesta);
    }

      protected function validator(array $data)
    {
        return Validator::make($data, [
            'aMes' => 'required',
            'eCodCliente' => 'required',
            //'eCantidadVisiVen' => 'required',
            //'eCantidadVisiTec' => 'required',


        ],
      [
        'required' => 'Este campo es requerido',
        'unique' => 'Este campo ya existe',
      ]);
    }
    public function create(){
        $cliente = Cliente::where('aEstado','A')->get();
      //  dd($cliente);
        return view('admin.encuesta.registrarEncuesta')->with('cliente',$cliente);
    }


    public function store(Request $request){

    	if($request->eCodReg == ''){
    		$encuesta = new Encuesta();
    	}
        $this->validator($request->all())->validate();
        $encuesta->dFecha = date("Y-m-d H:i:s") ;
    	  $encuesta->eCodCliente = $request->eCodCliente;
    	  $encuesta->aVisitaVendedor = $request->visitaVen;
        $encuesta->aVisitaTecnica = $request->visiTec;
        //vendedor
        if($request->visitaVen == 'no')
        {
            $encuesta->eCantidadVisiVen = 0;
        }
        else
        {
            $encuesta->eCantidadVisiVen = $request->eCantidadVisiVen;
        }
        //tecnica
        if($request->visiTec == 'no')
        {
            $encuesta->eCantidadVisiTec = 0;
        }
        else
        {
             $encuesta->eCantidadVisiTec = $request->eCantidadVisiTec;
        }

        $encuesta->aMes = $request->aMes;
    	  $encuesta->aUserCreated =  Auth::user()->name;
		    $encuesta->aUserUpdate =  Auth::user()->name;
    		$encuesta->dDateCreate =  date("Y-m-d H:i:s") ;
    		$encuesta->dDateUpdate =  date("Y-m-d H:i:s") ;
    		$encuesta->aEstado = 'A';
        //dump(Encuesta::where('eCodCliente',$request->idCliente)->where('aMes',$request->aMes)->get()->first());
        if((Encuesta::where('eCodCliente',$request->eCodCliente)->where('aMes',$request->aMes)->get()->first()) == true)
        {
        return    Session::flash('warning', 'Encuesta ya existe');
        }

        else
        {

             $encuesta->save();
        return    Session::flash('message', 'Encuesta registrada con éxito');
        }


    	//return redirect('/encuesta');

    }
}
