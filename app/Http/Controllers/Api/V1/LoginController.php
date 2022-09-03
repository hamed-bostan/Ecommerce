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

            // if Validation fails
        if (! $validate) {
            return response()->json([
                'message' => __('fail.invalid_message')
            ]);
        }


            // if user doesnt exist
        if (!Auth::attempt($request->only(['email','password']))){
            return response()->json([
                'message'=>'Login information is not correct',
            ]);
        }


        $accessToken = Auth::user()->createToken('myToken')->accessToken;

            // checking user credentials
        if (Auth::attempt($request->only(['email','password']))){
            return response([
               'user'=>Auth::user(),
               'accessToken'=>$accessToken
            ]);

        }


            // checking user credentials and if it's not admin
        if (Auth::attempt($request->only(['email','password'])) && auth()->user()->is_admin==0 ){
            return response()->json([
                'message'=>'it is not admin'
            ]);
        }

    }



    public function logout()
    {
        Auth::logout();

        return response()->json([
            'message'=>'You logged out successfully'
        ]);
    }

}
