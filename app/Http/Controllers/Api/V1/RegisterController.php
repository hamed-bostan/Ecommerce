<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Http\Resources\User\RegisterResource;
use App\Mail\ActivationNotification;
use App\Mail\RegisterNotification;
use App\Models\User;
use App\Notifications\User\EmailVerificationNotification;
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
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * @param RegisterRequest $request Request.
     * @return RegisterResource
     */
    public function register(RegisterRequest $request): RegisterResource
    {
        /** @var User $user */
        $user = $this->userRepository->create($request->validated() + [
            'phone_number'=>$request->phone_number,
            'password' => bcrypt($request->password),
            'activation_token' => Str::random(60),
            'ip' => $request->ip(),
            ]);

        // TODO Notification
//        Mail::to($user->email)->send(new RegisterNotification($user));
//        $user->notify(EmailVerificationNotification::class);

        return new RegisterResource($user);
    }

    public function activation($token)
    {
        /** @var User $user */
        $user = User::query()->where('activation_token', $token)->first();

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

            $user->notify(EmailVerificationNotification::class);

            return response()->json([
                'message' => __('success.activation_message')
            ]);
        }
    }

}
