<?php

namespace App\Notifications\Telegram;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class OrderStatusChangedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(protected Order $order)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['telegram'];
    }

    public function toTelegram($notifiable)
    {
        logs()->info($notifiable);
        if (!$this->order->user->telegram_id) {
            return;
        }

        logs()->info($this->order);
        return TelegramMessage::create()
            ->to($this->order->user->telegram_id)
            ->content(
                "Привет, статус твоего заказа №{$this->order->id} был изменен на: \n" .
                $this->order->status->name
            )
            ->button('Детали заказа', route('account.orders.show', $this->order));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
