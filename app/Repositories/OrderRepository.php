<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Contracts\IOrderRepository;

class OrderRepository implements IOrderRepository
{

    public function create(array $request): Order
    {
    }
}
