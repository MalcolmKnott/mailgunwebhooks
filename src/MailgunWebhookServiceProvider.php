<?php

namespace Malcolmknott\MailgunWebhooks;

use Illuminate\Support\ServiceProvider;

class MailgunWebhookServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'mailgunwebhook');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Malcolmknott\MailgunWebhooks\Http\Controllers\MailgunWebhookController');
        $this->app->make('Malcolmknott\MailgunWebhooks\Http\Controllers\MailgunLogController');
    }
}