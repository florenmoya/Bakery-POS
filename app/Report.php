<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sales;
use Carbon\Carbon;

class Report extends Model
{

    public function reportSales($from, $to)
    {

        $report = Sales::whereBetween('created_at', array($from, $to))->get();


    	return $report;
    }

    public function dateHour($hour)
    {

	    $year = Carbon::now()->format('Y');
		$month = Carbon::now()->format('m');
		$day = Carbon::now()->format('d');
		$minute = 00; 
		$second = 00; 
		$tz = 'Asia/Singapore';

    	$date = Carbon::create($year, $month, $day, $hour, $minute, $second, $tz);

    	return $date;
    	
    }
}
