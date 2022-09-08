<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use function __;
use function request;
use function response;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {

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
