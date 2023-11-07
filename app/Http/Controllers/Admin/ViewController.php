<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ViewResource;
use App\Models\Category;
use App\Models\ClientTicket;
use App\Models\Video;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    public function indexView()
    {
        $videos = Video::orderBy('id', 'DESC')->paginate(10);

        return view('admin_views.index', compact('videos'));
    }


    public function getVideoViews(Video $video)
    {
        $statsArr = [];
        $stats = View::select(DB::raw('MAX(created_at) AS date'), DB::raw('COUNT(id) AS count'))
            ->where('video_id', $video->id)
            ->groupBy(
                DB::raw("DATE_TRUNC('HOUR', created_at)"),
            )->get();

        foreach ($stats as $value) {
            $statsArr[] =  [$value->date, $value->count];
        }

        return $statsArr;
    }

    public function showView(Video $video)
    {

        $sum_tickets = 0;
        $sum_without_commission = 0;
        $views = $video->views()->orderBy('created_at', 'DESC')->paginate(10);
        $tickets = $video->clientTickets()->where('video_id', $video->id)->where('payment_status', 'Payment')->get();

        foreach ($tickets as $ticket) :
            $sum_tickets = $sum_tickets + $ticket->price;
            $sum_without_commission = $sum_without_commission + $ticket->price_without_commission;
        endforeach;

        return view('admin_views.show', compact('video', 'sum_tickets', 'views', 'sum_without_commission'));
    }
}
