<?php

namespace App\Notifications;

use App\Mail\NewOrderForAdmin;
use App\Mail\NewOrderForCustomer;
use App\Models\Order;
use App\Models\User;
use App\Services\Contracts\IAwsPublicLink;
use App\Services\Contracts\IInvoicesService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramMessage;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {}

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['telegram'];
//        return $notifiable->user->telegram_id
//            ? ['mail', 'telegram']
//            : ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toMail($notifiable)
    {
        $notification = is_admin($notifiable->user) ? NewOrderForAdmin::class : NewOrderForCustomer::class;

        return (new $notification($notifiable->id, $notifiable->user->full_name))->to($notifiable->user);
    }

    public function toTelegram($notifiable)
    {
        $service = app()->make(IInvoicesService::class);
        $awsPublicLink = app()->make(IAwsPublicLink::class);
        $pdf = $service->generate($notifiable)->save('s3');
        $fileLink = $awsPublicLink->generate($pdf->filename);

        $buttonLink = is_admin($notifiable->user)
            ? route('admin.orders.edit', $notifiable)
            : route('account.orders.show', $notifiable);

        logs()->info($fileLink);
        logs()->info($pdf->filename);

        return TelegramFile::create()
            ->to($notifiable->user->telegram_id)
            ->content(
                "Привет, твой заказ #{$notifiable->id} был успешно создан."
            )
            ->document($fileLink, $pdf->filename)
            ->button('Посмотреть заказ', $buttonLink);

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
