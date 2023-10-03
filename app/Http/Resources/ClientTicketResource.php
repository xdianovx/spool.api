<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientTicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "ticket_id" => $this->ticket_id,
            "payment_status" => $this->payment_status,
            "transaction_id" => $this->transaction_id,
            "price" => $this->price
        ];
    }
}
