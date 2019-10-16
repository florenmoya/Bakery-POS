<?php

namespace App\Http\Controllers\Api;
use Carbon\Carbon;

use App\Item;
use App\Sales;
use App\Deliver;
use App\Categories;
use App\SalesItem;
use App\SalesRegister;
use App\DeliveriesItem;
use App\RegistersActivities;
use App\RegistersWithdrawAmount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
        public function closing_counts(Request $request)
    {
        $RegistersActivities = RegistersActivities::where('company_id', $request->user()->company_id)->with(array('sales'=>function($query){
        $query->with('SalesItem');
        }))->with(array('refunds'=>function($query){
        $query->with('RefundsItem');
        }))->get();
        return response($RegistersActivities);
    }	
            public function dashboard(SalesItem $items, Request $request)
    {
        
        $today = Carbon::today();

        $top_product = $items->where('company_id', $request->user()->company_id)->with(array('Item'=>function($query){
        $query->with('Categories');
        }))->selectRaw('SUM(price) AS total_price, item_id')->groupBy('item_id')->orderByRaw('SUM(quantity) DESC')->whereMonth('created_at', Carbon::today())->limit(25)->get();

        $restock = Item::where('company_id', $request->user()->company_id)->with('Categories')->where('stock', '<=', 3)->orderBy('stock', 'ASC')->get();

        $month_bread_delivery = DeliveriesItem::where('company_id', $request->user()->company_id)->selectRaw('SUM(price) AS total_price')->whereHas('Item', function($q){$q->where('category_id', 1);})->whereMonth('created_at', Carbon::today())->get();

        $today_sales = $items->where('company_id', $request->user()->company_id)->selectRaw('SUM(price) as total_price')->whereDate('created_at', Carbon::today())->get();

        $month_revenue = $items->where('company_id', $request->user()->company_id)->selectRaw('SUM(price) as total_price')->whereMonth('created_at', Carbon::today())->get();

        $dashboard = array('month_bread_delivery' => $month_bread_delivery[0]->total_price, 'today_sales' => $today_sales[0]->total_price, 'month_revenue' => $month_revenue[0]->total_price, 'top_product' => $top_product, 'restock' => $restock);
        
        return response($dashboard); 
    }

}
