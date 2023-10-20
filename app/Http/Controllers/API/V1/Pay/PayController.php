<?php

namespace App\Http\Controllers\API\V1\Pay;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\ClientCard;
use App\Models\ClientTicket;
use App\Models\Ticket;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayController extends Controller
{

    public function all()
    {
        return Card::all();
    }

    public function getPayData(Request $req)
    {


        // $card_exist = Card::updateOrCreate(['TransactionId' => $req->TransactionId], [
        //     'IsTest' => $req->IsTest,
        //     'CustomFields' => $req->CustomFields,
        //     'PayoutToken' => $req->PayoutToken,
        //     'RebillId' => $req->RebillId,
        //     'ExpirationDate' => $req->ExpirationDate,
        //     'RRN' => $req->RRN,
        //     'RecurringId' => $req->RecurringId,
        //     'Subtype' => $req->Subtype,
        //     'Event' => $req->Event, // статус платежа падает в client tickets по айди транзакции 
        //     'TransactionId' => $req->TransactionId, // iD транзакции падает в client tickets
        //     'OrderId' => $req->OrderId,
        //     'Amount' => $req->Amount,
        //     'Currency' => $req->Currency,
        //     'DateTime' => $req->DateTime,
        //     'Email' => $req->Email,
        //     'Phone' => $req->Phone,
        //     'Service_Id' => $req->Service_Id,
        //     'Description' => $req->Description,
        //     'Country_Code_Alpha2' => $req->Country_Code_Alpha2,
        //     'CardMasked' => $req->CardMasked,
        //     'CardHolder' => $req->CardHolder,
        //     'Brand' => $req->Brand,
        //     'Bank' => $req->Bank,
        // ]);

        Log::info($req);

        $variable = explode(';', $req->Description);
        $result = [];
        foreach ($variable as $item) {
            list($key, $val) = explode('=', $item);
            $result[$key] = $val;
        }
        if ($req->Event == 'Payment') :
            $ticket = Ticket::find($result['ticket_id']);
            ClientTicket::updateOrCreate(['client_id' => $result['user_id'], 'ticket_id' => $result['ticket_id']], [
                'video_id' => $ticket->video->id,
                'client_id' => $result['user_id'],
                'ticket_id' => $result['ticket_id'],
                'price' => $ticket->price,
                'price_without_commission' => $ticket->price - (($ticket->price / 100) * $ticket->commission_percent),
                'payment_status' => $req->Event,
                'transaction_id' => $req->TransactionId
            ]);
            if (!ClientCard::where('bank', $req->Bank)->where('user_id', $result['user_id'])->where('card_mask', $req->CardMasked)->where('expiration_date', $req->ExpirationDate)->exists()) :
                $variable = explode(';', $req->Description);
                $result = [];
                foreach ($variable as $item) {
                    list($key, $val) = explode('=', $item);
                    $result[$key] = $val;
                }

                ClientCard::firstOrCreate([
                    'user_id' => $result['user_id'],
                    'card_mask' => $req->CardMasked,
                    'bank' => $req->Bank,
                    'rebill_id' => $req->RebillId,
                    'expiration_date' => $req->ExpirationDate,
                ]);
            endif;
        endif;

        return $req;
    }
}
