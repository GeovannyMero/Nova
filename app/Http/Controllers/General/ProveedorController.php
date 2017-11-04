<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection as Collection;
use App\Modelos\Proveedor;

class ProveedorController extends Controller
{
    //
    public function index(){
        $proveedor = Proveedor::where('aEstado','A')->get();

        return view('admin.maestros.proveedor.listarProveedor')->with('proveedor',$proveedor);
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'aRUC' => 'required|max:13|unique:tbl_proveedor',
            'aMail' => 'email|max:255|nullable',
            'eCodExtProvee' => 'required|max:12|unique:tbl_proveedor',
            'aRazonSocial' => 'required',
          //  'aTelefono' => 'required',



        ],
      [
        'required' => 'Este campo es requerido',
        'unique' => 'Esta campo ya existe',
        'email' => 'Ingrese un correo valido',
      ]);
    }
    public function create(){
        $proveedor = new Proveedor;
        return view('admin.maestros.proveedor.registrarProveedor')->with('proveedor',$proveedor);
    }

    //guardar
    public function store(Request $request){

        if($request->eCodReg == '')
        {
           // dd('ok');
            $proveedor = new Proveedor;

        }

        $this->validator($request->all())->validate();
        $proveedor->aRUC = $request->aRUC;
        $proveedor->aRazonSocial = $request->aRazonSocial;
        $proveedor->aTelefono = $request->aTelefono;
        $proveedor->aMail = $request->aMail;
        $proveedor->eCodExtProvee = $request->eCodExtProvee;
        $proveedor->aUserCreated = Auth::user()->name;
        $proveedor->aUserUpdate = Auth::user()->name;
        $proveedor->dDateCreate =  date("Y-m-d H:i:s") ;
        $proveedor->dDateUpdate = date("Y-m-d H:i:s");
        $proveedor->aEstado = 'A';
        if($proveedor->save())


        return  Session::flash('message', 'Proveedor registrado con éxito');


    }
     public function update(Request $request){
        //dd($request->all());

        if($request->eCodReg <> ''){
            $proveedor = Proveedor::find($request->eCodReg);
        }
//$this->validator($request->all())->validate();
        $proveedor->aRUC = $request->aRUC;
        $proveedor->aRazonSocial = $request->aRazonSocial;
        $proveedor->aTelefono = $request->aTelefono;
        $proveedor->aMail = $request->aMail;
        $proveedor->eCodExtProvee = $request->eCodExtProvee;
        $proveedor->aUserCreated = Auth::user()->name;
        $proveedor->aUserUpdate = Auth::user()->name;
        $proveedor->dDateCreate =  date("Y-m-d H:i:s") ;
        $proveedor->dDateUpdate = date("Y-m-d H:i:s");
        $proveedor->aEstado = 'A';
        if($proveedor->save())


        return Session::flash('message', 'Proveedor actualizado con éxito');


    }
     public function edit($id){
        $proveedor = Proveedor::find($id);

        //dd($cliente);
       return view('admin.maestros.proveedor.registrarProveedor')->with('proveedor',$proveedor);
    }
    public function delete($id){
         \DB::table('tbl_proveedor')->where('eCodReg',$id)->update(['aEstado' => 'I']);
        return Session::flash('message', 'Proveedor eliminado con éxito');
}
}
