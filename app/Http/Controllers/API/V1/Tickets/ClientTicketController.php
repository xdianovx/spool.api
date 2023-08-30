<?php

namespace App\Http\Controllers\API\V1\Tickets;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientTicketResource;
use App\Models\Client;
use App\Models\ClientTicket;
use App\Models\Ticket;
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
            'price'=> 'required|integer',
            'ticket_id'=> 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $purchased_tickets = ClientTicket::where('client_id',$client->id)->where('ticket_id',$validator->validated()['ticket_id'])->exists();
        if($purchased_tickets == false):
            $client->tickets_store()->firstOrCreate([
                'video_id' => Ticket::find($validator->validated()['ticket_id'])->video_id
            ],$validator->validated());
            return response()->json([
                'message' => 'success',
                'date_purchase' => $client->value('created_at'),
            ], 200);
        else:
            return response()->json([
                'message' => 'record already exists!'
            ], 200);
        endif;
        
      
    }
}
