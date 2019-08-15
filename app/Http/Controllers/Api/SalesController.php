<?php

namespace App\Http\Controllers\Api;

use App\Item;
use App\Sales;
use App\SalesItem;
use App\SalesRegister;
use App\RegistersActivity;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{

	public function index(){

		$register = SalesRegister::find(1);
    	return response($register);

    }

	   public function all(Sales $items)
	{

        $data = $items->all();
        return response($data); 

    }

    public function store(Request $request)
	{
  
                $sales_id = Sales::create(['registers_activity_id' => $request->register_id])->id;

                foreach($request->items as $items)
                    {
                        $createddata = SalesItem::create([
                        'sales_id' => $sales_id,
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
	public function sale_register_store(Request $request)
	{

		$SalesRegister = SalesRegister::updateOrCreate(['id' => 1], ['amount' => $request->amount, 'username' => $request->username, 'active' => true]);
		RegistersActivity::Create(['starting_amount' => $request->amount]);
		
		return response($SalesRegister);
	}
	public function sales_register_close_store(Request $request)
    {

		$lastid = RegistersActivity::orderBy('created_at', 'desc')->first()->id;
		$RegistersClosingAmount = RegistersActivity::find($lastid);
		$RegistersClosingAmount->ending_amount = $request->amount;
		$RegistersClosingAmount->save();
		SalesRegister::updateOrCreate(['id' => 1], ['active' => false]);

		return response($RegistersClosingAmount);

    }
    public function report_sales()
    {
        $data = SalesItem::with('Item')->get();
		return response($data);
    }
}
