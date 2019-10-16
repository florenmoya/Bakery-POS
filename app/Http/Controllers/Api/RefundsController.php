<?php

namespace App\Http\Controllers\Api;
use Auth;
use App\Item;
use App\Refunds;
use App\RefundsItem;
use App\RegistersActivities;
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
                $total = 0;
                //validation
                foreach($request->items as $items)
                    {
                        $item = Item::findOrFail($items['id']);
                        if(!$item){                        
                            return $item;
                        }

                        $total += $items['cart_quantity']*$items['price'];
                    }
            $latest = RegistersActivities::where('company_id', $request->user()->company_id)->latest('created_at')->first();
            if($latest->released_amount){ 
                return response('Error', 401);
            }
            $refunds_id = Refunds::create(['company_id' => $request->user()->company_id, 'amount' => $total, 'user_id' => $request->user()->id, 'registers_activities_id' => $latest->id])->id;
                //query
                foreach($request->items as $items)
                    {
                        $item = Item::findOrFail($items['id']);
                        if($items['cart_quantity'] > 0){
                            $createddata = RefundsItem::create([
                            'refunds_id' => $refunds_id,
                            'quantity' => $items['cart_quantity'],
                            'price' => $item['price']*$items['cart_quantity'],
                            'item_id' => $items['id'],
                            'company_id' => $request->user()->company_id,
                            ]);
                        }
                    }
        return response($createddata);
	}
}
