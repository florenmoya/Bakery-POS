<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth');

    }
   public function index()
    {

        $categories = Category::all();

        return view('categories.index', compact('categories'));
        
    }

    public function create()
    {


        return view('categories.create');
        

    }
    public function store()
    {

        $attributes = request()->validate([
            'category_name' => ['required']
        ]);
        Category::create($attributes);
        
        return redirect('/categories');

    }
    public function edit(Category $category)
    {

        return view('categories.edit', compact('category'));

    }
    public function update(Category $category)
    {

        $category->update(request(['category_name']));
        return redirect('/categories');

    }
    public function destroy($id)
    {

        Category::findOrFail($id)->delete();
        return redirect('/categories');
    }
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }
}
