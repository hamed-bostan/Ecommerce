<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => ['required','string','max:255'],
            'color' => ['required','string','max:255'],
            'price' => ['required','integer'],
            'is_available_in_store' => ['required'],
            'quantity' => ['required','integer','max:50'],
            'user_id' => ['required'],
        ];
    }
}
