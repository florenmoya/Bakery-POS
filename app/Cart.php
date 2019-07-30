<?php

namespace App;
use Session;
class cart
    {
    	public $items = null;
    	public $totalQuantity = 0;
    	public $totalPrice = 0;

    	public function __construct($oldCart)
    	{
    		if($oldCart)
    		{
    			$this->items = $oldCart->items;
    			$this->totalQuantity = $oldCart->totalQuantity;
    			$this->totalPrice = $oldCart->totalPrice;
    		}
    	}

    	public function add($item, $id)
    	{
    		$storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item, 'refundAddStock' => false];

    		if($this->items)
    			{
    			if (array_key_exists($id, $this->items))
    			{
    				$storedItem = $this->items[$id];
    			}
    		}

    		$storedItem['qty']++;
    		$storedItem['price'] = $item->price * $storedItem['qty'];
    		$this->items[$id] = $storedItem;
    		$this->totalQuantity++;
    		$this->totalPrice += $item->price;
            $this->test = '1';
    	}

        public function remove($id, $cartname)
        {
        $this->total(0, $id, $cartname);
        
        $current_cart = session($cartname);
        unset($current_cart->items[$id]);
        Session::pull($cartname);
        Session::put($cartname, $current_cart);
        }

        public function total($qty, $id, $cartname){

        $cart = session($cartname);
        $price = $cart->items[$id]['item']['price'];
        $totalPrice = $cart->totalPrice;
        $totalPrice -= $cart->items[$id]['price'];
        $price = $cart->items[$id]['price'] = $price * $qty;
        $totalPrice += $price;
        $cart->totalPrice = $totalPrice;
        $cart->items[$id]['qty'] = $qty;
        Session::pull($cartname);
        Session::put($cartname, $cart);
        }

        public function refundAddStock($id, $cartname){

        $cart = session($cartname);
        $cart->items[$id]['refundAddStock'] = true;
        Session::pull($cartname);
        Session::put($cartname, $cart);
        }
        public function refundDontAddStock($id, $cartname){

        $cart = session($cartname);
        $cart->items[$id]['refundAddStock'] = false;
        Session::pull($cartname);
        Session::put($cartname, $cart);
        }
}
