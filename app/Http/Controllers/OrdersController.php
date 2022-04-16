<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Repositories\Contracts\IOrderRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function __invoke(CreateOrderRequest $request, IOrderRepository $repository)
    {
        try {
            DB::beginTransaction();
            $order = $repository->create($request->validated());
            DB::commit();
            Cart::instance('cart')->destroy();

            return redirect()->route('home')->with("success", "Your order [{$order->id}] was successfully created");
        } catch (\Exception $exception) {
            DB::rollBack();
            logs()->error($exception);
            return redirect()->back()->with("warn", $exception->getMessage());
        }
    }
}
