<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function signup(Request $request){
        $this->validate($request, [
            'uname' => 'required|bail',
            'email'=>'required|email|bail|unique:users',
            'password'=>'required|bail'
            ]);

            $user = new User();
            $user->uname=$request->input('uname');
            $user->email=$request->input('email');
            $user->password= bcrypt($request->input('password'));

            $user->save();
            return response()->json([
                'message'=>'A new User created'
            ]);
    }


    public function signin(Request $request ){
        $this->validate($request ,[
            'email'=>'required',
            'password' =>'required'
        ]);

        $credentials= $request->only('email','password');
        try{
            if(!$token=JWTAuth::attempt($credentials)) {
                return response()->json([
                'error'=>'Invalid Credentials'
                ], 401);
            }
        }catch(JWTException $e){
            return response()->json([
                'error'=>'Could not create token'
            ],500);
        }
        return response()->json([
            'token'=>$token
        ],200);         
    }

}
