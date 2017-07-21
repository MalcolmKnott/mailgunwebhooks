<?php

Route::post('/mailgun/webhooks', 'Malcolmknott\MailgunWebhooks\Http\Controllers\MailgunWebhookController@handleWebhook');