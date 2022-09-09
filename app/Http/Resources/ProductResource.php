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
            'Stock' => $this->stock == 0 ? 'Out of order' : $this->stock,
            'Quantity' => $this->quantity,
            'Discount' => $this->discount,
            'Total price after discount' => round((1 - ($this->discount/100 )) * $this -> price,2),
            'Rating' => $this->star->count() > 0 ? round($this->star->sum('star')/ $this->star->count(),2) : 'No rating yet' ,
            'Sales number' => $this->sales_number,
        ];
    }
}
