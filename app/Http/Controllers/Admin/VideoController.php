<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\VideoStoreRequest;
use App\Http\Requests\Video\VideoUpdateRequest;
use App\Models\Category;
use App\Models\Partners_company;
use App\Models\Video;
use Illuminate\Http\Request;

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
        $video = Video::whereId($video)->firstOrFail();
        return view('videos.edit', compact('video'));
    }

    public function store(VideoStoreRequest $request)
    {
        dd($request);
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
        Video::firstOrCreate($data);
        return redirect()->route('videos.index')->with('status', 'video-created');
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
            orWhere('id', 'like', '%' . request('search') . '%')->paginate(10);
        endif;
        return view('videos.index', compact('videos'));
    }
}
