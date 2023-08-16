<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\VideoStoreRequest;
use App\Http\Requests\Video\VideoUpdateRequest;
use App\Models\Category;
use App\Models\Partners_company;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('id', 'DESC')->paginate(10);
        return view('videos.index', compact('videos'));
    }

    public function create()
    { 
        $partner_companies = Partners_company::all();
        $categories = Category::all();
        return view('videos.create',compact('partner_companies','categories'));
    }

    public function show($video)
    {
        $video = Video::whereId($video)->firstOrFail();
        return view('videos.show', compact('video'));
    }
    
    public function edit($video)
    { 
        $user_tags = Tag::where('user_id', Auth::user()->id)->where('video_id', $video)->paginate(10);
        $partner_companies = Partners_company::all();
        $categories = Category::all();
        $video = Video::whereId($video)->firstOrFail();
        return view('videos.edit', compact('video','partner_companies','categories','user_tags'));
    }

    public function store(VideoStoreRequest $request)
    {
      
        $data = $request->validated();
        if ($request->hasFile('image')) {
            // Имя и расширение файла
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Только оригинальное имя файла
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = str_replace(' ','_',$filename);
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
            $filename = str_replace(' ','_',$filename);
            // Расширение
            $extention = $request->file('image_banner')->getClientOriginalExtension();
            // Путь для сохранения
            $fileNameToStore = "image_banner/" . $filename . "_" . time() . "." . $extention;
            // Сохраняем файл
            $data['image_banner'] = $request->file('image_banner')->storeAs('public', $fileNameToStore);
        }

       $video = Video::firstOrCreate($data);
        return redirect()->route('video.edit',$video->id)->with('status', 'video-created');
    }

    public function update(VideoUpdateRequest $request, $video)
    {
        $video = Video::whereId($video)->firstOrFail();
        $data = $request->validated();
        if ($request->hasFile('image')) {
            // Имя и расширение файла
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Только оригинальное имя файла
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = str_replace(' ','_',$filename);
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
            $filename = str_replace(' ','_',$filename);
            // Расширение
            $extention = $request->file('image_banner')->getClientOriginalExtension();
            // Путь для сохранения
            $fileNameToStore = "image_banner/" . $filename . "_" . time() . "." . $extention;
            // Сохраняем файл
            $data['image_banner'] = $request->file('image_banner')->storeAs('public', $fileNameToStore);
        }
        $video->update($data);
        return redirect()->route('videos.index')->with('status', 'video-updated');
    }
    public function destroy($video)
    {
        $tags = Tag::where('video_id',$video)->get();
        foreach($tags as $tag):
        $tag->delete();
        endforeach;
        $video = Video::whereId($video)->firstOrFail();
        $video->delete();
        return redirect()->route('videos.index')->with('status', 'video-deleted');
    }

    public function search(Request $request)
    {
        if (request('search' == 'null')):
            $videos = Video::orderBy('id', 'DESC')->paginate(10);
        else:
            $videos = Video::where('name', 'like', '%' . request('search') . '%')->
            orWhere('category_id', 'like', '%' . Category::where('name',request('search'))->firstOrFail()->id . '%')->
            orWhere('event_date', 'like', '%' . request('search') . '%')->paginate(10);
        endif;
        return view('videos.index', compact('videos'));
    }
}
