<?php

namespace App\Http\Controllers\API\V1\Videos;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\VideoByIdResource;
use App\Http\Resources\VideoLoadResource;
use App\Http\Resources\VideoResource;
use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function getVideosAndCategories()
    {
            $categories = CategoryResource::collection(Category::where('video_availability', true)->orderBy('sort', 'ASC')->get());
            $videos = VideoResource::collection(Video::where('ticket_availability', true)->orderBy('event_date', 'DESC')->get());

            return response()->json([
                'categories'=>$categories,
                'videos' => $videos
            ]);
    }
    public function getVideoById($video_id)
    {
            $video = new VideoResource(Video::find($video_id));

            return response()->json($video);
    }

    public function getVideoLoad($video_id)
    {
            $video = new VideoLoadResource(Video::find($video_id));

            return response()->json($video);
    }

    public function getVideosAndCategoriesBySlag(Request $request,$category_slag)
    {
        $cat = Category::where('slug', $category_slag)->first();
        $child_categories = Category::where('video_availability', true)->where('parent_id', $cat->id)->orderBy('sort', 'ASC')->get();
        $categories = CategoryResource::collection($child_categories);
        $category = Category::find($cat->id);
        $category_ids = $category->getDescendants($category);
        if(empty($request->all()) == false):
            $views_sort = $request->all()['views'] ?? "ASC";
            $videos = VideoResource::collection(Video::where('ticket_availability', true)
            ->whereIn('category_id', $category_ids)
            ->orderBy('views_count', $views_sort)->paginate(10));
        else:
            $videos = VideoResource::collection(Video::where('ticket_availability', true)
            ->whereIn('category_id', $category_ids)
            ->orderBy('event_date', 'DESC')->paginate(10));
        endif;

        return response()->json([
            'categories'=>$categories,
             'videos' =>  [
                'data'=> $videos,
                'meta'=>  [
                    'current_page' => $videos->currentPage(),
                    'first_page_url' => $videos->url(1),
                    'from' => $videos->firstItem(),
                    'last_page' => $videos->lastPage(),
                    'last_page_url' => $videos->url($videos->lastPage()),
                    'next_page_url' => $videos->nextPageUrl(),
                    'path' => $videos->path(),
                    'per_page' => $videos->perPage(),
                    'prev_page_url' => $videos->previousPageUrl(),
                    'to' => $videos->lastItem(),
                    'total' => $videos->total(),
                ]
             ],

        ]);
    }
    public function getVideosAndCategoriesBySearch(Request $request)
    {
        if (request('s') == null):
            $categories = CategoryResource::collection(Category::orderBy('id', 'DESC')->get());
        else:
            $categories = CategoryResource::collection(Category::where('name', 'ilike', '%' . request('s') . '%')->get());
        endif;
        if (request('s') == null):
            $videos = VideoResource::collection(Video::orderBy('id', 'DESC')->get());
        else:
            $videos = VideoResource::collection(Video::where('name', 'ilike', '%' . request('s') . '%')->get());
        endif;
        return response()->json([
            'categories'=>$categories,
            'videos' => $videos
        ]);
    }
}
