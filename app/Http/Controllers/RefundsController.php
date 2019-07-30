<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Item;
use App\Refund;
use App\RefundsItem;
use App\Cart;
use App\Category;
use Session;
use Auth;

class RefundsController extends Controller
{
		private $cart_name = 'refund/create';

            public function __construct()
        {
            $this->middleware('auth');

        }

    public function create()
        {
            if(!is_null(Input::get('reset_cart'))){
                Session::forget($this->cart_name);
            }
            $oldCart = Session::has($this->cart_name) ? Session::get($this->cart_name) : null;
            $cart = new Cart($oldCart);
            $categories = Category::all();

            return view('sales.refund.create', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice, 'cart_name' => $this->cart_name], compact('categories'));
        }

    public function item_store(Request $request)
        {

            $attributes = request()->validate([
                'description' => ['required'],
                'quantity'  => [],
                'price'  => ['required'],
                'item_cost'  => [],
                'type'  => ['required'],
                'category'  => ['required'],
                'notes'  => []
            ]);
            $product = Item::create($attributes);

            $oldCart = Session::has($this->cart_name) ? Session::get($this->cart_name) : null;
            $cart = new Cart($oldCart);
            $cart->add($product, $product->id);
            $request->session()->put($this->cart_name, $cart);
            $cartview = $request->session()->get($this->cart_name);

            return redirect('/refund/create');

        }

    public function destroy($id)
        {
            $products = session($this->cart_name);

            $oldCart = Session::has($this->cart_name) ? Session::get($this->cart_name) : null;
            $cart = new Cart($oldCart);
            $cart->remove($id, $this->cart_name);

            return redirect('/refund/create');
        }

    public function edit(Request $request, $id)
        {
        $new_quantity = $request->qty;
        $oldCart = Session::has($this->cart_name) ? Session::get($this->cart_name) : null;
        $cart = new Cart($oldCart);
        $cart->total($new_quantity, $id, $this->cart_name);
        if($request->refundAddStock) {
        $cart->refundAddStock($id,$this->cart_name);
        }else{
        $cart->refundDontAddStock($id,$this->cart_name);
        }
        return redirect('/refund/create');
        }

    public function store(Request $request)
        {
            $oldCart = Session::has($this->cart_name) ? Session::get($this->cart_name) : null;

            $cart = new Cart($oldCart);
                if(!empty($cart->items))
                {
                    $id = Auth::id();
                    $refunds_id = Refund::create(['users_id' => $id])->id;
                    foreach($cart->items as $cart->items)
                    {
                        $createddata = RefundsItem::create([
                        'refunds_id' => $refunds_id,
                        'description' => $cart->items['item']['description'],
                        'quantity' => $cart->items['qty'],
                        'price' => $cart->items['item']['price']*$cart->items['qty'],
                        'type' => $cart->items['item']['type'],
                        'category' => $cart->items['item']['category'],
                        ]);
                        $itemCheckout = new Item();
                        $item = Item::find($cart->items['item']['id']);

                        if($cart->items['refundAddStock']=='true'){
                        $item->quantity = $item->quantity + $cart->items['qty'];
                    	}

                        $item->save();
                    }
                }
            Session::pull($this->cart_name);
            return redirect('/refund/create');
        }
}
