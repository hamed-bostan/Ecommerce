<?php

namespace App\Http\Resources;

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
            'Is available in store' => $this->is_available_in_store,
        ];
    }
}
