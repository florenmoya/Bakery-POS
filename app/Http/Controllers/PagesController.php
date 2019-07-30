<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    }
    public function index(){
    	return view('sales.index');
    }
    public function sales(){
    	return view('sales.index');
    }
    public function inventory(){
    	return view('inventory.index');
    }
    public function category(){
        return view('categories');
    }
    public function reports(){
        return view('reports.index');
    }
    public function settings(){
        return view('settings.index');
    }
}
