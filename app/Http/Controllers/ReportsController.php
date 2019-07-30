<?php
namespace App\Http\Controllers;

use App\Report;
use App\Sales;
use App\SalesItem;
use App\Item;
use App\Coins;
use App\RegistersActivity;
use App\RegistersWithdrawAmount;
use App\Deliver;
use App\DeliveriesItem;
use Spatie\Activitylog\Models\Activity;
use DB;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
	public function __construct()
    {
    $this->middleware('auth');
    }
    public function sales_today(Request $request)
    {
    	if(!empty($request->selectedDate)){
            $selectedDateArray = $request->selectedDate;
    		$selectedDate = explode(' to ', $selectedDateArray);
            $from = date('Y-m-d H:i:s',strtotime($selectedDate[0]));
            $to = date('Y-m-d H:i:s',strtotime($selectedDate[1]));
            $sales = Sales::whereBetween('created_at', [$from, $to])->get();
    	}else{
            $selectedDateArray = null;
        

		$report = new Report();
		$daytoday = $report->dateHour(07);
		$nighttoday = $report->dateHour(19);

        $from = Carbon::today();
        $to = Carbon::tomorrow();


        $sales = Sales::whereBetween('created_at', [$from, $to])->get();

    }
		return view('reports.sales_today', compact('sales','selectedDateArray'));
		
    }
    	public function inventory()
	{
        $items = Item::all()->sortBy('quantity');
		return view('reports.inventory', compact('items'));
	}
    public function closing_counts()
    {

        $RegistersActivities = RegistersActivity::with(array('sales'=>function($query){
        $query->with('SalesItem');
        }))->get();
        $withdraws = RegistersWithdrawAmount::all();
        $totalwithdraws = 0;
        $total_sales = 0;
        return view('reports.closing_counts', compact('RegistersActivities' , 'total_sales', 'withdraws', 'totalwithdraws'));
    }	
        public function deliveries_total()
    {
        $items = DeliveriesItem::groupBy('description')
        ->selectRaw('sum(quantity) as total_quantity, `deliveries_id`, `description`, `type`, `price`, `quantity`, `category`')
        ->get();

        return view('reports.deliveries', compact('items'));
    }
            public function activity_logs()
    {

        $activities = Activity::all();

        return view('reports.activity_logs', compact('activities'));
    }
}
