<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Models\Transaction;
use App\Repositories\Contracts\IOrderRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalPaymentController extends Controller
{
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

        $paypalOrder = $this->paypalClient->createOrder([
           'intent' => 'CAPTURE',
           'purchase_units' => [
               [
                   'amount' => [
                       'currency_code' => 'USD',
                       'value' => $total
                   ]
               ]
           ]
        ]);
        $request = $request->validated();
        $request['vendor_order_id'] = $paypalOrder['id'];

        $order = $repository->create($request);

        return response()->json($order);
    }

    public function capture(string $orderId, IOrderRepository $repository)
    {
        DB::beginTransaction();
        try {
            $result = $this->paypalClient->capturePaymentOrder($orderId);
            dd($result);
            if ($result['status'] === 'COMPLETED') {
                $transaction = new Transaction();
                $transaction->vendor_payment_id = $result['id'];
                $transaction->payment_system = 'PAYPAL';
                $transaction->user_id = auth()->id();
                $transaction->status = $result['status'];
                $transaction->save();

                $repository->setTransaction($result['id'], $transaction);
            }

            DB::commit();

            return response()->json($result);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
