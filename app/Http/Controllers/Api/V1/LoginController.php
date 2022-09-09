<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\LoginRequest;
use App\Http\Resources\LoginResource;
use Illuminate\Support\Facades\Auth;
use function response;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {

            // if user doesnt exist
        $user = Auth::attempt($request->only(['email','password']));

        if (! $user ){
            return response()->json([
                'message'=>'Login information is not correct',
            ]);
        }

        $user = auth()->user();
        $accessToken = $user->createToken('myToken')->accessToken;

            // checking user credentials
        if ($user){
            return response([
               'user'=>Auth::user(),
               'accessToken'=>$accessToken
            ]);

        }

        return new LoginResource($user, $accessToken);

//        return response()->json([
//            'user' => new UserResource($user),
//            'token' => $accessToken
//        ]);

    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'message'=>'You logged out successfully'
        ]);
    }

}
