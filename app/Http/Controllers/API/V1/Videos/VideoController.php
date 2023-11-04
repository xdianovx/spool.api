<?php

namespace App\Http\Controllers\API\V1\Videos;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\VideoBannersResource;
use App\Http\Resources\VideoByIdResource;
use App\Http\Resources\VideoLoadResource;
use App\Http\Resources\VideoResource;
use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }

    // cборная солянка из видео(сортируются по дате) и родительских категорий (сортируются по полю sort) каталога
    public function getVideosAndCategories()
    {
        $categories = CategoryResource::collection(Category::where('video_availability', true)->where('parent_id', 0)->orderBy('sort', 'ASC')->get());
        $banners = VideoBannersResource::collection(Video::where('ticket_availability', true)->whereNotNull('image_banner')->orderBy('event_date', 'DESC')->get());
        $videos = VideoResource::collection(Video::where('ticket_availability', true)->orderBy('event_date', 'DESC')->get());

        return response()->json([
            'categories' => $categories,
            'banners' => $banners,
            'videos' => $videos
        ]);
    }

    // получить информацию об одном видеоролике по ID 
    public function getVideoById($video_id)
    {
        try {
            $video = new VideoResource(Video::findorfail($video_id));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'status' => 'failed',
                'error' => 'Video not found'
            ], 404);
        }
        return response()->json($video);
    }

    // получить ссылку на видео(доступна только авторизованым клиентам оплатившим билет)
    public function getVideoLoad($video_id)
    {
        //Возможно усложнить метод проверки либо поменять
        $video = null;
        try {
            $video_find = Video::findOrFail($video_id);
        if($video_find->clientTickets()->where('client_id',auth('api')->user('api')->id)->where('payment_status','Payment')->exists()):
            $video = new VideoLoadResource($video_find);
        endif;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'status' => 'failed',
                'error' => 'Video not found'
            ], 404);
        }
        if($video == null):
            return response([
                'status' => 'failed',
                'error' => 'access denied'
            ], 404);
        endif;
        return response()->json($video);
    }

    // получить подкатегории (сортируются по полю sort) и видео данной категории, фильтрация (сортировка видео по просмотрам) и пагинация (по 20 видео на странице)
    public function getVideosAndCategoriesBySlag(Request $request, $category_slag = null,$cild_category_slag = null)
    {
        if(empty($category_slag)):
            return response([
                'status' => 'failed',
                'error' => 'There is no category in the request'
            ], 404);
        endif;
        try {
            if(!empty($cild_category_slag)):
                $cat = Category::where('slug', $cild_category_slag)->firstOrFail();
            else:
                $cat = Category::where('slug', $category_slag)->firstOrFail();
            endif;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'status' => 'failed',
                'error' => 'Category not found'
            ], 404);
        }

        $categories = CategoryResource::collection($cat->childrenCategories()->where('video_availability', true)->orderBy('sort', 'ASC')->get());

        $category = Category::findOrFail($cat->id);
        $category_ids = $category->getDescendants($category);
        if (empty($request->all()) == false) :
            $videos = VideoResource::collection(Video::where('ticket_availability', true)
                ->whereIn('category_id', $category_ids)
                ->orderBy('event_date', 'DESC')->paginate(20));
        else :
            $views_sort = $request->all()['views'] ?? "ASC";
            $videos = VideoResource::collection(Video::where('ticket_availability', true)
                ->whereIn('category_id', $category_ids)
                ->orderBy('views_count', $views_sort)->paginate(20));
        endif;

        return response()->json([
            'categories' => $categories,
            'videos' =>  [
                'data' => $videos,
                'meta' =>  [
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

    // Поиск
    public function getVideosAndCategoriesBySearch(Request $request)
    {
        if (request('s') == null) :
            $categories = CategoryResource::collection(Category::orderBy('id', 'DESC')->get());
        else :
            $categories = CategoryResource::collection(Category::where('name', 'ilike', '%' . request('s') . '%')->get());
        endif;
        if (request('s') == null) :
            $videos = VideoResource::collection(Video::orderBy('id', 'DESC')->get());
        else :
            $videos = VideoResource::collection(Video::where('name', 'ilike', '%' . request('s') . '%')->get());
        endif;
        return response()->json([
            'categories' => $categories,
            'videos' => $videos
        ]);
    }
}
