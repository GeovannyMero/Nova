<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection as Collection;
use App\Modelos\Cliente;

class ClienteController extends Controller
{
    public function index(){
        $cliente = Cliente::where('aEstado','A')->get();
        return view ('admin.maestros.clientes.listarCliente')->with('cliente',$cliente);

    }
      protected function validator(array $data)
    {
        return Validator::make($data, [
            'aRUC' => 'required|max:13|unique:tbl_clientes',
            'eCodExtCliente' => 'required|max:10|unique:tbl_clientes',
            'aMail' => 'email|max:255|nullable',
            'aNombre' => 'required',
          //  'aTelefono' => 'required',
          ],
        [
          'required' => 'Este campo es requerido',
          'email' => 'Ingrese un correo valido',
          'unique' => 'Este campo ya existe',
        ]);
    }
       public function create(){
        $cliente = new Cliente;

        return view('admin.maestros.clientes.registrarCliente')->with('cliente',$cliente);
    }

     public function store(Request $request)
     {
        // dd($request->all());
        if($request->eCodReg == '')
        {

            $cliente = new Cliente;

        }
         $this->validator($request->all())->validate();
         $cliente->aRUC = $request->aRUC;
         $cliente->aNombre = $request->aNombre;
         $cliente->aDireccion = $request->aDireccion;
         $cliente->aTelefono = $request->aTelefono;
         $cliente->aMail = $request->aMail;
         $cliente->eCodExtCliente = $request->eCodExtCliente;

         $cliente->aUserCreated = Auth::user()->name;
         $cliente->aUserUpdate = Auth::user()->name;
         $cliente->dDateCreate =  date("Y-m-d H:i:s") ;
         $cliente->dDateUpdate = date("Y-m-d H:i:s");
         $cliente->aEstado = 'A';

        if($cliente->save())


     return  Session::flash('message', 'Cliente registrado con éxito');

    }

     public function update(Request $request){
       //   dd($request->eCodReg);

        if($request->eCodReg <> ''){

                $cliente = Cliente::find($request->eCodReg);
        }

        //$this->validator($request->all())->validate();
        //$cliente->eCodReg = $request->eCodReg;
        $cliente->aRUC = $request->aRUC;
        $cliente->aNombre = $request->aNombre;
        $cliente->aDireccion = $request->aDireccion;
        $cliente->aTelefono = $request->aTelefono;
        $cliente->aMail = $request->aMail;
        $cliente->eCodExtCliente = $request->eCodExtCliente;

        $cliente->aUserCreated = Auth::user()->name;
        $cliente->aUserUpdate = Auth::user()->name;
        $cliente->dDateCreate =  date("Y-m-d H:i:s") ;
        $cliente->dDateUpdate = date("Y-m-d H:i:s");
        $cliente->aEstado = 'A';

        if($cliente->save())


        return Session::flash('message', 'Cliente actualizado con éxito');

    }

    public function edit($id){
        $cliente = Cliente::find($id);

        //dd($cliente);
        return  view ('admin.maestros.clientes.registrarCliente')->with('cliente',$cliente);
    }
    //actualiza el estado del cliente
    public function delete($id){
      //  dd($id);
         \DB::table('tbl_clientes')->where('eCodReg',$id)->update(['aEstado' => 'I']);
         return  Session::flash('message', 'Cliente eliminado con éxito');
    }
}
