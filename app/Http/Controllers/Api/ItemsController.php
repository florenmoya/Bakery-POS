<?php

namespace App\Http\Controllers\api;
use App\Item;
use App\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemsController extends Controller
{
   public function all(Request $request)
    {

        $data = Item::where('company_id', $request->user()->company_id)->with('Categories')->get();
        return response($data); 

    }

    public function store(Request $request)
    {

        $item = new Item;

        $item->description = $request->description;
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
    public function update(Request $request)
    {
        $update = 
            Item::where('id', $request->id)
                ->update([
                'description' => $request->description,
                "type" => $request->type,
                "UPC" => null,
                "EAN" => null,
                "custom_SKU" => null,
                "manufacture_SKU" => null,
                "category_id" => $request->category_id,
                "brand_id" => null,
                "tags_id" => null,
                "vendor_id" => null,
                "reorder_point" => null,
                "inventory_level" => null,
                "price" => $request->price,
                "tax" => null,
                "msrp" => null,
                "cost" => $request->cost,
                "stock" => $request->stock,
                "notes" => null,
            ]);
        return response($update);
    }
    public function destroy(Request $request)
    {
        Item::findOrFail($request->id)->delete();
        return response('Item have been deleted!', 201);
    }
}
