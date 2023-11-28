<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientUpdateRequest;
use App\Models\Client;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {

        $clients = Client::orderBy('id', 'DESC')->paginate(10);
        return view('clients.index', compact('clients'));
    }


    public function show(Client $client)
    {
        $client_tickets = $client->tickets_store()->paginate(10);
        return view('clients.show', compact('client','client_tickets'));
    }

    public function send_ban(Client $client)
    {
        if(!empty($client->blocked_at)){
            $data = ['blocked_at'=> NULL];
            $client->update($data);
            return redirect()->route('clients.index')->with('status', 'account-unbanned');
        }
        if(empty($client->blocked_at)){
            $data = ['blocked_at'=>Carbon::now('Europe/Moscow')->shiftTimezone('UTC')];
            $client->update($data);
            return redirect()->route('clients.index')->with('status', 'account-banned');
        }
    }


    public function edit(Client $client)
    { 

        $countries = Country::all();
        $country_is_null = empty($client->country_id);
        return view('clients.edit', compact('client','countries','country_is_null'));
    }

    public function update(ClientUpdateRequest $request, $client_id)
    {
        
        $data = $request->validated(); 
         // Если есть файл
         if ($request->hasFile('avatar_image')) {
            // Имя и расширение файла
            $filenameWithExt = $request->file('avatar_image')->getClientOriginalName();
            // Только оригинальное имя файла
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = str_replace(' ', '_', $filename);
            // Расширение
            $extention = $request->file('avatar_image')->getClientOriginalExtension();
            // Путь для сохранения
            $fileNameToStore = "avatar_image/" . $filename . "_" . time() . "." . $extention;
            // Сохраняем файл
            $data['image_banner'] = $request->file('avatar_image')->storeAs('public', $fileNameToStore);
     
        }
        $client = Client::whereId($client_id)->firstOrFail();
        $client->update($data);
        return redirect()->route('clients.index')->with('status', 'account-updated');
    }


    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('status', 'account-deleted');
    }

    public function search(Request $request)
    {
        
        if (request('search') == null):
            $clients = Client::orderBy('id', 'DESC')->paginate(10);
         else:
            $clients = Client::where('name', 'ilike', '%' . request('search') . '%')->
            orWhere('id', 'like', '%' . request('search') . '%')->
            orWhere('email', 'ilike', '%' . request('search') . '%')->
            orWhere('name', 'ilike', '%' . request('search') . '%')->paginate(10);
         endif;

        return view('clients.index', compact('clients'));
    }
}
