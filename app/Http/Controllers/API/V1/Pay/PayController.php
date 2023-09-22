<?php

namespace App\Http\Controllers\API\V1\Pay;

use App\Http\Controllers\Controller;
use App\Models\Card;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class PayController extends Controller
{
    public function pay(Request $req)
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
        $url = '/payments/requests/single';
        $body = [
            'OrderId' => $orderId,
            'Amount' => $req->amount,
            'Currency' => $req->currency,
            'Description' => $req->description,
            'RebillFlag' => false,
            "PaymentMethod" => "Cryptogram",
            "CustomerInfo" => [
                "IP" => $req->ip
            ],
            "PaymentDetails" => [
                "Value" =>  $req->token
            ]
        ];

        $bodyToJson = json_encode($body, JSON_PRETTY_PRINT);
        $data = $method . PHP_EOL . $url  . PHP_EOL . env('PAY_SITE_ID') . PHP_EOL . $req_id . PHP_EOL . $bodyToJson;
        $signature = hash_hmac('sha256', $data, env('PAY_SECRET'), false);
        $client = new Client();
        $res = $client->request(
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

        return response()->json(json_decode($res->getBody()->getContents()));
    }

    public function rebill(Request $req)
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
        $client = new Client();
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

    public function all()
    {
        return Card::all();
    }

    public function getPayData(Request $req)
    {

        $card_exist = Card::updateOrCreate(['TransactionId' => $req->TransactionId], [
            'IsTest' => $req->IsTest,
            'CustomFields' => $req->CustomFields,
            'PayoutToken' => $req->PayoutToken,
            'RebillId' => $req->RebillId,
            'ExpirationDate' => $req->ExpirationDate,
            'RRN' => $req->RRN,
            'RecurringId' => $req->RecurringId,
            'Subtype' => $req->Subtype,
            'Event' => $req->Event,
            'TransactionId' => $req->TransactionId,
            'OrderId' => $req->OrderId,
            'Amount' => $req->Amount,
            'Currency' => $req->Currency,
            'DateTime' => $req->DateTime,
            'Email' => $req->Email,
            'Phone' => $req->Phone,
            'Service_Id' => $req->Service_Id,
            'Description' => $req->Description,
            'Country_Code_Alpha2' => $req->Country_Code_Alpha2,
            'CardMasked' => $req->CardMasked,
            'CardHolder' => $req->CardHolder,
            'Brand' => $req->Brand,
            'Bank' => $req->Bank,
        ]);


        return $req;
    }
}
