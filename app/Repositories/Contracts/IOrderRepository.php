<?php

namespace App\Repositories\Contracts;

use App\Models\Order;
use App\Models\Transaction;

interface IOrderRepository
{
    public function create(array $request): Order|bool;

    public function setTransaction(string $transaction_order_id, Transaction $transaction);
}
