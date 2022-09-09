<?php

namespace App\Http\Requests\User\Auth;

use App\Http\Requests\BaseRequest;
use App\Rules\IsAdminRule;
use Illuminate\Validation\Rule;

class RegisterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required','string','max:255'],
            'last_name' => ['required','string','max:255'],
            'email' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'email'),
                new IsAdminRule()
            ],
            'password' => ['required', 'confirmed', 'min:5', ],
//            'is_admin' => ['required', 'bool'],
        ];
    }
}
