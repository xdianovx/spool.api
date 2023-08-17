<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagStoreRequest;
use App\Http\Requests\Tag\TagUpdateRequest;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{

    public function getAll($video_id)
    {
        // // Ключевая часть этого запроса where('video_id', 'id видео записи который мы должны получить')
        $tags = Tag::where('user_id', Auth::user()->id)->where('video_id', $video_id)->paginate(10);

        return response()->json($tags);
    }


    public function edit($tag)
    {
        $tag = Tag::whereId($tag)->firstOrFail();
        $video_id = $tag->video_id;
        $video = Video::whereId($video_id)->firstOrFail();
        return view('tags.edit', compact('tag', 'video_id', 'video'));
    }

    public function store(TagStoreRequest $request, $video_id)
    {
        $data = $request->validated();
        Tag::firstOrCreate([
            'name' => $data['name'],
            'user_id' => Auth::user()->id,
            'video_id' => $video_id
        ], $data);
        return redirect()->back()->with('status', 'tag-created');
    }

    public function update(TagUpdateRequest $request, $tag)
    {
        $tag = Tag::whereId($tag)->firstOrFail();
        $data = $request->validated();
        $video_id = $tag->video_id;
        $tag->update($data);
        return redirect()->route('video.edit', $video_id)->with('status', 'tag-updated');
    }
    public function destroy($tag)
    {
        $tag = Tag::whereId($tag)->firstOrFail();
        $tag->delete();
        return response()->json($tag, 200);
    }
    public function destroy_ajax(Request $request)
    {
        $bodyContent = $request->getContent();
        $data = json_decode($bodyContent);
        // $tag = Tag::whereId($tag)->firstOrFail();
        // $tag->delete();
        return response()->json($data, 200);
    }


    public function display(Request $request)
    {
        $bodyContent = $request->getContent();
        $data = json_decode($bodyContent);
        Tag::whereId($data->id)->update(['display' => $data->isCheck]);
        return response()->json($data, 200);
    }
}
