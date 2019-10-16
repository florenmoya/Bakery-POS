<?php

namespace App\Http\Controllers\Api;
use App\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function all(Categories $categories)
    {

        $data = $categories->all();

        return response($data); 

    }

    public function store(Request $request)
    {

        $item = new Categories;

        $item->name = $request->name;
        $item->company_id = $request->user()->company_id;

        $item->save();

        return response('Categories have been created', 201);
    }
    public function update(Request $request)
    {
        $data = Categories::find($request->id);
        $data->name = $request->name;
        $data->save();
        return response('Categories have been updated', 201);
    }
    public function destroy(Request $request)
    {
        Categories::findOrFail($request->id)->delete();
        return response('Category have been deleted!', 201);
    }
}
