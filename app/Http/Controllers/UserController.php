<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
             $user->password=$request->input('password');

             $user->save();
                return response()->json([
                    'message'=>'A new User created'
                ]);
        }

        public function signin(Request $request ){
            $this->validate($request ,[
                'uname'=>'required|uname',
                'password' =>'required'
            ]);

            
        }

}
