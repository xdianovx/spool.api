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
        $video = Video::findOrFail($video_id);
        $tags = $video->tags()->where('user_id', Auth::user()->id)->paginate(1000);
        return response()->json($tags);
    }
    public function edit(Tag $tag)
    {
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

    public function update(TagUpdateRequest $request, $tag_id)
    {
        $tag = Tag::whereId($tag_id)->firstOrFail();
        $data = $request->validated();
        $video_id = $tag->video_id;
        $tag->update($data);
        return redirect()->route('video.edit', $video_id)->with('status', 'tag-updated');
    }
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json($tag, 200);
    }
    public function display(Request $request)
    {
        $bodyContent = $request->getContent();
        $data = json_decode($bodyContent);
        Tag::whereId($data->id)->update(['display' => $data->isCheck]);
        return response()->json($data, 200);
    }
}
