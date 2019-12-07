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
use Spatie\Activitylog\Models\Activity;

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
            public function currents_sales(Request $request)
    {
        $total_sales = 0;
        $total_refunds = 0;

        $RegistersActivities = RegistersActivities::where('company_id', $request->user()->company_id)->with(array('sales'=>function($query){
        $query->with('SalesItem');
        }))->with(array('refunds'=>function($query){
        $query->with('RefundsItem');
        }))->orderBy('created_at', 'desc')
        ->limit(1)->get();
        $starting_amount = $RegistersActivities[0]->starting_amount;
        foreach($RegistersActivities[0]->sales as $sales){
            $total_sales += $sales->amount;
        }
        foreach($RegistersActivities[0]->refunds as $refunds){
            $total_refunds += $refunds->amount;
        }
        $current_sales = array('total_sales' => $total_sales, 'total_refunds' => $total_refunds, 'current_cash' => $starting_amount+$total_sales);
        return response($current_sales);
    }
            public function dashboard(SalesItem $items, Request $request)
    {
        $bread_category = Categories::where('company_id', $request->user()->company_id)->where('name', 'Bread')->get();

        $today = Carbon::today();

        $top_product = $items->where('company_id', $request->user()->company_id)->with(array('Item'=>function($query){
        $query->with('Categories');
        }))->selectRaw('SUM(price) AS total_price, item_id')->groupBy('item_id')->orderByRaw('SUM(quantity) DESC')->whereMonth('created_at', Carbon::today())->limit(25)->get();

        $restock = Item::where('company_id', $request->user()->company_id)->with('Categories')->where('stock', '<=', 3)->orderBy('stock', 'ASC')->get();

        $month_bread_delivery = DeliveriesItem::where('company_id', $request->user()->company_id)->selectRaw('SUM(price) AS total_price')->whereHas('Item', function($q) use($bread_category){$q->where('category_id', $bread_category[0]->id);})->whereMonth('created_at', Carbon::today())->get();

        $today_sales = $items->where('company_id', $request->user()->company_id)->selectRaw('SUM(price) as total_price')->whereDate('created_at', Carbon::today())->get();

        $month_revenue = $items->where('company_id', $request->user()->company_id)->selectRaw('SUM(price) as total_price')->whereMonth('created_at', Carbon::today())->get();

        $dashboard = array('month_bread_delivery' => $month_bread_delivery[0]->total_price, 'today_sales' => $today_sales[0]->total_price, 'month_revenue' => $month_revenue[0]->total_price, 'top_product' => $top_product, 'restock' => $restock);
        
        return response($dashboard); 
    }
    public function activity_log(Request $request){
            $activity = Activity::where('properties->attributes->company_id', $request->user()->company_id)->get();
            return response($activity);
    }
}
