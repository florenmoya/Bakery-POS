<?php

namespace App\Http\Controllers;
use App\Sales;
use App\SalesItem;
use App\Item;
use App\Cart;
use App\SalesRegister;
use App\RegistersActivity;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Session;
use Auth;

class SalesController extends Controller
{
    private $cart_name = 'sales/create';

	public function __construct()
	{
	$this->middleware('auth');
	}
	    public function index()
    {
        $register = SalesRegister::find(1);
    	return view('sales.index', compact('register'));
    }
    public function create()
    {
        if(!is_null(Input::get('reset_cart'))){
            Session::forget($this->cart_name);
        }
        $oldCart = Session::has($this->cart_name) ? Session::get($this->cart_name) : null;
        $cart = new Cart($oldCart);
    	return view('sales.create', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice, 'cart_name' => $this->cart_name]);
    }
    public function destroy($id)
    {
        $products = session($this->cart_name);

        $oldCart = Session::has($this->cart_name) ? Session::get($this->cart_name) : null;
        $cart = new Cart($oldCart);
        $cart->remove($id, $this->cart_name);

        return redirect('sales/create');
    }    
    public function edit(Request $request, $id)
    {
        $new_quantity = $request->qty;

        $oldCart = Session::get($this->cart_name);
        $cart = new Cart($oldCart);
        $cart->total($new_quantity, $id, $this->cart_name);

        return redirect('sales/create');
    },

    public function store()
    {
        $oldCart = Session::has($this->cart_name) ? Session::get($this->cart_name) : null;

        $cart = new Cart($oldCart);

            if(!empty($cart->items))
            {

                $currentRegister = RegistersActivity::orderBy('created_at', 'desc')->first()->id;
                $sales_id = Sales::create(['registers_activity_id' => $currentRegister])->id;

                foreach($cart->items as $sales)
                    {
                        $createddata = SalesItem::create([
                        'sales_id' => $sales_id,
                        'description' => $sales['item']['description'],
                        'quantity' => $sales['qty'],
                        'price' => $sales['item']['price']*$sales['qty'],
                        'type' => $sales['item']['type'],
                        'category' => $sales['item']['category']
                        ]);

                        activity()->disableLogging();
                        $item = Item::find($sales['item']['id']);
                        $item->quantity = $item->quantity - $sales['qty'];
                        $item->save();
                    }
            }
        Session::pull($this->cart_name);
        return redirect('sales/create');
    },
}
