<?php

namespace App\Http\Controllers;
use App\Item;
use App\Category;
use Illuminate\Http\Request;

class ItemsController extends Controller
{

	public function index()
	{

		$items = Item::all()->sortBy('description')->values();

		// return view('items.index', compact('items'));
		return response()->json($items);	
	}

	public function create()
	{

		$items = Item::all();
		$categories = Category::all();
		$itemcategories = Item::distinct()->get(['category']);

		foreach ($itemcategories as $itemcategories){
			$newcategories = Category::where('category_name', $itemcategories->category)->get();
			if($newcategories->isEmpty()){
			Category::create(['category_name' => $itemcategories->category]);
			$categories = Category::all();
			}
		}
		return view('items.create', compact('items','categories'));
	}
	public function store()
	{

 		$attributes = request()->validate([
 			'description' => ['required'],
 			'quantity'  => ['required'],
 			'price'  => ['required'],
 			'item_cost'  => [],
 			'type'  => ['required'],
 			'category'  => ['required'],
 			'notes'  => []
 		]);
		$items = Item::create($attributes);
		
		return response($items, 201);

	}
	public function edit(Item $item)
	{
		$categories = Category::all();
		$existed = false ;
		foreach ($categories as $category){
			if($category->category_name == $item->category){
				$existed = 1;
			}
		}
		if($existed == false){
					if(!$item->category==null){
			Category::create(['category_name' => $item->category]);
			$categories = Category::all();
		}
		}
		return view('items.edit', compact('item' , 'categories'));
	}
	public function update(Item $item)
	{

		$item->update([
		'description' => request('description'),
		'quantity' => $quantity,
		'category' => request('category'),
		'price' => request('price'),
		'notes' => request('notes')
		]);
		// return back();
	}
	public function destroy($id)
	{

		Item::findOrFail($id)->delete();
		return redirect('/items');
	}

	public function show(Request $request, Category $categories)
	{
		$item_search = $request->item_search;

		if(!$item_search == null){
		$items = Item::where('description', 'LIKE', '%' . $item_search . '%')->get();
	}else{
			$items = Item::all()->sortBy('description');
	}
		return view('items.show', compact('items', 'categories'));
	}

}
