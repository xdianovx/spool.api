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
use Illuminate\Support\Str;
use GuzzleHttp\Client as GuzzleClient;
use Validator;

class ClientTicketController extends Controller
{
    public function getClientTicket(Request $request)
    {
        $client = Client::find(auth('api')->user('api')->id);
        $client_tickets = ClientTicketResource::collection(ClientTicket::where('client_id', $client->id)->orderBy('created_at', 'ASC')->get());
        return response()->json($client_tickets);
    }

    public function rebillClientTicket(Request $req)
    {

        function random_str($length = 32)
        {
            return bin2hex(random_bytes($length / 2));
        }

        $length = 20;
        $rand_str = random_str($length);
        $orderId = Str::uuid();
        $req_id =  $rand_str;
        $method = 'POST';
        $url = '/payments/requests/rebill';
        $body = [
            'OrderId' => $orderId,
            "RebillId" => $req->rebill_id,
            'Amount' => $req->amount,
            'Currency' => $req->currency,
            'Description' => $req->description,
        ];

        $bodyToJson = json_encode($body, JSON_PRETTY_PRINT);
        $data = $method . PHP_EOL . $url  . PHP_EOL . env('PAY_SITE_ID') . PHP_EOL . $req_id . PHP_EOL . $bodyToJson;
        $signature = hash_hmac('sha256', $data, env('PAY_SECRET'), false);
        $client = new GuzzleClient();
        $res = $client->request(
            'POST',
            'https://gw.payselection.com/payments/requests/rebill',
            [
                'headers' => [
                    'X-SITE-ID' => env('PAY_SITE_ID'),
                    'X-REQUEST-ID' => $req_id,
                    'X-REQUEST-SIGNATURE' => $signature
                ],
                'body' => $bodyToJson,
            ]
        );

        return response()->json(json_decode($res->getBody()->getContents()));
    }

    // Покупка

    public function storeClientTicket(Request $request)
    {
        $client = Client::find(auth('api')->user('api')->id);
        $pay_status = '';

        $validator = Validator::make($request->all(), [
            'ticket_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $purchased_ticket = ClientTicket::where('client_id', $client->id)->where('ticket_id', $validator->validated()['ticket_id'])->exists();

        $ticket = Ticket::find($validator->validated()['ticket_id']);

        if ($purchased_ticket === false) :
            function random_str($length = 32)
            {
                return bin2hex(random_bytes($length / 2));
            }

            $length = 20;
            $rand_str = random_str($length);
            $orderId = Str::uuid();
            $req_id =  $rand_str;
            $method = 'POST';
            $url = '/payments/requests/single';
            $body = [
                'OrderId' => $orderId,
                'Amount' => $request->amount,
                'Currency' => $request->currency,
                'Description' => $request->description,
                'RebillFlag' => true,
                "PaymentMethod" => "Cryptogram",
                "ExtraData" => ['user_id' => auth('api')->user('api')->id],
                "CustomerInfo" => [
                    "IP" => $request->ip,
                ],
                "PaymentDetails" => [
                    "Value" =>  $request->token
                ]
            ];

            $bodyToJson = json_encode($body, JSON_PRETTY_PRINT);
            $data = $method . PHP_EOL . $url  . PHP_EOL . env('PAY_SITE_ID') . PHP_EOL . $req_id . PHP_EOL . $bodyToJson;
            $signature = hash_hmac('sha256', $data, env('PAY_SECRET'), false);
            $payreq = new GuzzleClient();
            $res = $payreq->request(
                'POST',
                'https://gw.payselection.com/payments/requests/single',
                [
                    'headers' => [
                        'X-SITE-ID' => env('PAY_SITE_ID'),
                        'X-REQUEST-ID' => $req_id,
                        'X-REQUEST-SIGNATURE' => $signature
                    ],
                    'body' => $bodyToJson,
                ]
            );

            $client->tickets_store()->firstOrCreate([
                'video_id' => $ticket->video_id,
                'price' =>  $ticket->price,
                'price_without_commission' => $ticket->price - (($ticket->price / 100) * $ticket->commission_percent),
            ], $validator->validated());

            Video::where('id', $ticket->video_id)->increment('tickets_count');

            return response()->json([
                'message' => 'success',
                'date_purchase' => $client->value('created_at'),
                'pay_data' => json_decode($res->getBody()->getContents())
            ], 200);

        else :
            return response()->json([
                'message' => 'Билет уже приобретен.'
            ], 200);
        endif;
    }
}
