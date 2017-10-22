<?php

namespace Malcolmknott\MailgunWebhooks\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Malcolmknott\MailgunWebhooks\MailgunEvent;

class MailgunLogController extends Controller
{
    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        $class_map = [
            'unsubscribed' => 'warning',
            'complained' => 'danger',
            'bounced' => 'warning',
            'dropped' => 'danger',
            'delivered' => 'success',
            'opened' => 'info',
            'clicked' => 'info',
        ];

        $emails = MailgunEvent::where('event', '!=', 'opened')
            ->where('event', '!=', 'clicked')
            ->orderBY('created_at', 'DESC')
            ->with('trackingEvents')
            ->paginate(50);

        return view('mailgunwebhook::mailgun.index')->with(['emails' => $emails, 'class_map' => $class_map]);
    }
}