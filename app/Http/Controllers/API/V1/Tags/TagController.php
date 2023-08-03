<?php

namespace App\Http\Controllers\API\V1\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getTags()
    {
        $tags = Tag::all();
        return response()->json($tags);
    }
}
