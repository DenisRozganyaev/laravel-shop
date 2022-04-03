<?php

namespace App\Repositories\Contracts;

use App\Models\Order;

interface IOrderRepository
{
    public function create(array $request): Order;
}
