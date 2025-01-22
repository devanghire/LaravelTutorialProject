<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(Request $request){

        $validateUser = Validator::make(

            $request->all(),[
                'first_name'=>'required',
                'email'=>'required|email|unique:users,email',
                'password'=>'required',
            ]
        );
        if($validateUser->fails()){
            $ErrorResponse = array(
                'status'=>false,
                'message'=>'Validation error',
                'errors'=>$validateUser->errors()->all(),
            );
            return response()->json($ErrorResponse,401);
        }else{
            $user = User::create([
                'first_name'=>$request->first_name,
                'last_name'=>$request->first_name,
                'email'=>$request->email,
                'password'=>$request->password

            ]);

            $successResponse = array(
                'status'=>true,
                'message'=>'Data Insert Successfully',
                'data'=>$user,
            );
            return response()->json($successResponse,200);
        }
            
    }
    public function login(Request $request){
        $validateUser = Validator::make(
            $request->all(),[
                'email'=>'required|email',
                'password'=>'required',
            ]
        );
        if($validateUser->fails()){
            $ErrorResponse = array(
                'status'=>false,
                'message'=>'Validation error',
                'errors'=>$validateUser->errors()->all(),
            );
            return response()->json($ErrorResponse,401);
        }
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $authUser = Auth::user();
            $successResponse = array(
                'status'=>true,
                'message'=>'Login Successfully',
                'token'=>$authUser->CreateToken('Api Token')->plainTextToken,
                'tokenType'=>'bearer',
            );
            return response()->json($successResponse,200);
        }else{
            $failResponse = array(
                'status'=>false,
                'message'=>'Invalid Credential',
                // 'token'=>$authUser->CreateToken('Api Token')->plainTextToken,
                // 'tokenType'=>'bearer',
            );
            return response()->json($failResponse,401);
        }

        
    }
    public function logout(Request $request){

        $user = $request->user();
        $user->tokens()->delete();
        // $user->tokens($request->token_KEY)->delete(); //IF YOU WANT DELELE SOME SPACIFIC TOKEN
        $successResponse = array(
            'status'=>true,
            'message'=>'Logout Successfully',
            'user'=>$user,
        );
        return response()->json($successResponse,200);
    }
}
