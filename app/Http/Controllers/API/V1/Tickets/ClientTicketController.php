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
        /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    public function getClientTicket(Request $request)
    {
        $client = Client::findOrFail(auth('api')->user('api')->id);
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
            "user_id" => $req->user_id,
            "ticket_id" => $req->ticket_id
            
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

   
}
