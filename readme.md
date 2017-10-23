# Laravel package to handle webhooks from Mailgun

This composer package handles webhooks from Mailgun creating a log of sent mail with tracking events.

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

Next you must register the `VerifyMailgun` middleware in your `app/Http/Kernel.php` file.

```php
protected $routeMiddleware = [
	'verify.mailgun' => \Malcolmknott\MailgunWebhooks\Http\Middleware\VerifyMailgun::class,
];
```

Run the migration to create tables.

```bash
php artisan migrate
```

## Usage

Log into your Mailgun account and update the webhook urls to [your-domain]/mailgun/webhooks
https://app.mailgun.com/app/webhooks

You will need to turn on click and open tracking in the domains section of Mailgun admin.

## Frontend / View

If you have a new project scaffold the basic login and registration views to pull in Boostrap.
Or publish the view file to use your own layout.

```bash
php artisan make:auth
```

Publish the view file to change the format and add your own style.

```bash
php artisan vendor:publish --provider="Malcolmknott\MailgunWebhooks\MailgunWebhookServiceProvider" --tag="views"
```

Add a route that points to the Mailgun Log Controller, you'll probably want to add some middleware to restrict who can view your log.

```php
Route::get('display-log', '\Malcolmknott\Mailgunwebhooks\Http\Controllers\MailgunLogController@index');
```