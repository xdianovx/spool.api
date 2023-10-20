<?php

namespace App\Http\Resources;

use App\Models\Ticket;
use App\Models\Video;
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
            "transaction_id" => $this->transaction_id,
            "price" => $this->price,
            "video" =>  VideoResource::collection(Video::where('id',$this->video->id)->get())
        ];
    }
}
