<?php

namespace Malcolmknott\MailgunWebhooks;

use Illuminate\Database\Eloquent\Model;

class MailgunEvent extends Model
{
    protected $guarded = [];

    /**
     * Remove < > from message id.
     *
     * @param  string  $value
     * @return void
     */
    public function setMessageIdAttribute($value)
    {
        $this->attributes['message_id'] = preg_replace('/[<>]/', '', $value);
    }
}