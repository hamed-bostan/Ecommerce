<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserRepository
{
    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function create(Request $request)
    {
        $user = User::create([
            'first_name'       => $request->first_name,
            'last_name'        => $request->last_name,
            'email'            => $request->email,
            'password'         => bcrypt($request->password),
            'activation_token' => Str::random(60),
            'ip'               => $request->ip(),
            'is_admin'         => $request->is_admin,
        ]);

        return $user;
    }
}
