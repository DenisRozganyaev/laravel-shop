<?php
namespace App\Services\Contracts;

use App\Models\Order;
use LaravelDaily\Invoices\Invoice;

interface IInvoicesService
{
    public function generate(Order $order): Invoice;
}
