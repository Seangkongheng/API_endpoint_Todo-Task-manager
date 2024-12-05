<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{


    public function index(){
        $ojbuser=User::orderBy('id','desc')->get();
        return response()->json($ojbuser);
    }
    public function register(Request $request){
        // $request->validate([
        //     'first_name'=>"required",
        //     'last_name'=>"required",
        //     'username'=>"required",
        //     'email'=>"required",
        //     'password'=>"required",
        //     'staff_id'=>"required",
        // ]);

       $objUser= User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password) ,
            'staff_id'=>$request->staff_id,
        ]);
        $token = JWTAuth::fromUser($objUser);

        if ($objUser) {
            return response()->json(['token' => $token], 201);
        } else {
            return response()->json(["message" => "User registration failed"], 500);
        }


    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }
    return response()->json(['token' => $token]);
}

    function logout(Request $request){
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

}
