<?php

namespace App\Http\Controllers\Payments;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Transaction;
use App\Repositories\Contracts\IOrderRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalPaymentController extends Controller
{
    const PAYMENT_SYSTEM = 'PAYPAL';
    protected PayPalClient $paypalClient;

    public function __construct()
    {
        $this->paypalClient = new PayPalClient();
        $this->paypalClient->setApiCredentials(config('paypal'));
        $this->paypalClient->setAccessToken($this->paypalClient->getAccessToken());
    }

    public function create(CreateOrderRequest $request, IOrderRepository $repository)
    {
        $total = Cart::instance('cart')->total(2, '.', '');
        $invoiceId = 'invoice_id_' . time() . '_' . auth()->id();
        $paypalOrder = $this->paypalClient->createOrder([
           'intent' => 'CAPTURE',
           'purchase_units' => [
               [
                   'amount' => [
                       'currency_code' => 'USD',
                       'value' => $total
                   ],
                   'invoice_id' => $invoiceId,
               ]
           ],
        ]);
        $request = $request->validated();
        $request['vendor_order_id'] = $paypalOrder['id'];
        $request['invoice_id'] = $invoiceId;

        $order = $repository->create($request);

        return response()->json($order);
    }

    public function capture(string $orderId, IOrderRepository $repository)
    {
        DB::beginTransaction();
        try {
            $result = $this->paypalClient->capturePaymentOrder($orderId);

            if ($result['status'] === 'COMPLETED') {
                $order = Order::where('vendor_order_id', $orderId)->first();

                $order->transaction()->create([
                    'payment_system' => self::PAYMENT_SYSTEM,
                    'user_id' => auth()->id(),
                    'status' => $result['status']
                ]);

                $status = OrderStatus::paidStatus()->first();

                $order->update(['status_id' => $status->id]);
                OrderCreated::dispatch($order);
                $result['orderId'] = $order->id;
            }

            DB::commit();

            return response()->json($result);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function thankYou(Order $order)
    {
        return view('thankyou/summary', compact('order'));
    }
}
