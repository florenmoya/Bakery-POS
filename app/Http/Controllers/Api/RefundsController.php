<?php

namespace App\Http\Controllers\Api;
use Auth;
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

                        // $createddata = RefundsItem::create([
                        // 'refunds_id' => $refunds_id,
                        // 'quantity' => $request['cart_quantity'],
                        // 'price' => $request['price']*$request['cart_quantity'],
                        // 'item_cost' => $request['item_cost'],
                        // 'item_id' => $request['id'],
                        // ]);
                foreach($request->items as $items)
                    {
                        $createddata = RefundsItem::create([
                        'refunds_id' => $refunds_id,
                        'quantity' => $items['cart_quantity'],
                        'price' => $items['price']*$items['cart_quantity'],
                        'item_cost' => $items['item_cost'],
                        'item_id' => $items['id'],
                        ]);
                    }
            
        return response($refunds_id);
	}
}
