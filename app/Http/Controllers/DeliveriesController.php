<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Cart;
use App\Category;
use App\Item;
use App\Deliver;
use App\DeliveriesItem;

use Session;
class DeliveriesController extends Controller
{
	private $cart_name = 'deliveries/create';

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

            return view('inventory.deliveries.create', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice, 'cart_name' => $this->cart_name], compact('categories'));
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

            return redirect('/deliveries/create');

        }

    public function destroy($id)
        {
            $products = session($this->cart_name);

            $oldCart = Session::has($this->cart_name) ? Session::get($this->cart_name) : null;
            $cart = new Cart($oldCart);
            $cart->remove($id, $this->cart_name);

            return redirect('/deliveries/create');
        }

    public function edit(Request $request, $id)
        {
        $new_quantity = $request->qty;

        $oldCart = Session::has($this->cart_name) ? Session::get($this->cart_name) : null;
        $cart = new Cart($oldCart);
        $cart->total($new_quantity, $id, $this->cart_name);

        return redirect('/deliveries/create');
        }

    public function store(Request $request)
        {
            $oldCart = Session::has($this->cart_name) ? Session::get($this->cart_name) : null;

            $cart = new Cart($oldCart);

                if(!empty($cart->items))
                {
                    $delivery_id = Deliver::create()->id;
                    foreach($cart->items as $deliveries)
                    {
                        $createddata = DeliveriesItem::create([
                        'deliveries_id' => $delivery_id,
                        'description' => $deliveries['item']['description'],
                        'quantity' => $deliveries['qty'],
                        'price' => $deliveries['item']['price']*$deliveries['qty'],
                        'type' => $deliveries['item']['type'],
                        'category' => $deliveries['item']['category'],
                        ]);
                        $itemCheckout = new Item();
                        $item = Item::find($deliveries['item']['id']);
                        $itemCheckout->itemDelivery($item, $deliveries['qty'] , $item->quantity);
                    }
                }
            Session::pull($this->cart_name);
            return redirect('/deliveries/create');
        }
}
