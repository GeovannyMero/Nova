<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Response;

class UserController extends Controller
{
    public function __construct(){
    	$this->content = array();
    }

    public function login(){
    	
    	//dd(request('username'));

    	if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){
	        $user = Auth::user();
            //dd($user);
	        $this->content['token'] =  $user->createToken('AppNova')->accessToken;
	        $status = 200;
   		}
    	else{
	        $this->content['error'] = "Unauthorised";
	        $status = 401;
     	}

    	return response()->json($this->content, $status);    
   }


    public function details(){
        return response()->json(['user' => Auth::user()]);
    }
}
