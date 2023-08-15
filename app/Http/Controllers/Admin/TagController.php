<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagStoreRequest;
use App\Http\Requests\Tag\TagUpdateRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('id', 'DESC')->paginate(10);
        return view('tags.index', compact('tags'));
    }

    public function create()
    {

        return view('tags.create');
    }

    public function show($tag)
    {
        $tag = Tag::whereId($tag)->firstOrFail();
        return view('tags.show', compact('tag'));
    }
    
    public function edit($tag)
    { 
        $tag = Tag::whereId($tag)->firstOrFail();
        return view('tags.edit', compact('tag'));
    }

    public function store(TagStoreRequest $request)
    {

        $data = $request->validated();

        Tag::firstOrCreate([
            'name' => $data['name'],
            'user_id' => Auth::user()->id
        ],$data);
        return redirect()->back()->with('status', 'tag-created');
    }

    public function update(TagUpdateRequest $request, $tag)
    {
        $tag = Tag::whereId($tag)->firstOrFail();
        $data = $request->validated();
        $tag->update($data);
        return redirect()->route('tags.index')->with('status', 'tag-updated');
    }
    public function destroy($tag)
    {
        $tag = Tag::whereId($tag)->firstOrFail();
        $tag->delete();
        return redirect()->route('tags.index')->with('status', 'tag-deleted');
    }

    public function search(Request $request)
    {
        if (request('search' == 'null')):
            $tags = Tag::orderBy('id', 'DESC')->paginate(10);
        else:
            $tags = Tag::where('name', 'like', '%' . request('search') . '%')->
            orWhere('id', 'like', '%' . request('search') . '%')->paginate(10);
        endif;
        return view('tags.index', compact('tags'));
    }
}
