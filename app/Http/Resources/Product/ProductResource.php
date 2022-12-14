<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'ID' =>$this->id,
            'Product name' => $this->product_name,
            'Price' => $this->price,
            'Color' => $this->color,
            'Stock' => $this->stock == 0 ? 'Out of order' : $this->stock,
            'Quantity' => $this->quantity,
            'Discount' => $this->discount,
//           'Total price after discount' => round((1 - ($this->discount/100 )) * $this -> price,2),
            'Rating' => $this->count('star') > 0 ? round($this->sum('star') / $this->count('star'),2) : 'No reviews yes',
            'Sales number' => $this->sales_number,
//            'href'=>[
//                'MoreDetails'=> route('')
//            ]
        ];
    }
}
