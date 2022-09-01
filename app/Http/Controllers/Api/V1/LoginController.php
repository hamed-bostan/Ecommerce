<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use function __;
use function request;
use function response;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validate = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required'],
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => __('fail.invalid_message')
            ]);
        }


        // checking user credentials
        if (Auth::attempt($request->only(['email','password']))){
            return response()->json(Auth::user(),200);
        }

            // if user doesnt exist
        if (!Auth::attempt($request->only(['email','password']))){
            return response()->json([
                'message'=>'User doesnt exist'
            ]);
        }

        if (auth()->user()->is_admin==1){
            return response()->json([
                'message'=>'is admin',
            ]);
        }



        //dd($user->createToken($token));



        //$token = $user->createToken('Token Name')->accessToken;
       // var_dump($user->createToken());
//        var_dump($token);;

//        return response()->json([
//            'message' => 'you are logged in',
//            'token_type'=>'Bearer',
//            'token'=>$token,
//        ],200);
    }


    public function logout()
    {
        Auth::logout();

        return response()->json([
            'message'=>'You logged out successfully'
        ]);
    }

}
