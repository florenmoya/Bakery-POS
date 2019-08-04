<?php

namespace App\Http\Controllers\api;
use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemsController extends Controller
{
   public function all(Item $items)
    {

        $data = $items->all();

        return response($data); 

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
    public function update(Request $request)
    {
        $item = Item::find($request->id);

        $item->description = $request->description;
        $item->quantity = $request->quantity;
        $item->category = $request->category;
        $item->price = $request->price;
        $item->notes = $request->notes;

        $item->save();
        return response('Items have been updated', 201);
    }
    public function destroy(Request $request)
    {

        Item::findOrFail($request->items_id)->delete();
        return response('Item have been deleted!', 201);
    }
}
