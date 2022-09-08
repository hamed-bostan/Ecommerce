<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProductRepository
{
    /**
     *
     * @param array $data Data.
     * @return Model|Builder
     */
    public function create(array $data): Model|Builder
    {
        return Product::query()->create($data);
    }
}
