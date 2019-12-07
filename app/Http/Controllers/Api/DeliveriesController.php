<?php

namespace App\Http\Controllers\Api;
use App\Item;
use App\Deliver;
use App\DeliveriesItem;
use App\RegistersActivities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
class DeliveriesController extends Controller
{

	   public function select(Deliver $deliveries)
	{

        $data = $deliveries->where('company_id', $request->user()->company_id)->get();
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
            $deliver_id = Deliver::create(['company_id' => $request->user()->company_id, 'amount' => $total, 'user_id' => $request->user()->id, 'registers_activities_id' => $latest->id])->id;
                //query
                foreach($request->items as $items)
                    {
                        $item = Item::findOrFail($items['id']);

                            if($items['cart_quantity'] > 0){
                            $createddata = DeliveriesItem::create([
                            'delivery_id' => $deliver_id,
                            'quantity' => $items['cart_quantity'],
                            'price' => $item['price']*$items['cart_quantity'],
                            'item_id' => $items['id'],
                            'company_id' => $request->user()->company_id,
                            ]);

                        $item->disableLogging();
                        $item->stock = $item->stock + $items['cart_quantity'];
                        $item->save();
                    }
                }
        return response($createddata);
	}
        public function report_deliveries(Request $request)
    {
        $data = Deliver::with(array('DeliveriesItem'=>function($query){
        $query->with('Item');
        }))->where('company_id', $request->user()->company_id)->get();;
        return response($data);
    }
}
