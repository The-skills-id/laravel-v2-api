<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hash;
use App\User;
use DB;
class AuthController extends Controller
{
	

	public function __construct()
	{
		$this->middleware('auth:api', ['except' => ['login','register','resetPassword']]);
	}
    public function register(Request $request)
    {

    	$this->validate($request,[
    		'name' => 'required',
    		'email' => 'required|email|unique:users',
    		'password' => 'required',
    		'username' => 'required',
    		'age' => 'required',
    		'phone_number' => 'required',
			'school' => 'required',
			'child_name' => 'required',
			'grade' => 'required'
    	]);
    	$user = new User;

    	$user->name = $request->name;
    	$user->username = $request->username;
    	$user->email = $request->email;
    	$user->password = app('hash')->make($request->password);
    	$user->phone_number = $request->phone_number;
    	$user->age = $request->age;
		$user->child_name = $request->child_name;
		$user->school = $request->school;
		$user->grade = $request->grade;
		
    	if($user->save())
    	{
    		return response()->json(["message" => "Registrasi Berhasil"],200);
    	}
    	return response()->json(['message' => 'Registrasi Gagal, coba lagi'],400);
        
    }

	public function login(Request $request)
	{
		$this->validate($request,[
			"username" => 'required',
			"password" => 'required'
		]);

		$user = User::where('username', $request->username)->first();

		if(!$user || !Hash::check($request->password, $user->password))
		{
			return response()->json([
				'status' => 'fail',
				'message' => 'Username atau password salah!'
			], 400);
		}
		$token = $user->createToken('api-token');

		$response = response()->json([
			'status' => 'success',
			'user' => $user,
			'token' => $token
		]);
		return $response;
	}

	public function loggingout(Request $request)
	{
		return $request;
		return response()->json(['message' => 'Successfully logged out']);
	}

	
}
