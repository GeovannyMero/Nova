<?php

namespace App\Http\Controllers\General;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection as Collection;
use App\Modelos\Producto;

class ProductoController extends Controller
{
   use ApiResponser;
    //
    public function index(){
      $producto = Producto::all()->where('atipo','Producto')->where('aEstado','A');
      return view ('admin.maestros.producto.listarProducto')->with('producto',$producto);
    }
      protected function validator(array $data)
    {
        return Validator::make($data, [
            'aNombre' => 'required|max:255|unique:tbl_producto',
            'eCodExtProduc' => 'required|max:10|unique:tbl_producto',
        ],
      [
        'required' => 'El campo es requerido',
        'unique' => 'El campo ya existe',
      ]);
    }
    //muestra ventana para ingresar datos del producto
    public function create(){
       $producto = new Producto;

      return view('admin.maestros.producto.registrarProducto')->with('producto',$producto);
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
      $producto->atipo = 'Producto';
      $producto->eCodExtProduc = $request->eCodExtProduc;

      $producto->aUserCreated = Auth::user()->name;
      $producto->aUserUpdate = Auth::user()->name;
      $producto->dDateCreate =  date("Y-m-d H:i:s") ;
      $producto->dDateUpdate = date("Y-m-d H:i:s");
      $producto->aEstado = 'A';

      if($producto->save())


      return  Session::flash('message', 'Producto registrado con éxito');

    }

    public function update(Request $request){


      if($request->eCodReg <> ''){

          $producto = Producto::find($request->eCodReg);
      }
         //$this->validator($request->all())->validate();

      $producto->aNombre = $request->aNombre;
      $producto->atipo = 'Producto';
      $producto->eCodExtProduc = $request->eCodExtProduc;

      $producto->aUserCreated = Auth::user()->name;
      $producto->aUserUpdate = Auth::user()->name;
      $producto->dDateCreate =  date("Y-m-d H:i:s") ;
      $producto->dDateUpdate = date("Y-m-d H:i:s");
      $producto->aEstado = 'A';

      if($producto->save())


      return Session::flash('message', 'Producto actualizado con éxito');

    }
       public function edit($id){
        $producto = Producto::find($id);

        //dd($cliente);
      return view('admin.maestros.producto.registrarProducto')->with('producto',$producto);
    }

       public function getInsumos(){
      $productos = Producto::all()->where('atipo','Producto');
      return $this->showAll($productos);
    }
      public function delete($id){
       if( \DB::table('tbl_producto')->where('eCodReg',$id)->update(['aEstado' => 'I']))
        //Session::flash('message', 'Conductor eliminado con exito');
      return  Session::flash('message', 'Producto eliminado con éxito');
    }
}
