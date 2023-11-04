<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\VideoStoreRequest;
use App\Http\Requests\Video\VideoUpdateRequest;
use App\Models\Category;
use App\Models\ClientTicket;
use App\Models\Partners_company;
use App\Models\Tag;
use App\Models\Ticket;
use App\Models\Video;
use App\Models\View;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('display_slider', 'DESC')->paginate(10);

        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        // $url = 'https://cdn.spoolapp.ru/secret/';
        // $client = Http::get($url)->body();
        // $res = json_decode($client);
        // return response()->json($res);
        $partner_companies = Partners_company::all();
        $categories = Category::all();
        return view('videos.create', compact('partner_companies', 'categories'));
    }

    public function show(Video $video)
    {
        return view('videos.show', compact('video'));
    }

    public function edit(Video $video)
    {
        // $url = 'https://cdn.spoolapp.ru/secret/';
        // $client = Http::get($url)->body();
        // $res = json_decode($client);
        $user_tags = $video->tags()->where('user_id', Auth::user()->id)->paginate(1000);
        $partner_companies = Partners_company::all();
        $categories = Category::all();
        return view('videos.edit', compact('video', 'partner_companies', 'categories', 'user_tags'));
    }

    public function store(VideoStoreRequest $request)
    {

        $data = $request->validated();
        if ($request->hasFile('image')) {
            // Имя и расширение файла
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Только оригинальное имя файла
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = str_replace(' ', '_', $filename);
            // Расширение
            $extention = $request->file('image')->getClientOriginalExtension();
            // Путь для сохранения
            $fileNameToStore = "image/" . $filename . "_" . time() . "." . $extention;
            // Сохраняем файл
            $data['image'] = $request->file('image')->storeAs('public', $fileNameToStore);
        }
        if ($request->hasFile('image_banner')) {
            // Имя и расширение файла
            $filenameWithExt = $request->file('image_banner')->getClientOriginalName();
            // Только оригинальное имя файла
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = str_replace(' ', '_', $filename);
            // Расширение
            $extention = $request->file('image_banner')->getClientOriginalExtension();
            // Путь для сохранения
            $fileNameToStore = "image_banner/" . $filename . "_" . time() . "." . $extention;
            // Сохраняем файл
            $data['image_banner'] = $request->file('image_banner')->storeAs('public', $fileNameToStore);
        }

        $video = Video::firstOrCreate($data);
        if ($video->category->video_availability == false) :
            $video->category->update([
                'video_availability' => true
            ]);

            if($video->category->parent()->exists()):
                $video->category->parent->update([
                    'video_availability' => true
                ]);
            endif;
        endif;
        return redirect()->route('video.edit', $video->id)->with('status', 'video-created');
    }

    public function update(VideoUpdateRequest $request, $video_id)
    {
        $data = $request->validated();

        $video = Video::whereId($video_id)->firstOrFail();
        //$category = Category::where('id', $video->category_id)->first();

        //print_r($categories);

        if ($request->hasFile('image')) {
            // Имя и расширение файла
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Только оригинальное имя файла
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = str_replace(' ', '_', $filename);
            // Расширение
            $extention = $request->file('image')->getClientOriginalExtension();
            // Путь для сохранения
            $fileNameToStore = "image/" . $filename . "_" . time() . "." . $extention;
            // Сохраняем файл
            $data['image'] = $request->file('image')->storeAs('public', $fileNameToStore);
        }
        if ($request->hasFile('image_banner')) {
            // Имя и расширение файла
            $filenameWithExt = $request->file('image_banner')->getClientOriginalName();
            // Только оригинальное имя файла
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = str_replace(' ', '_', $filename);
            // Расширение
            $extention = $request->file('image_banner')->getClientOriginalExtension();
            // Путь для сохранения
            $fileNameToStore = "image_banner/" . $filename . "_" . time() . "." . $extention;
            // Сохраняем файл
            $data['image_banner'] = $request->file('image_banner')->storeAs('public', $fileNameToStore);
        }

        $video->update($data);

        $categories = Category::all();
        
        foreach($categories as $category):
            $videos_count = $category->videos->count();
            if($category->children()->exists()):
                foreach ($category->children as $child_category) :
                    $videos_count = $videos_count + $child_category->videos->count();
                endforeach;
            endif;
            
            if($videos_count == 0 && $category->video_availability == true):
                $category->update([
                    'video_availability' => false
                ]);
            elseif($videos_count > 0 && $category->video_availability == false):
                $category->update([
                    'video_availability' => true
                ]);
            endif;
        endforeach;

        /*if (is_null($category)) :
        else :
            if ($category->children()->exists()) :
                $videos_count = $category->videos->count();
                foreach ($category->children as $cild) :
                    $videos_count = $videos_count + $cild->videos->count();

		    if($cild->videos->count() == 0):
		        $cild->update([
                            'video_availability' => false
                        ]);
		    endif;
                endforeach;
                if ($videos_count == 0) :
                    $category->update([
                        'video_availability' => false
                    ]);
                else :
                    $category->update([
                        'video_availability' => true
                    ]);
                endif;
            elseif ($category->parent()->exists()) :

                $videos_count = $category->parent->videos->count();
                foreach ($category->parent->children as $cild) :
                    $videos_count = $videos_count + $cild->videos->count();
                endforeach;

                if ($videos_count == 0) :
                    $category->parent->update([
                        'video_availability' => false
                    ]);
                else:
                    $category->parent->update([
                        'video_availability' => true
                    ]);
                endif;
            endif;
            if (!$category->parent()->exists()) :
		print_r('aaa');
                if ($category->videos->count() == 0) :
                    $category->update([
                        'video_availability' => false
                    ]);
                else :
                    $category->update([
                        'video_availability' => true
                    ]);
                endif;
            endif;
        endif;


        if ($video->category->children()->exists()) :
            $videos_count = $video->category->videos->count();
            foreach ($video->category->children as $cild) :
                $videos_count = $videos_count + $cild->videos->count();
            endforeach;
            if ($videos_count == 0) :
                $video->category->update([
                    'video_availability' => false
                ]);
            else :
                $video->category->update([
                    'video_availability' => true
                ]);
            endif;
        elseif ($video->category->parent()->exists()) :

            $videos_count = $video->category->parent->videos->count();
            foreach ($video->category->parent->children as $cild) :
                $videos_count = $videos_count + $cild->videos->count();
            endforeach;

            if ($videos_count == 0) :
                $video->category->parent->update([
                    'video_availability' => false
                ]);
            else:
                $video->category->parent->update([
                    'video_availability' => true
                ]);
            endif;
        endif;
        if (!$video->category->parent()->exists()) :
            if ($video->category->videos->count() == 0) :
                $video->category->update([
                    'video_availability' => false
                ]);
            else :
                $video->category->update([
                    'video_availability' => true
                ]);
            endif;
        endif;*/

        return redirect()->route('videos.index')->with('status', 'video-updated');
    }
    public function destroy(Video $video)
    {
        $category = Category::where('id', $video->category_id)->first();
        $tags = Tag::where('video_id', $video->id)->get();
        foreach ($tags as $tag) :
            $tag->delete();
        endforeach;
        $views = View::where('video_id', $video->id)->get();
        foreach ($views as $view) :
            $view->delete();
        endforeach;
        $tickets = Ticket::where('video_id', $video->id)->get();
        foreach ($tickets as $ticket) :
            $ticket->delete();
        endforeach;
        $video->delete();
        if (is_null($category)) :
        else :
            if ($category->videos->count() == 0) :
                $category->update([
                    'video_availability' => false
                ]);
            endif;
        endif;
        return redirect()->route('videos.index')->with('status', 'video-deleted');
    }

    public function search(Request $request)
    {
        if (request('search') == null) :
            $videos = Video::orderBy('id', 'DESC')->paginate(10);
        else :
            $videos = Video::where('name', 'ilike', '%' . request('search') . '%')->orWhere('category_id', 'ilike', '%' . (Category::where('name', request('search'))->first()->id ?? request('search')) . '%')->orWhere('event_date', 'like', '%' . request('search') . '%')->paginate(10);
        endif;

        return view('videos.index', compact('videos'));
    }
}
