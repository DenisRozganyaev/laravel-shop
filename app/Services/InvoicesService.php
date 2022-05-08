<?php

namespace App\Services;

use App\Models\Order;
use App\Services\Contracts\IInvoicesService;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Facades\Invoice as InvoiceFacade;

class InvoicesService implements IInvoicesService
{

    public function generate(Order $order): Invoice
    {
        $items = [];
        $customer = new Buyer([
           'name' => $order->name . ' ' . $order->surname,
           'custom_fields' => [
               'email' => $order->email,
               'phone' => $order->phone,
               'country' => $order->country,
               'city' => $order->city,
               'address' => $order->address,
           ]
        ]);

        foreach($order->products as $product) {
            $items[] = (new InvoiceItem())
                ->title($product->title)
                ->pricePerUnit($product->pivot->single_price)
                ->quantity($product->pivot->quantity)
                ->units('шт');
        }

        $invoice = InvoiceFacade::make()
            ->status($order->status->name)
            ->serialNumberFormat($order->invoice_id)
            ->buyer($customer)
            ->taxRate(config('cart.tax'))
            ->filename($order->invoice_id)
            ->logo('https://itc.ua/wp-content/uploads/2022/03/rozetka.png')
            ->addItems($items);

        if ($order->in_process) {
            $invoice->payUntilDays(3);
        }

        return $invoice;
    }
}
