<?php

namespace App\Http\Controllers\Api;

use App\Deliver;
use App\DeliveriesItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
                        'items_id' => $items['id'],
                        ]);
                    }
            
        return response('Created', 201);
	}
}
