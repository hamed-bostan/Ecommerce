<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(),[
           'email'=>'required',
           'password'=>'required',
        ]);

        if ($validate->fails()){
            return response()->json([
                'message'=>'invalid validation'
            ]);
        }

        $check = request(['email','password']);


        // if user doesn't exist
        if (! Auth::attempt($check)){
            return response()->json([
               'message'=>'Unauthorized'
            ],401);
        }


        $user = Auth::user();

        // if user's email is not verified
        if (! $user->hasVerifiedEmail()){
            return response()->json([
                'message'=>'Email is not verified'
            ],401);
        }


        return response()->json([
            'message'=>'you are loged in'
        ]);
    }
}
