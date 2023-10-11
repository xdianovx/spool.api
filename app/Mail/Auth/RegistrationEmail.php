<?php

namespace App\Mail\Auth;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;

    public $password;

    public function __construct(Client $client, $password)
    {
        $this->client = $client;
        $this->password = $password;
    }

    public function build()
    {
        return $this->markdown('emails.auth.registration_login')
            ->subject("Временный пароль")
            ->from(config('mail.from.address'));
    }
}