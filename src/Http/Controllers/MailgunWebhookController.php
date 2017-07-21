<?php

namespace Malcolmknott\MailgunWebhooks\Http\Controllers;

use Mail;
use App\User;
use Validator;
use Malcolmknott\MailgunWebhooks\MailgunEvent;
use Illuminate\Http\Request;
use App\Mail\TestMarkdownEmail;
use App\Http\Controllers\Controller;

class MailgunWebhookController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verify.mailgun');
    }

    /**
     * Handle a MailGun webhook call.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleWebhook(Request $request)
    {
        $user = User::where('email', request('recipient'))->first();
        $user_id = $user ? $user->id : NULL;

        $method = 'handle'.studly_case(str_replace('.', '_', strtolower($request->event)));

        if (method_exists($this, $method)) {
            return $this->{$method}($request, $user_id);
        } else {
            return $this->noMethod($request);
        }
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function noMethod($payload)
    {
        return response('Webhooked handled', 200);
    }

    /**
     * Handle delivered webhook
     * https://documentation.mailgun.com/en/latest/user_manual.html#tracking-deliveries
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function handleDelivered(Request $request, $user_id)
    {
        $headers = $this->mapHeadersToArray(request('message-headers'));

        MailgunEvent::create([
                'user_id' => $user_id,
                'message_id' => request('Message-Id'),
                'event' => request('event'),
                'recipient' => request('recipient'),
                'subject' => $headers['Subject'],
                'domain' => request('domain'),
                'message_headers' => request('message-headers'),
            ]);

        return response('Delivered webhooked handled', 200);
    }



    /**
     * Handle opens webhook
     * https://documentation.mailgun.com/en/latest/user_manual.html#tracking-opens
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function handleOpened(Request $request, $user_id)
    {
        MailgunEvent::create([
                'user_id' => $user_id,
                'message_id' => request('message-id'),
                'event' => request('event'),
                'recipient' => request('recipient'),
                'domain' => request('domain'),
                'city' => request('city'),
                'region' => request('region'),
                'country' => request('country'),
                'device_type' => request('device-type'),
                'client_name' => request('client-name'),
                'user_agent' => request('user-agent'),
                'client_os' => request('client-os'),
                'client_type' => request('client-type'),
            ]);

        return response('Opened webhooked handled', 200);
    }

    /**
     * Handle clicks webhook
     * https://documentation.mailgun.com/en/latest/user_manual.html#tracking-clicks
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function handleClicked(Request $request, $user_id)
    {
        MailgunEvent::create([
                'user_id' => $user_id,
                'message_id' => request('message-id'),
                'event' => request('event'),
                'recipient' => request('recipient'),
                'domain' => request('domain'),
                'city' => request('city'),
                'region' => request('region'),
                'country' => request('country'),
                'device_type' => request('device-type'),
                'client_name' => request('client-name'),
                'user_agent' => request('user-agent'),
                'client_os' => request('client-os'),
                'client_type' => request('client-type'),
            ]);

        return response('Clicked webhooked handled', 200);
    }

    /**
     * Handle unsubscribes webhook
     * https://documentation.mailgun.com/en/latest/user_manual.html#tracking-unsubscribes
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function handleUnsubscribed(Request $request)
    {
        return response('Unsubscribed webhooked handled', 200);
    }

    /**
     * Handle spam complaints webhook
     * https://documentation.mailgun.com/en/latest/user_manual.html#tracking-spam-complaints
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function handleComplained(Request $request)
    {
        MailgunEvent::create([
                'user_id' => $user_id,
                'message_id' => request('Message-Id'),
                'event' => request('event'),
                'recipient' => request('recipient'),
                'domain' => request('domain'),
                'city' => request('city'),
                'region' => request('region'),
                'country' => request('country'),
                'device_type' => request('device-type'),
                'client_name' => request('client-name'),
                'user_agent' => request('user-agent'),
                'client_os' => request('client-os'),
                'client_type' => request('client-type'),
            ]);

        return response('Complained webhooked handled', 200);
    }

    /**
     * Handle bounces webhook
     * https://documentation.mailgun.com/en/latest/user_manual.html#tracking-bounces
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function handleBounced(Request $request, $user_id)
    {
        $headers = $this->mapHeadersToArray(request('message-headers'));

        MailgunEvent::create([
                'user_id' => $user_id,
                'message_id' => request('Message-Id'),
                'event' => request('event'),
                'recipient' => request('recipient'),
                'subject' => $headers['Subject'],
                'domain' => request('domain'),
                'message_headers' => request('message-headers'),
                'code' => request('code'),
                'error' => request('error'),
                'notification' => request('notification'),
                'mailing_list' => request('mailing_list'),
            ]);

        return response('Bounced webhooked handled', 200);
    }

    /**
     * Handle dropped webhook
     * https://documentation.mailgun.com/en/latest/user_manual.html#tracking-failures
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function handleDropped(Request $request, $user_id)
    {
        $headers = $this->mapHeadersToArray(request('message-headers'));

        MailgunEvent::create([
                'user_id' => $user_id,
                'message_id' => request('Message-Id'),
                'event' => request('event'),
                'recipient' => request('recipient'),
                'subject' => $headers['Subject'],
                'domain' => request('domain'),
                'message_headers' => request('message-headers'),
                'code' => request('code'),
                'reason' => request('reason'),
                'description' => request('description'),
            ]);

        return response('Dropped webhooked handled', 200);
    }

    /**
     * Map headers to array
     *
     * @param  Json $headers
     * @return Collection
     */
    protected function mapHeadersToArray($headers)
    {
        return collect(json_decode($headers))
            ->mapWithKeys(function($header) {
                return [$header[0] => $header[1]];
            });
    }

}
