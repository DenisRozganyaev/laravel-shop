<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Contracts\IInvoicesService;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function download(Order $order, IInvoicesService $invoicesService)
    {
        return $invoicesService->generate($order)->download();
    }
}
