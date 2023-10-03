<?php

namespace App\Http\Controllers\API\V1\Categories;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
    public function getCategories()
    {
        $categories = CategoryResource::collection(Category::where('video_availability', true)->where('parent_id', '0')->orderBy('sort', 'ASC')->get());
        return response()->json($categories);
    }
    public function getCategory($category_slag)
    {
        try {
            $parent_category = Category::where('slug', $category_slag)->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'status' => 'failed',
                'error' => 'Category not found'
            ], 404);
        }
        
        $categories =CategoryResource::collection($parent_category->childrenCategories);
        return response()->json($categories);
    }
}
