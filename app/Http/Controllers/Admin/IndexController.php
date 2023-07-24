<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $data = [];
        // $data['usersCount'] = User::all()->count();
        // $data['categoriesCount'] = Category::all()->count();
        // $data['postsCount'] = Post::all()->count();
        // $data['tagsCount'] = Tag::all()->count();
        return view('admin.main', compact('data'));
    }
}
