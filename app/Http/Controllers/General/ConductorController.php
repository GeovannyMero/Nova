<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection as Collection;
use App\Modelos\Chofer;
use App\Modelos\Camion;

class ConductorController extends Controller
{
    //
     public function index(){
        //$chofer = Chofer::all();
        $chofer = (\DB::table('tbl_chofer')
         ->join('tbl_camion','tbl_camion.eCodReg','=','tbl_chofer.eCodCamion')->select('tbl_chofer.eCodReg','tbl_chofer.aCedula as cedula' , 'tbl_chofer.aNombre as nombre','tbl_chofer.aCompaTrans as cia','tbl_camion.aPlaca as placa','tbl_camion.aMarca as marca')
         ->where('tbl_chofer.aEstado','A')
         ->get());
        return view('admin.maestros.conductor.listarChofer')->with('chofer',$chofer);
        //,'tbl_chofer.aCedula as cedula' , 'tbl_chofer.aNombre as nombre','tbl_chofer.aCompaTrans as cia','tbl_camion.aPlaca as placa','tbl_camion.aMarca as marca'
    }

    /* */protected function validator(array $data)
    {
        return Validator::make($data, [
            'aCedula' => 'required|max:10|unique:tbl_chofer',
            'aNombre' => 'required',
            'eCodCamion' => 'required',
           // 'aCompaTrans' =>'required',

        ],
      [
        'required' => 'Este campo es requerido',
        'unique' => 'Este campo ya exite',
      ]);

    }


      public function create(){
        $chofer = new Chofer;
        $camion = Camion::all();

        return view('admin.maestros.conductor.registrarConductor')->with('chofer',$chofer)->with('camion',$camion);
    }
    public function store(Request $request){

        if($request->eCodReg == '')
        {
            $chofer = new Chofer;
        }


      $this->validator($request->all())->validate();


//$this->validator($request->all())->errors()->add('Ya existe registro con el mismo numero de cedula');
        $chofer->aCedula = $request->aCedula;
        $chofer->aNombre = $request->aNombre;
        //$chofer->aTelefono = $request->aTelefono;
        //$chofer->aDireccion = $request->aDireccion;

        $chofer->aUserCreated = Auth::user()->name;
        $chofer->aUserUpdate = Auth::user()->name;
        $chofer->dDateCreate =  date("Y-m-d H:i:s") ;
        $chofer->dDateUpdate = date("Y-m-d H:i:s");
        $chofer->aEstado = 'A';
        $chofer->aCompaTrans = $request->ciaTrans;
        $chofer->eCodCamion = $request->eCodCamion;

        if($chofer->save())
              return Session::flash('message', 'Conductor registrado con éxito');






    }


         public function update(Request $request){

        if($request->eCodReg <> ''){
                $chofer = Chofer::find($request->eCodReg);
            }


        $chofer->aCedula = $request->aCedula;
        $chofer->aNombre = $request->aNombre;
        $chofer->aUserCreated = Auth::user()->name;
        $chofer->aUserUpdate = Auth::user()->name;
        $chofer->dDateCreate =  date("Y-m-d H:i:s") ;
        $chofer->dDateUpdate = date("Y-m-d H:i:s");
        $chofer->aEstado = 'A';
        $chofer->aCompaTrans = $request->ciaTrans;
        $chofer->eCodCamion = $request->eCodCamion;
        if($chofer->save())


        return Session::flash('message', 'Conductor Actualizado con éxito ');

    }
       public function edit($id){
        $chofer = chofer::find($id);
        $chof = Chofer::where('eCodReg',$id)->select('eCodCamion')->get()->toArray();
        $cami = Camion::where('eCodReg',$chof)->get()->first();
        $camion = Camion::all();

        //dd($chof);
        return  view ('admin.maestros.conductor.registrarConductor')->with('chofer',$chofer)->with('camion',$camion)->with('cami',$cami)->with('chof',$chof);
    }
    public function delete($id){
       if( \DB::table('tbl_chofer')->where('eCodReg',$id)->update(['aEstado' => 'I']))
      //  Session::flash('message', 'Conductor eliminado con exito');
      return  Session::flash('message', 'Conductor eliminado con éxito');
    }

}
