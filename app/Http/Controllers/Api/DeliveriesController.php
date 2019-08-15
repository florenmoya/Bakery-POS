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

                foreach($request->items as $items)
                    {
                        $createddata = DeliveriesItem::create([
                        'deliveries_id' => $id,
                        'quantity' => $items['cart_quantity'],
                        'price' => $items['price']*$items['cart_quantity'],
                        'item_cost' => $items['item_cost'],
                        'item_id' => $items['id'],
                        ]);
                        $item = Item::find($items['id']);
                        $item->quantity = $item->quantity + $items['cart_quantity'];
                        $item->save();
                    }
            
        return response('Created', 201);
	}
        public function report_deliveries()
    {
        $data = DeliveriesItem::groupBy('item_id, item_cost, price')->selectRaw('sum(quantity) as total_quantity, `item_cost`,`item_id`,`price')->where('created_at', '>=', Carbon::now()->startOfMonth())->with('Item')->get();
        return response($data);
    }
}
