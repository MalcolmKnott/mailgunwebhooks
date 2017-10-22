<?php

namespace Malcolmknott\MailgunWebhooks;

use Illuminate\Database\Eloquent\Model;

class MailgunTrackingEvent extends Model
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


    public function events()
    {
        return $this->belongsTo(\Malcolmknott\MailgunWebhooks\MailgunEvent::class);
    }
}