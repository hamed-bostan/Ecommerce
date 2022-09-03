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

        if (! $validate) {
            return response()->json([
                'message' => __('fail.invalid_message')
            ]);
        }

        // checking user credentials original
//        if (Auth::attempt($request->only(['email','password']))){
//            return response()->json(Auth::user(),200);
//        }


            // checking user credentials and if it's admin
        if (Auth::attempt($request->only(['email','password'])) && auth()->user()->is_admin==1 ){
            return response()->json([
                'message'=>'it is admin',
                'user information'=>Auth::user(),
            ]);
        }


            // checking user credentials and if it's not admin
        if (Auth::attempt($request->only(['email','password'])) && auth()->user()->is_admin==0 ){
            return response()->json([
                'message'=>'it is not admin'
            ]);
        }


            // if user doesnt exist
        if (!Auth::attempt($request->only(['email','password']))){
            return response()->json([
                'message'=>'Login information is not correct',
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
