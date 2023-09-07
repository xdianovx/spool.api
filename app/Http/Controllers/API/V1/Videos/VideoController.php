<?php

namespace App\Http\Controllers\API\V1\Videos;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function getVideos(Request $request)
    {

        if(empty($request->all()) == false):
            $videos = VideoResource::collection(Video::where('ticket_availability', true)->orderBy('views_count', $request->all()['views'])->get());
        else:
            $videos = VideoResource::collection(Video::where('ticket_availability', true)->orderBy('event_date', 'DESC')->get());
        endif;
        return response()->json($videos);
    }
    public function getVideosBySlag($category_slag)
    {
        $category = Category::where('slug', $category_slag)->first();
        // dd($category->id);
        $videos = VideoResource::collection(Video::where('ticket_availability', true)->where('category_id', $category->id)->get());

        return response()->json($videos);
    }
    public function getVideosAndCategoriesBySearch(Request $request)
    {
        if (request('s') == null):
            $category = Category::orderBy('id', 'DESC')->get();
        else:
            $category = Category::where('name', 'ilike', '%' . request('s') . '%')->get();
        endif;
        if (request('s') == null):
            $videos = VideoResource::collection(Video::orderBy('id', 'DESC')->get());
        else:
            $videos = VideoResource::collection(Video::where('name', 'ilike', '%' . request('s') . '%')->get());
        endif;
        return response()->json([$category,$videos]);
    }
}
