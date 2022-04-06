<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Repositories\Contracts\IOrderRepository;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrdersController extends Controller
{
    public function __invoke(CreateOrderRequest $request, IOrderRepository $repository)
    {
        try {
            $order = $repository->create($request->validated());
            Cart::instance('cart')->destroy();

            return redirect()->route('home')->with("success", "Your order [{$order->id}] was successfully created");
        } catch (\Exception $exception) {
            logs()->error($exception);
            return redirect()->back()->with("warn", $exception->getMessage());
        }
    }
}
