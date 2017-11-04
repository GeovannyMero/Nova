<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection as Collection;
use App\Modelos\Producto;

class InsumoController extends Controller
{
    //
   public function index(){
      $producto = Producto::all()->where('atipo','Insumo')->where('aEstado','A');
      return view ('admin.maestros.insumos.listarInsumos')->with('producto',$producto);
    }
    protected function validator(array $data)
    {
      $v = Validator::make($data, [
            'aNombre' => 'required|max:255|unique:tbl_producto',
            'eCodExtProduc' => 'required|max:10|unique:tbl_producto',
        ],
      [
        'eCodExtProduc.required' => 'Campo requerido',
        'aNombre.required' => 'Campo requerido',
        'unique' => 'Campo ya existe',
      ]);
      return $v;
    }
     public function create(){
       $producto = new Producto;

      return view('admin.maestros.insumos.registrarInsumo')->with('producto',$producto);
    }
    //Guarda Productos
      public function store(Request $request){

      if($request->eCodReg == '')
      {
        $producto = new Producto;

      }
      /*else{

          $producto = Producto::find($request->eCodReg);
      }*/

      $this->validator($request->all())->validate();

      $producto->aNombre = $request->aNombre;
      $producto->atipo = 'Insumo';
      $producto->aUnidad = $request->aUnidad;
      $producto->eCodExtProduc = $request->eCodExtProduc;
      $producto->aUserCreated = Auth::user()->name;
      $producto->aUserUpdate = Auth::user()->name;
      $producto->dDateCreate =  date("Y-m-d H:i:s") ;
      $producto->dDateUpdate = date("Y-m-d H:i:s");
      $producto->aEstado = 'A';

      if($producto->save())


      return Session::flash('message', 'Insumo registrado con éxito');

    }

    public function update(Request $request){


      if($request->eCodReg <> ''){

          $producto = Producto::find($request->eCodReg);
      }

    //  $this->validator($request->all())->validate();

      $producto->aNombre = $request->aNombre;
      $producto->atipo = 'Insumo';
      $producto->aUnidad = $request->aUnidad;
      $producto->eCodExtProduc = $request->eCodExtProduc;
      $producto->aUserCreated = Auth::user()->name;
      $producto->aUserUpdate = Auth::user()->name;
      $producto->dDateCreate =  date("Y-m-d H:i:s") ;
      $producto->dDateUpdate = date("Y-m-d H:i:s");
      $producto->aEstado = 'A';

      if($producto->save())


      return  Session::flash('message', 'Insumo actualizado con éxito');

    }
     public function edit($id){
        $producto = Producto::find($id);

        //dd($cliente);
        return  view ('admin.maestros.insumos.registrarInsumo')->with('producto',$producto);
    }
     public function delete($id){
       if( \DB::table('tbl_producto')->where('eCodReg',$id)->update(['aEstado' => 'I']))
        //Session::flash('message', 'Conductor eliminado con exito');
      return  Session::flash('message', 'Insumo eliminado con éxito');
    }


}
