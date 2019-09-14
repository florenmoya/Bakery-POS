<?php

namespace App\Http\Controllers\Api;
use Auth;
use App\Item;
use App\Refunds;
use App\RefundsItem;
use App\RegistersActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RefundsController extends Controller
{
    public function select(Refunds $items)
	{

        $data = $items->with('RefundsItem')->get();
        return response($data); 

    }
    public function store(Request $request)
	{
                $currentRegister = RegistersActivity::orderBy('created_at', 'desc')->first()->id;

                		$refunds_id = Refunds::create(['registers_activity_id' =>$currentRegister])->id;

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
                        $createddata = RefundsItem::create([
                        'refunds_id' => $refunds_id,
                        'quantity' => $items['cart_quantity'],
                        'price' => $item['price']*$items['cart_quantity'],
                        'item_cost' => $item['item_cost'],
                        'item_id' => $items['id'],
                        ]);
                    }
                    }
            
        return response($createddata);
	}
}
