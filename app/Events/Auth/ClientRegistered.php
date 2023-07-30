<?php

namespace App\Events\Auth;

use App\Models\Client;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClientRegistered
{
    use Dispatchable, SerializesModels;

    public $client;

    public $password;

    public function __construct(Client $client, $password)
    {
        $this->client = $client;
        $this->password = $password;
    }
}