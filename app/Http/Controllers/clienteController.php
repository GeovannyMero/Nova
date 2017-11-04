<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection as Collection;
use App\Http\Controllers\Controller;
use Validator;
use App\User;

 
class clienteController extends Controller
{
	
   public function MostrarCambioContraseña(){
   	return view ("admin.cambiarContrase");
   }

    public function storeCambiarClave(Request $request){
    	
        $user = Auth::user();
       // $this->validator($request->all())->validate();
        $user->password = bcrypt($request->password);

       if($user->save()){
          Auth::logout();
          Session::flash('message', 'Contraseña cambiada con éxito..');
            return redirect("/");
        }

    }

}
