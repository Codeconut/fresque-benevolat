<?php

use App\Http\Controllers\Api\GlobalController;
use App\Http\Controllers\Api\SlackController;
use App\Http\Controllers\Api\TestController;
use App\Http\Middleware\HasApiKey;
use Illuminate\Support\Facades\Route;

Route::post('/slack/interactivity', [SlackController::class, 'interactivity']);
Route::get('/global/kpis', [GlobalController::class, 'kpis'])->name('global.kpis');

Route::middleware(['throttle:10,1', HasApiKey::class])->group(function () {
    Route::post('/test/mail', [TestController::class, 'mail'])->name('test.mail');
    Route::post('/test/mail/render', [TestController::class, 'renderMail'])->name('test.mail.render');
});
