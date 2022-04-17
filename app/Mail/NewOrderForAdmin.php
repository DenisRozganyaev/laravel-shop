<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderForAdmin extends NewOrderBase
{
    public function build()
    {
        return $this->markdown('email.order_created.admin')
            ->with(['order_id' => $this->orderId, 'full_name' => $this->full_name]);
    }
}
