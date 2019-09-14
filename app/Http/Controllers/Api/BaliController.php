<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\Bali;
use App\Sales;
use App\SalesItem;
use App\BaliItems;
use App\RegistersActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaliController extends Controller
{
    public function select(Bali $items)
	{

        $data = $items->with('BaliItem')->get();
        return response($data); 

    }
    public function store(Request $request)
	{
                $currentRegister = RegistersActivity::orderBy('created_at', 'desc')->first()->id;
				$balis_id = Bali::create(['registers_activity_id' => $currentRegister])->id;
                $sales_id = Sales::create(['registers_activity_id' =>$currentRegister])->id;
                //validation
                foreach($request->items as $items)
                    {
                        $item = Item::findOrFail($items['id']);
                        if(!$item){                        
                            return $item;
                        }
                    }
                //query
                foreach($request->items as $items)
                    {

                    $item = Item::findOrFail($items['id']);

                    if($items['cart_quantity'] > 0){
                        $createddata = BaliItems::create([
                        'balis_id' => $balis_id,
                        'quantity' => $items['cart_quantity'],
                        'price' => $item['price']*$items['cart_quantity'],
                        'item_cost' => $item['item_cost'],
                        'item_id' => $items['id'],
                        ]);

                        $createddata = SalesItem::create([
                        'sales_id' => $sales_id,
                        'quantity' => $items['cart_quantity'],
                        'price' => $item['price']*$items['cart_quantity'],
                        'item_cost' => $item['item_cost'],
                        'item_id' => $items['id'],
                        ]);

                        $item = Item::find($items['id']);
                        $item->quantity = $item->quantity - $items['cart_quantity'];
                        $item->save();
                    }
                    }
            
        return response($createddata);
	}
}
