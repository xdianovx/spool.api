<?php

namespace App\Http\Controllers\API\V1\Pay;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\ClientCard;
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
        Log::info($req);

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
        if (!ClientCard::where('rebill_id', $req->RebillId)->exists()) :
            $variable = explode(';', $req->CustomFields);
            $result = [];
            foreach ($variable as $item) {
                list($key, $val) = explode('=', $item);
                $result[$key] = $val;
            }
            ClientCard::firstOrCreate([
                'user_id' => $result['user_id'],
                'card_mask' => $card_exist->CardMasked,
                'bank' => $card_exist->Bank,
                'rebill_id' => $card_exist->RebillId || 'null',
                'expiration_date' => $card_exist->ExpirationDate,
            ]);
        endif;


        return $req;
    }
}
