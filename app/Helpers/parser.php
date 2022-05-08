<?php

if (!function_exists('parseInvoiceIdFromPaypalCapture')) {
    function parseInvoiceIdFromPaypalCapture(array $request): string|null
    {
        return $request['purchase_units'][0]['payments']['captures'][0]['invoice_id'] ?? null;
    }
}
