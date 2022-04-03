<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Repositories\Contracts\IOrderRepository;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function __invoke(CreateOrderRequest $request, IOrderRepository $repository)
    {
        try {
            $repository->create($request->validated());
        } catch (\Exception $exception) {

        }
    }
}
