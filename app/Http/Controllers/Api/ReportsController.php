<?php

namespace App\Http\Controllers\Api;

use App\RegistersActivity;
use App\RegistersWithdrawAmount;
use App\Deliver;
use App\DeliveriesItem;
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
}
