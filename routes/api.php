<?php

use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Route;

Route::post('/telegram/webhook', [TelegramController::class, 'handle']);
Route::get('/telegram/set-webhook', [TelegramController::class, 'setWebhook']);

Route::get('/bot', [TelegramController::class, 'bot']);
