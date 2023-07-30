<?php

namespace App\Listeners\Auth;

use App\Events\Auth\ClientRegistered;
use App\Mail\Auth\RegistrationEmail;
use Illuminate\Support\Facades\Mail;

class SendRegisterNotification
{
    public function handle(ClientRegistered $event)
    {
        Mail::to($event->client->email)->send(new RegistrationEmail($event->client, $event->password));
    }
}