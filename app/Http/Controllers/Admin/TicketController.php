<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\TicketStoreRequest;
use App\Http\Requests\Ticket\TicketUpdateRequest;
use App\Models\Ticket;
use App\Models\Video;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::orderBy('id', 'DESC')->paginate(10);
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $videos = Video::all();
        return view('tickets.create',compact('videos'));
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }
    
    public function edit(Ticket $ticket)
    { 
        $videos = Video::all();
        return view('tickets.edit', compact('ticket','videos'));
    }

    public function store(TicketStoreRequest $request)
    {
        $data = $request->validated();
        $ticket = Ticket::firstOrCreate($data);
        $video = Video::where('id', $ticket->video_id)->first();
        if($video->ticket_availability == false):
        Video::where('id',$ticket->video_id)->update([
            'ticket_availability'=> true
        ]);
        endif;
        return redirect()->route('tickets.index')->with('status', 'ticket-created');
    }

    public function update(TicketUpdateRequest $request, $ticket_id)
    {
        $ticket = Ticket::whereId($ticket_id)->firstOrFail();
        $video_old = Video::where('id', $ticket->video_id)->first();
        if($video_old->ticket_availability == true):
            Video::where('id',$ticket->video_id)->update([
                'ticket_availability'=> false
            ]);
            endif;
        $data = $request->validated();
        $ticket->update($data);
        $video_new = Video::where('id', $ticket->video_id)->first();
        if($video_new->ticket_availability == false):
            Video::where('id',$ticket->video_id)->update([
                'ticket_availability'=> true
            ]);
            endif;
        return redirect()->route('tickets.index')->with('status', 'ticket-updated');
    }
    public function destroy(Ticket $ticket)
    {
        $video_old = Video::where('id', $ticket->video_id)->first();
        if($video_old->ticket_availability == true):
            Video::where('id',$ticket->video_id)->update([
                'ticket_availability'=> false
            ]);
        endif;
        $ticket->delete();
        return redirect()->route('tickets.index')->with('status', 'ticket-deleted');
    }

    public function search(Request $request)
    {
        if (request('search') == null):
            $tickets = Ticket::orderBy('id', 'DESC')->paginate(10);
        else:
            $tickets = Ticket::where('id', 'like', '%' . request('search') . '%')->
            orWhere('price', 'like', '%' . request('search') . '%')->
            orWhere('video_id', 'ilike', '%' . (Video::where('name',request('search'))->first()->id ?? request('search')) . '%')->paginate(10);
        endif;
        return view('tickets.index', compact('tickets'));
    }
}
