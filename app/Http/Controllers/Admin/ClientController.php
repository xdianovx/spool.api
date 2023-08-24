<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('id', 'DESC')->paginate(10);
        return view('clients.index', compact('clients'));
    }


    public function show($client)
    {
        $client = Client::whereId($client)->firstOrFail();
        return view('clients.show', compact('client'));
    }

    public function send_ban($client)
    {
        $client = Client::whereId($client)->firstOrFail();
        if(!empty($client->blocked_at)){
            $data = ['blocked_at'=> NULL];
            $client->update($data);
            return redirect()->route('clients.index')->with('status', 'account-unbanned');
        }
        if(empty($client->blocked_at)){
            $data = ['blocked_at'=>Carbon::now()];
            $client->update($data);
            return redirect()->route('clients.index')->with('status', 'account-banned');
        }
    }
    public function destroy($client)
    {
        $client = Client::whereId($client)->firstOrFail();
        $client->delete();
        return redirect()->route('clients.index')->with('status', 'account-deleted');
    }

    public function search(Request $request)
    {
        
        if (request('search') == null):
            $clients = Client::orderBy('id', 'DESC')->paginate(10);
         else:
            $clients = Client::where('name', 'like', '%' . request('search') . '%')->
            orWhere('id', 'like', '%' . request('search') . '%')->
            orWhere('email', 'like', '%' . request('search') . '%')->
            orWhere('name', 'like', '%' . request('search') . '%')->paginate(10);
         endif;

        return view('clients.index', compact('clients'));
    }
}
