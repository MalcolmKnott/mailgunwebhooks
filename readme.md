# Laravel package to handle webhooks from Mailgun

This composer package handles webhooks from Mailgun saving them to mailgun_events table in your database.

## Installation

Begin by pulling in the package through Composer.

```bash
composer require malcolmknott/mailgunwebhooks
```

If using Laravel 5, include the service provider within your `config/app.php` file.

```php
'providers' => [
    Malcolmknott\MailgunWebhooks\MailgunWebhookServiceProvider::class,
];
```

Next you must register the `VerifyMailgun` middleware in your `app\Http\Kernel.php` file.

```php
protected $routeMiddleware = [
	'verify.mailgun' => \Malcolmknott\MailgunWebhooks\Http\Middleware\VerifyMailgun::class,
];
```

Run the migration for the `mailgun_events` table.

```bash
php artisan migrate
```

## Usage

Log into your Mailgun account and update the webhook urls to [your-domain]/mailgun/webhooks
https://app.mailgun.com/app/webhooks

You will need to turn on click and open tracking in the domains section of Mailgun admin.