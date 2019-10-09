<?php

namespace App\Http\Controllers\Api;
use Carbon\Carbon;

use App\Item;
use App\Sales;
use App\Deliver;
use App\Category;
use App\SalesItem;
use App\SalesRegister;
use App\DeliveriesItem;
use App\RegistersActivity;
use App\RegistersWithdrawAmount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
        public function closing_counts()
    {
        $RegistersActivities = RegistersActivity::with(array('sales'=>function($query){
        $query->with('SalesItem');
        }))->with(array('refunds'=>function($query){
        $query->with('RefundsItem');
        }))->get();
        return response($RegistersActivities);
    }	
            public function dashboard(SalesItem $items)
    {
        
        $today = Carbon::today();
        $top_product = $items->with(array('Item'=>function($query){
        $query->with('Category');
        }))->selectRaw('SUM(quantity) AS total_quantity, item_id')->groupBy('item_id')->orderByRaw('SUM(quantity) DESC')->limit(10)->get();

        $restock = Item::with('Category')->where('quantity', '<=', 3)->orderBy('quantity', 'DESC')->get();

        $month_bread_delivery = DeliveriesItem::selectRaw('SUM(price) AS total_price')->whereHas('Item', function($q){$q->where('category_id', 1);})->whereDate('created_at', Carbon::today())->get();
        $today_sales = $items->selectRaw('SUM(price) as total_price')->whereDate('created_at', Carbon::today())->get();
        $month_revenue = $items->selectRaw('SUM(price) as total_price')->whereMonth('created_at', Carbon::today())->get();
        $dashboard = array('month_bread_delivery' => $month_bread_delivery[0]->total_price, 'today_sales' => $today_sales[0]->total_price, 'month_revenue' => $month_revenue[0]->total_price, 'top_product' => $top_product, 'restock' => $restock);
        return response($dashboard); 
    }

}
