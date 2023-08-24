<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = Category::with('childrenCategories')->where('parent_id','0')->orderBy('sort', 'ASC')->paginate(10);
        return view('categories.index', compact('categories'));
    }
    public function create()
    {
        return view('categories.create');
    }
    public function show($category_slug)
    {
        
        $category = Category::whereSlug($category_slug)->firstOrFail();
        $child_categories = Category::with('childrenCategories')->where('parent_id',$category->id)->orderBy('sort', 'ASC')->paginate(10);
        return view('categories.show', compact('category','child_categories'));
    }
    public function edit($category_slug) 
    {
        $category = Category::whereSlug($category_slug)->firstOrFail();
        return view('categories.edit', [
            'category' => $category
        ]);
    }



    public function createChild($category_parent)
    {
        $category_parent = Category::whereSlug($category_parent)->firstOrFail();
        return view('categories.create_child', [
            'category_parent' => $category_parent]);
    }
    public function editChild($category_parent,$category_slug) 
    {
        $category_parent = Category::whereSlug($category_parent)->firstOrFail();
        $category = Category::whereSlug($category_slug)->firstOrFail();
        return view('categories.edit_child', [
            'category' => $category,
            'category_parent' => $category_parent
        ]);
    }


    public function store(CategoryStoreRequest $request)
    {
        $data = $request->validated();

        // Если есть файл
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
        // Автоинкремент поля sort
        $categories = Category::get();
        $last_category = Category::orderby('id', 'desc')->first();

        if(count($categories) == 0):
        $data['sort'] = 0;
        else:
        $data['sort'] = $last_category->sort + 1;
        endif;
        $category = Category::firstOrCreate($data);

        if($category->parent_id > 0):
            $category_parent = Category::whereId($category->parent_id)->firstOrFail();
            return redirect()->route('category.show',$category_parent->slug)->with('status', 'category-created'); 
        else:
            return redirect()->route('categories.index')->with('status', 'category-created');
        endif;
       
    }
    public function update(CategoryUpdateRequest $request, $category_slug)
    {
        $category = Category::whereSlug($category_slug)->firstOrFail();

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
        $category->update($data);
        if($category->parent_id > 0):
            $category_parent = Category::whereId($category->parent_id)->firstOrFail();
            return redirect()->route('category.show',$category_parent->slug)->with('status', 'category-updated'); 
        else:
            return redirect()->route('categories.index')->with('status', 'category-updated');
        endif;
    }
    public function destroy($category_slug)
    {

        $category = Category::whereSlug($category_slug)->firstOrFail();
        $child_categories = Category::where('parent_id',$category->id)->get();
        foreach($child_categories as $child_category):
            $child_category->delete();
        endforeach;
        $category->delete();
        return redirect()->back()->with('status', 'category-deleted');
    }

    public function sort(Request $request)
    {
        $bodyContent = $request->getContent();
        $data = json_decode($bodyContent);

        foreach ($data as $key => $order) {
            $post = Category::find($order->id)->update(['sort' => $order->order]);
        }
        return response()->json('Update Successfully.', 200);
    }

}   
