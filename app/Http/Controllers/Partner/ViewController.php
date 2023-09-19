<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ClientTicket;
use App\Models\Video;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function index()
    {
        $videos = Video::where('partners_company_id',Auth::user()->partner_company_id)->orderBy('id', 'DESC')->paginate(10);
        
        return view('partners_views.index', compact('videos'));
    }

    public function show(Video $video)
    {
        $sum_tickets = 0;
        $views = View::where('video_id', $video->id)->orderBy('created_at', 'DESC')->paginate(10);
        $tickets = ClientTicket::where('video_id', $video->id)->get();
        foreach($tickets as $ticket):
            $sum_tickets = $sum_tickets + $ticket->price;
        endforeach;
        $comission = ($sum_tickets / 100) * $video->partner_company->comission_percent;
        $ticket_without_comission = $sum_tickets - $comission;
        return view('partners_views.show', compact('video','sum_tickets','views','ticket_without_comission'));
    }

    public function search(Request $request) 
    {
        if (request('search') == null):
            $videos = Video::orderBy('id', 'DESC')->paginate(10);
        else:
            $videos = Video::where('name', 'ilike', '%' . request('search') . '%')->
            orWhere('category_id', 'ilike', '%' . (Category::where('name',request('search'))->first()->id ?? request('search')) . '%')->
            orWhere('event_date', 'like', '%' . request('search') . '%')->paginate(10);
        endif;

        return view('partners_views.index', compact('videos'));
    }
}
