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
        $stats = View::select(
            DB::raw('DATE(created_at) AS date'),
            DB::raw('COUNT(*) AS count')
        )
            ->where('video_id', $video->id)
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy(
                DB::raw('DATE(created_at)')
            )
            ->orderBy(
                DB::raw('DATE(created_at)')
            )
            ->get();

        foreach ($stats as $value) {
            $statsArr[] =  [$value->date, $value->count];
        }

        return $statsArr;
    }

    public function showView(Video $video)
    {
        $sum_tickets = 0;
        $views = View::where('video_id', $video->id)->orderBy('created_at', 'DESC')->paginate(10);
        $tickets = ClientTicket::where('video_id', $video->id)->get();
        foreach ($tickets as $ticket) :
            $sum_tickets = $sum_tickets + $ticket->price;
        endforeach;
        $comission = ($sum_tickets / 100) * $video->partner_company->commission;
        $ticket_without_comission = $sum_tickets - $comission;
        return view('admin_views.show', compact('video', 'sum_tickets', 'views', 'ticket_without_comission'));
    }

    public function searchView(Request $request)
    {
        if (request('search') == null) :
            $videos = Video::orderBy('id', 'DESC')->paginate(10);
        else :
            $videos = Video::where('name', 'ilike', '%' . request('search') . '%')->orWhere('category_id', 'ilike', '%' . (Category::where('name', request('search'))->first()->id ?? request('search')) . '%')->orWhere('event_date', 'like', '%' . request('search') . '%')->paginate(10);
        endif;

        return view('admin_views.index', compact('videos'));
    }
}
