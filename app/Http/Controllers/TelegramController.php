<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function handle(Request $request)
    {
        $update = Telegram::commandsHandler(true);

        // Mendapatkan pesan dari user
        $message = $update->getMessage();
        $chatId = $message->getChat()->getId();
        $text = $message->getText();

        // Membalas pesan
        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => "Anda mengirim: " . $text
        ]);

        return response()->json(['ok' => true]);
    }

    public function sendMessage($chatId, $message)
    {
        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => $message
        ]);
    }

    public function setWebhook()
    {
        $url = '/api/telegram/webhook';
        $response = Telegram::setWebhook(['url' => $url]);

        return $response;
    }
}
