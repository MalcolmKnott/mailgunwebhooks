<?php

namespace Malcolmknott\MailgunWebhooks\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyMailgun
{
    /**
     * Handle an incoming request.
     *
     * Example from Mailgun docs
     * https://documentation.mailgun.com/en/latest/user_manual.html#webhooks
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // check if the timestamp is fresh
        if (abs(time() - $request->timestamp) > 15) {
            return response('Not a valid request', 401);
        }

        // check if signature is valid
        if(! hash_hmac('sha256', $request->timestamp.$request->token, config('services.mailgun.secret')) === $request->signature) {
            return response('Not a valid request, have you added api key to config ?', 401);
        }

        return $next($request);
    }
}