<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection as Collection;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use App\User;
use App\Modelos\Sistema;
class PermisoController extends Controller
{
    //
     public function index(){

     $permiso =    \DB::table('permissions')
                    ->join('tbl_sistema','tbl_sistema.eCodReg','=','permissions.eCodSistema')
                    ->select('permissions.id','tbl_sistema.aNombre','permissions.name')
                    ->get();
    	return view ('admin.seguridad.permisos.listarPermiso')->with('permiso',$permiso);
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:permissions',

        ],
      [
        'required' => 'Este Campo es requerido',
      ]);
    }
       public function create(){
       		$roles =  Role::all();
            $permiso = new Permission;
            $sistema = Sistema::all();
   		 return view('admin.seguridad.permisos.registrarPermiso')->with('roles',$roles)->with('permiso',$permiso)->with('sistema',$sistema);
    }
     public function store(Request $request){
    	if($request->id == '')
    	{
    		$permiso = new Permission;
    	}



    	$this->validator($request->all())->validate();
    		$permiso->name = $request->name;
    		$permiso->slug = $request->name;
    		$permiso->description = $request->description;
            $permiso ->eCodSistema = $request->aNombre;



    	if($permiso->save())



    	return Session::flash('message', 'Permiso registrado con exito');

    }

     public function update(Request $request){

        if($request->id <>'')
        {
            $permiso = Permission::find($request->id);
        }

            $permiso->name = $request->name;
            $permiso->slug = $request->name;
            $permiso->description = $request->description;
            $permiso ->eCodSistema = $request->aNombre;



        if($permiso->save())

       // Session::flash('message', 'Permiso actualizado con éxito');

        return Session::flash('message', 'Permiso actualizado con éxito');

    }

      public function edit($id){
        $roles =  Role::all();
        $permiso = Permission::find($id);
        $permi = Permission::where('id',$id)->first();
        $sis = Sistema::where('eCodReg',$permi->eCodSistema)->get()->first();
        $sistema = Sistema::all();
        return  view ('admin.seguridad.permisos.registrarPermiso')->with('permiso',$permiso)->with('roles',$roles)->with('sistema',$sistema)->with('sis',$sis);
    }
       public function delete($id){
       if( \DB::table('permissions')->where('id',$id)->delete())

      return  Session::flash('message', 'Permiso eliminado con éxito');
    }

    public function revocarPermiso()
    {
        $rol = Role::all();
        return view('admin.seguridad.permisos.revocarPermisos')->with('rol',$rol);
    }

    public function buscarPermiso($id)
    {
       // dd($id);
        $rol = \DB::table('roles')
        ->join('permission_role', 'permission_role.role_id','=','roles.id')
        ->join('permissions','permissions.id','=','permission_role.permission_id')
        ->where('roles.id',$id)
        ->select('permissions.id as id','permissions.name as name' )
        ->get();
      //  dd($rol);
        return $rol;
    }
    public function revocarRolPermiso(Request $request)
    {
        //dd($request->all());
        $rol = Role::find($request->namep);
       if( $rol->revokePermission($request->namer))

        $rol = Role::all();
             return Session::flash('message', 'Permiso desabilitado con éxito');
    }

}
