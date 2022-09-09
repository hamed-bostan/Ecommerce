<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserRepository
{
    /**
     *
     * @param array $data Data.
     * @return Model|Builder
     */
    public function create(array $data): Model|Builder
    {
        return User::query()->create($data);
    }
}
