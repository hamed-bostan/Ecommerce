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
        $validate = Validator::make($request->all(), [
            'email'    => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => __('fail.invalid_message')
            ]);
        }

        $check = request(['email', 'password']);


        // if user doesn't exist
        if (!Auth::attempt($check)) {
            return response()->json([
                'message' => __('fail.verification_failed')
            ], 401);
        }


        $user = Auth::user();


        //dd($user->createToken($token));


        // if user's email is not verified
        if (!$user->hasVerifiedEmail()) {
            return response()->json([
                'message' => __('fail.email_failed')
            ], 401);
        }

        $token = $user->createToken('Token Name')->accessToken;
        var_dump($user->createToken());
//        var_dump($token);;

        return response()->json([
            'message' => 'you are logged in',
            'token_type'=>'Bearer',
            'token'=>$token,
        ],200);
    }
}
