<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'total_of_orders' => ['required','integer'],
            'user_id' => ['required'],
            'product_id' => ['required'],
            'address' => ['string'],
        ];
    }

//    protected function prepareForValidation()
//    {
//        $this->merge([
//            'total_price' => $this -> total_price,
//            'total_of_orders' => $this -> total_of_orders,
//            'user_id' => $this -> user_id,
//            'product_id' => $this -> product_id,
//        ]);
//    }


}
