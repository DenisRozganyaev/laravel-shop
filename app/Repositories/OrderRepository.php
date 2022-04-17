<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Repositories\Contracts\IOrderRepository;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderRepository implements IOrderRepository
{
    public function create(array $request): Order|bool
    {
        $user = auth()->user();
        $total = Cart::instance('cart')->total(2, '.', '');

        if ($user->balance < $total) {
            return false;
        }

        $status = OrderStatus::defaultStatus()->first();

        $request = array_merge($request, [
            'status_id' => $status->id,
            'total' => $total
        ]);
        $order = $user->orders()->create($request);

        $this->addProductsToOrder($order);

        return $order;
    }

    protected function addProductsToOrder($order)
    {
        Cart::instance('cart')->content()->each(function($product) use ($order) {
            $order->products()->attach(
                $product->model,
                [
                    'quantity' => $product->qty,
                    'single_price' => $product->price
                ]
            );

            $in_stock = $product->model->in_stock - $product->qty;

            if (!$product->model->update(['in_stock' => $in_stock])) {
                throw new \Exception("Something went wrong with product id={$product->id} while updating process", 200);
            }
        });
    }
}
