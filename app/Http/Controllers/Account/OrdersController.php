<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    public function index()
    {
        $orders = auth()->user()->orders()->paginate(5);

        return view('account/orders/index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('account/orders/show', compact('order'));
    }

    public function cancel(Order $order)
    {
        if ($order->is_canceled || $order->is_completed) {
            return redirect()->back()->with('error', 'Order already completed or canceled!');
        }

        if ($order->is_paid) {
            $order->user->update([
                'balance' => $order->user->balance + $order->total
            ]);
        }

        $status = OrderStatus::where('name', config('constants.db.order_statuses.cancel'))->first();
        $order->update(['status_id' => $status->id]);

        return redirect()->back()->with('success', 'Order was canceled!');
    }
}
