<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessEmail;
use App\Mail\ActivationNotification;
use App\Mail\RegisterNotification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|unique:users|max:255',
            'password'   => 'required|confirmed|min:5',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => __('fail.invalid_message')
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $user = new User([
                'first_name'       => $request->first_name,
                'last_name'        => $request->last_name,
                'email'            => $request->email,
                'password'         => bcrypt($request->password),
                'activation_token' => Str::random(60),
                'ip'               => $request->ip(),
            ]);

            $user->save();

            Mail::to($user->email)->send(new RegisterNotification($user));

            return response()->json([
                'message' => __('success.success_message'),
            ]);
        }
    }


    public function activation($token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return response()->json([
                'message' => __('fail.invalid_token')
            ]);
        } else {
            $user->activation_token = '';
            $user->activation = true;
            $user->email_verified_at = Carbon::now();

            $user->save();

            Mail::to($user->email)->send(new ActivationNotification($user));

            return response()->json([
                'message' => __('success.activation_message')
            ]);
        }
    }

}
