<?php

namespace App\Http\Controllers\Account\Socials;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use pschocke\TelegramLoginWidget\Facades\TelegramLoginWidget;

class TelegramCallbackController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(Request $request)
    {
        if (!$telegramUser = TelegramLoginWidget::validate($request)) {
            return redirect()->back()->with('warn', 'error');
        }

        auth()->user()->update([
           'telegram_id' => $telegramUser->get('id')
        ]);

        return redirect()->back()->with('success', 'Congratulations. You\'re successfully added our chat bot.');
    }
}
