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
            'product_name' => ['required'],
            'color' => ['required'],
            'price' => ['required'],
            'is_available_in_store' => ['required'],
            'quantity' => ['required'],
            'user_id' => ['required'],
        ];
    }
}
