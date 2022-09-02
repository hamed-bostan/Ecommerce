<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Mail\ActivationNotification;
use App\Mail\RegisterNotification;
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use function __;
use function bcrypt;
use function response;

class RegisterController extends Controller
{

    public function register(Request $request)
    {
        $validate = $request->validate([
            'first_name' => ['required'],
            'last_name'  => ['required'],
            'email'      => ['required','unique:users','max:255'],
            'password'   => ['required','confirmed','min:5'],
            'is_admin'   => ['required'],
        ]);

        if (! $validate) {
            return response()->json([
                'message' => __('fail.invalid_message')
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $user = resolve(UserRepository::class)->create($request);
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
