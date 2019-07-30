<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class rawcontroller extends Controller
{
    public function index()
    {
                $remove = '';

                if(!is_null(Input::get('category'))){
                $category = Input::get('category');
                $items = Item::where('category', $category)->orderBy('quantity')->get();
                }
                else if(!is_null(Input::get('remove_category'))){
                $remove = Input::get('remove_category');
                }else{
                $items = Item::where('category', 'Bread')->orderBy('quantity')->get();
                }
		return view('reports.raw', compact('items' , 'remove'));
    }
        public function rawAll()
    {
    	$items = Item::all()->sortBy('quantity');
        $remove = 'bread';
		return view('reports.raw', compact('items', 'remove'));
    }
}
