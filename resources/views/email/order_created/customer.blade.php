@component('mail::message')
# Introduction

Уведомление для клиента {{ $full_name }}

The body of your message.

@component('mail::button', ['url' => route('account.orders.show', $orderId)])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
