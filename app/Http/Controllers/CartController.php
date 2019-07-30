<?php

namespace App\Http\Controllers;

use App\Item;
use App\Category;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;

class CartController extends Controller
{

	public function __construct()
	{
	$this->middleware('auth');
	}
	public function index(Request $request)
	{
		$cart_name = $request->cart_name;
		$item_search = $request->item_search;

		if(!$item_search == null)
		{
		$items = Item::where('description', 'LIKE', '%' . $item_search . '%')->get();
			if(count($items) == 1 )
			{
			$oldCart = Session::has($cart_name) ? Session::get($cart_name) : null;
			$cart = new Cart($oldCart);
			$cart->add($items[0], $items[0]->id);
			$request->session()->put($cart_name, $cart);
			$cartview = $request->session()->get($cart_name);
			return redirect($cart_name);			
			}
		}
		else
		{
			$items = Item::all()->sortBy('description');
		}
			return view('cart.select', compact('items', 'cart_name'));
	}

		public function store(Request $request)
	{
		$cart_name = $request->cart_name;
		$product = Item::find($request->item_id);
		$oldCart = Session::has($cart_name) ? Session::get($cart_name) : null;
		$cart = new Cart($oldCart);
		$cart->add($product, $product->id);		
		$request->session()->put($cart_name, $cart);
		$cartview = $request->session()->get($cart_name);
		return redirect($cart_name);	
	}
}
