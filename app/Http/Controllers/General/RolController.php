<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection as Collection;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Caffeinated\Shinobi\Models\Role;
use App\User;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Response;
//use Yajra\Datatables\Datatables;
use Datatables;

class RolController extends Controller
{
    //
     public function index(){


    return view ('admin.seguridad.roles.listarRol');
    }
    public function getRol(){
      $roles =  Role::all();
      return  Datatables::of($roles)
        ->addColumn('details_url', function($roles) {
            return url('/rolDetail/'.$roles->id);
        })
        ->addColumn('action', function ($user) {
                return '<a href="rol/edit/'.$user->id.'"><button class="btn btn-xs btn-secondary"><i class="fa fa-pencil"></i></button></a>
                <a href="javascript:;" onclick="eliminar( '.$user->id.' )"><button class="btn btn-xs btn-danger"><i class="linecons-trash"></i></button></a>';
            })
        ->make(true);
    }


    //master detail
    public function detail($id){
      $rol= Role::find($id)->permissions();

      return Datatables::of($rol)->make(true);

    }
     protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:roles',

        ]);
    }
     public function create(){
    $roles = new Role;
    return view('admin.seguridad.roles.registrarRol')->with('roles',$roles);
    }
        // guarda los perfiles
   public function store(Request $request){
    	if($request->id == '')
    	{
    		$roles = new Role;
    	}else{
    			$roles = Role::find($request->id);
    		}

    	   $this->validator($request->all())->validate();
    		$roles->name = $request->name;
    		$roles->slug = $request->name;
    		$roles->description = $request->description;



    	if($roles->save())


    	return Session::flash('message', 'Rol registrado con éxito');

    }
    public function update(Request $request){
        if($request->id <> '')
        {

           $roles = Role::find($request->id);
        }


            $roles->name = $request->name;
            $roles->slug = $request->name;
            $roles->description = $request->description;



        if($roles->save())


        return Session::flash('message', 'Rol actualizado con éxito');

    }

    public function edit($id){
        $roles = Role::find($id);

        //dd($cliente);
        return  view ('admin.seguridad.roles.registrarRol')->with('roles',$roles);
    }
      public function indexAsignarPermiso(){
        $roles = Role::all();
        $permiso = Permission::all();
        return view('admin.seguridad.roles.asignarPermiso')->with('roles',$roles)->with('permiso',$permiso);
    }
    public function storeAsignarPermiso(Request $request){
        $roles = Role::find( $request->namer);
       // $roles->assignPermission($request->namep);

        if($roles->assignPermission($request->namep))
           // dd('ok');



         $roles = Role::all();
        $permiso = Permission::all();
       // return view('admin.seguridad.roles.asignarPermiso')->with('roles',$roles)->with('permiso',$permiso);
        return  Session::flash('message', 'Permiso asignado con éxito');


    }
    public function AsignarRol()
    {
        $roles = Role::all();
        $user = User::all();
        return view('admin.seguridad.roles.asignarRol')->with('roles',$roles)->with('user',$user);
    }

    public function storeAsignarRol(Request $request)
    {

        $user = User::find($request->namep);

        if($user->assignRole($request->namer))
          //  dd('ok');

          $user = User::all();
          $roles = Role::all();
          return   Session::flash('message', 'Rol asignado con éxito');
    }


    public function revocarRol()
    {
        $user = User::all();
        return view('admin.seguridad.roles.revocarRoles')->with('user',$user);
    }
    public function buscarRol($idUser)
    {
        //dd($idUser);
        $rol = \DB::table('users')
        ->join('role_user', 'role_user.user_id','=','users.id')
        ->join('roles','roles.id','=','role_user.role_id')
        ->where('role_user.user_id',$idUser)
        ->select('roles.id as id','roles.name as name' )
        ->get();
      //  dd($rol);
        return $rol;
    }
    public function revocarRolUsuario(Request $request)
    {
        //dd($request->all());
        $user = User::find($request->namep);
        if ($user->revokeRole($request->namer))
           // Session::flash('message', 'Rol desabilitado con éxito');
        //dd($user);
        $user = User::all();
        return  Session::flash('message', 'Rol deshabilitado con éxito');
    }

    public function delete($id)
    {
        \DB::table('roles')->where('id',$id)->delete();
      return  Session::flash('message', 'Rol eliminado con éxito');
    }
    //master detail

}
