<?php

namespace App\Http\Controllers\API\V1\Tickets;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function getTickets()
    {
        $tickets = TicketResource::collection(Ticket::all());
        return response()->json($tickets);
    }
}
