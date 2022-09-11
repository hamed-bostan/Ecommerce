<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'ID'=>$this->id,
            'Product name' => $this->product_name,
            'Price' => $this->price,
            'href'=>[
                'More details'=>route('moredetails.product',$this->id),
                'Add to cart'=>route('moredetails.product',$this->id)
            ],
        ];
    }
}
