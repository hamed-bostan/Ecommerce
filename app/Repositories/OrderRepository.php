<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrderRepository
{
    /**
     *
     * @param array $data Data.
     * @return Model|Builder
     */
    public function create(array $data): Model|Builder
    {
        return Order::query()->create($data);
    }


}
