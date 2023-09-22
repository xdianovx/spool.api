<?php

namespace App\Http\Controllers\API\V1\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = Category::where('video_availability', true)->orderBy('sort', 'ASC')->get();
        return response()->json($categories);
    }
}
