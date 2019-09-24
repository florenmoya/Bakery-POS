<?php

namespace App\Http\Controllers\Api;
use App\Item;
use App\Deliver;
use App\DeliveriesItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
class DeliveriesController extends Controller
{

	   public function select(Deliver $items)
	{

        $data = $items->all();
        return response($data); 

    }

    public function store(Request $request)
	{
  
                $id = Deliver::create()->id;
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
                            $createddata = DeliveriesItem::create([
                            'deliveries_id' => $id,
                            'quantity' => $items['cart_quantity'],
                            'price' => $item['price']*$items['cart_quantity'],
                            'item_cost' => $item['item_cost'],
                            'item_id' => $items['id'],
                            ]);

                        $item->quantity = $item->quantity + $items['cart_quantity'];
                        $item->save();
                    }
                }
        return response($createddata);
	}
        public function report_deliveries()
    {
        $data = DeliveriesItem::groupBy('item_id')->selectRaw('sum(quantity) as total_quantity, sum(price) as total_price, `item_id`')->where('created_at', '>=', Carbon::now()->startOfMonth())->with('Item')->get();
        return response($data);
    }
}
