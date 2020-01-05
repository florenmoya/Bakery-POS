<?php

namespace App\Http\Controllers\api;
use App\Item;
use App\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
class ItemsController extends Controller
{
 public function all(Request $request)
 {

    $data = Item::where('company_id', $request->user()->company_id)->with('Categories')->get();
    return response($data); 

    }

public function store(Request $request)
{
    $imageName = '';
    if (preg_match('/^data:image\/(\w+);base64,/', $request->image)) {
    $image = substr($request->image, strpos($request->image, ',') + 1);


        $imageName = time().'.'.str_random(10).'.png';

        \File::put(public_path('images'). '/' . $imageName, base64_decode($image));

    }

    $item = new Item;

    $item->description = $request->description;
    $item->image = $imageName;
    $item->stock = $request->stock;
    $item->price = $request->price;
    $item->cost = $request->cost;
    $item->type = $request->type;
    $item->category_id = $request->category_id;
    $item->notes = $request->notes;
    $item->company_id = $request->user()->company_id;

    $item->save();

    return response('Item Created', 201);
    
}
public function update(Item $item, Request $request)
{
    $update = $item::find($request->id);

    $update->description = $request->description;
    $update->category_id = $request->category_id;
    $update->price = $request->price;
    $update->cost = $request->cost;
    $update->stock = $request->stock;

    $update->save();

    return response($update);
}
public function destroy(Request $request)
{
    Item::findOrFail($request->id)->delete();
    return response('Item have been deleted!', 201);
}
}
