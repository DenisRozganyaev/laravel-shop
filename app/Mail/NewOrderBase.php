<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderBase extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        protected int $orderId,
        protected string $full_name
    )
    {
        logs()->debug(self::class . ' => ' . $this->orderId . ' => ' . $this->full_name);
    }
}
