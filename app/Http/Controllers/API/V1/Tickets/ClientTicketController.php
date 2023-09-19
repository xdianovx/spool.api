<?php

namespace App\Http\Controllers\API\V1\Tickets;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientTicketResource;
use App\Models\Client;
use App\Models\ClientTicket;
use App\Models\Ticket;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ClientTicketController extends Controller
{
    public function getClientTicket(Request $request)
    {
        $client = Client::find(auth('api')->user('api')->id);
        $client_tickets = ClientTicketResource::collection(ClientTicket::where('client_id',$client->id)->orderBy('created_at', 'ASC')->get());
        return response()->json($client_tickets);
    }
    public function storeClientTicket(Request $request)
    {
        $client = Client::find(auth('api')->user('api')->id);
        $validator = Validator::make($request->all(), [
            'ticket_id'=> 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $purchased_ticket = ClientTicket::where('client_id',$client->id)->where('ticket_id',$validator->validated()['ticket_id'])->exists();
        $ticket = Ticket::find($validator->validated()['ticket_id']);
        if($purchased_ticket == false):
            $client->tickets_store()->firstOrCreate([
                'video_id' => $ticket->video_id,
                'price'=>  $ticket->price,
                'price_without_commission'=> $ticket->price - (($ticket->price / 100) * $ticket->commission_percent),
            ],$validator->validated());
            Video::where('id',$ticket->video_id)->increment('tickets_count');
            return response()->json([
                'message' => 'success',
                'date_purchase' => $client->value('created_at'),
            ], 200);
        else:
            return response()->json([
                'message' => 'Запись уже существует.'
            ], 200);
        endif;
        
      
    }
}
