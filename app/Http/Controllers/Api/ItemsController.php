<?php

namespace App\Http\Controllers\api;
use App\Item;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemsController extends Controller
{
   public function all(Item $items)
    {

        $data = $items->with('Category')->get();
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
            'category_id'  => ['required'],
            'notes'  => []
        ]);
        $items = Item::create($attributes);
        return response($items);
        
    }
    public function update(Request $request)
    {
        $update = Item::where('id', $request->id)
                ->update([
        'description' => $request->description,
        'quantity' => $request->quantity,
        'category_id' => $request->category_id,
        'type' => $request->type,
        'price' => $request->price,
        'notes' => $request->notes
    ]);

        return response('$update');
    }
    public function destroy(Request $request)
    {

        Item::findOrFail($request->items_id)->delete();
        return response('Item have been deleted!', 201);
    }
}
