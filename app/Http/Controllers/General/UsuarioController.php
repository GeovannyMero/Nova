<?php

namespace App\Http\Controllers\General;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection as Collection;
use App\User;
use App\Modelos\Perfil;
use App\Modelos\UsuarioPerfil;
use Validator;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Mail;
use Log;

class UsuarioController extends Controller
{

    public function index()
   {

   // $this->authorize('view');
  //$roles = Role::all());
   $users = User::all();
 /**/ $users = \DB::table('users')
  ->leftjoin('role_user','users.id','=','role_user.user_id')
  ->leftjoin('roles','role_user.role_id','=','roles.id')
  ->select('users.id','users.name','users.username','roles.name as rol','users.email')
  ->get();
   /*$data['message'] = 'test';
      Mail::send('admin.email',$data, function($msj){
        $msj->from('geovannym64@gmail.com');
        $msj->to('tuchinita1993@hotmail.com');
        $msj->subject('Nuevo usuario');
      });*/
    //$role = Role::where('id',$user->role())->select('name')->get();
    //$user->role()->where('role_user.role_id','5')->select('name')->get();

    return View ('admin.seguridad.usuario.listarUsuario')->with('users', $users);




   // dd( User::all());



   }
     protected function validator(array $data)
    {
        return Validator::make($data, [
           // 'name' => 'required|max:255|unique:users',
            'username'=>'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            //'password' => 'required|min:6|confirmed',
        ],
      [
        'required' => 'Este Campo es requerido',
        'email' => 'Ingrese un correo valido',
      ]);
    }
   //mostrar registro usuario
   public function create(){

    $user = new User;
      $roles =  Role::all();
      return view('admin.seguridad.usuario.registrarUsuario')->with('roles',$roles)->with('user',$user);



   }



   //guardar usuario
 public function store(Request $request){
//dd($request->all());//
      if($request->id == '')
      {

        $user = new User;

      }
      /*else{
          $user = User::find($request->id);
        }*/

      $this->validator($request->all())->validate();

      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt('123456');
      $user->username = $request->username;


      if($user->save())

       // $user->assignRole($request->namer);

        Session::flash('message', 'Usuario registrado con éxito');
     /*   $data['message'] = 'test';
      Mail::send('admin.email',$request->all(), function($msj) use($user){
        $msj->from('geovannym64@gmail.com');
        $msj->to($user->email);
        $msj->subject('Nuevo usuario');
      });*/

      return  Session::flash('message', 'Usuario registrado con éxito');

    }

    public function update(Request $request){
     // dump($request->id);
      if($request->id <> ''){
          $user = User::find($request->id);

        }



      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt('123456');
      $user->username = $request->username;
      $user->assignRole($request->namer);

      if($user->save())





      return   Session::flash('message', 'Usuario actualizado con éxito');

    }


     public function storePermiso(Request $request){
      if($request->id == '')
      {
        $permiso = new Permission;
      }else{
          $permiso = Permission::find($request->id);
        }

      //$this->validator($request->all())->validate();
        $permiso->name = $request->name;
        $permiso->slug = $request->slug;
        $permiso->description = $request->description;



      if($permiso->save())


        Session::flash('message', 'Permiso REgistrado registrado con exito');

      return redirect('/permisos');

    }
       public function edit($id){
       //dd($id);
          $user = User::find($id);
          $use = User::where('id', $id)->get()->toArray();
          $user_rol = \DB::table('role_user')->where('user_id',$use)->first();
        //  $rol = Role::where('id',$user_rol->role_id)->get()->first();
          $roles =  Role::all();

        return  view ('admin.seguridad.usuario.registrarUsuario')->with('user',$user)->with('roles',$roles)->with('user_rol',$user_rol);
    }

    public function delete($id)
    {
      \DB::table('users')->where('id',$id)->delete();
      return  Session::flash('info', 'Usuario eliminado con éxito');
    }
}
