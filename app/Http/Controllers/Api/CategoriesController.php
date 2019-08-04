<?php

namespace App\Http\Controllers\api;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function all(Category $category)
    {

        $data = $category->all();

        return response($data); 

    }

    public function store()
    {

        $attributes = request()->validate([
            'category_name' => ['required']
        ]);

        Category::create($attributes);
        
        return response('Categories have been created', 201);

    }
    public function update(Request $request)
    {
        $data = Category::find($request->id);

        $data->category_name = $request->category_name;

        $data->save();
        return response('Categories have been updated', 201);
    }
    public function destroy(Request $request)
    {

        Category::findOrFail($request->categories_id)->delete();
        return response('Category have been deleted!', 201);
    }
}
