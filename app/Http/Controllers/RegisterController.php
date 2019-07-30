<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\RegistersWithdrawAmount;
use App\RegistersActivity;
use App\SalesRegister;
use App\Sales;
use App\SalesItem;
use App\Item;
use Carbon\Carbon;
use PDF;
class RegisterController extends Controller
{
	public function __construct()
	{
	$this->middleware('auth');
	}

	public function index()
	{
		return view('sales.register.index');
	}
	    public function register_amount_store(Request $request)
    {

    	$totalRegisterAmount = 
		$request->amount[0] * 0.01 +
		$request->amount[1] * 0.05 +
		$request->amount[2] * 0.10 +
		$request->amount[3] * 0.25 +
		$request->amount[4] * 1 + 
		$request->amount[5] * 5 +
		$request->amount[6] * 10 +
		$request->amount[7] * 20 +
		$request->amount[8] * 50 +
		$request->amount[9] * 100 +
		$request->amount[10] * 200 +
		$request->amount[11] * 500 +
		$request->amount[12] * 1000
		;
		SalesRegister::updateOrCreate(['id' => 1], ['amount' => $totalRegisterAmount, 'user_id' => Auth::user()->id, 'active' => true]);
		RegistersActivity::Create(['starting_amount' => $totalRegisterAmount]);
		
		return redirect('sales');

    }

	public function reports_close_register()
	{
		$lastid = RegistersActivity::orderBy('created_at', 'desc')->first()->id;
		$RegisterStartingAmount = RegistersActivity::findorFail($lastid);
		$nowTime = Carbon::now()->format('Y-m-d H:i:s');
		$payments = SalesItem::whereBetween('created_at', [$RegisterStartingAmount->created_at, $nowTime])->sum('price');
		$withdraw = RegistersWithdrawAmount::whereBetween('created_at', [$RegisterStartingAmount->created_at, $nowTime])->sum('amount');

        $items = Item::where('category', 'bread')->orderBy('quantity', 'asc')->get();
        $carbonNow = Carbon::now()->format('g:i a \o\n l jS F Y');
		return view('sales.register.close_register' , compact('RegisterStartingAmount', 'payments' , 'withdraw' ,'items', 'carbonNow'));
	}

		public function reports_close_print()
	{
        $items = Item::where('quantity', '>=', '1')->where('category', 'bread')->orderBy('quantity', 'asc')->get();
        $carbonNow = Carbon::now()->format('g:i a \o\n l jS F Y');
		$pdf = PDF::loadView('sales.register.close_register_print' , compact('items', 'carbonNow'));
		return $pdf->stream('invoice.pdf');
	}	

	    public function reports_close_register_store(Request $request)
    {

    	$totalClosingRegisterAmount = 
		$request->amount[0] * 0.01 +
		$request->amount[1] * 0.05 +
		$request->amount[2] * 0.10 +
		$request->amount[3] * 0.25 +
		$request->amount[4] * 1 + 
		$request->amount[5] * 5 +
		$request->amount[6] * 10 +
		$request->amount[7] * 20 +
		$request->amount[8] * 50 +
		$request->amount[9] * 100 +
		$request->amount[10] * 200 +
		$request->amount[11] * 500 +
		$request->amount[12] * 1000
		;
		$lastid = RegistersActivity::orderBy('created_at', 'desc')->first()->id;
		$RegistersClosingAmount = RegistersActivity::find($lastid);
		$RegistersClosingAmount->ending_amount = $totalClosingRegisterAmount;
		$RegistersClosingAmount->save();
		SalesRegister::updateOrCreate(['id' => 1], ['active' => false]);

		return redirect('sales');

    }
    public function withdraw_amount()
    {

        return view('sales.register.withdraw_amount');
   
    }

    public function withdraw_amount_store(Request $request)
    {

    	$totalWithdrawAmount = 
		$request->amount[0] * 0.01 +
		$request->amount[1] * 0.05 +
		$request->amount[2] * 0.10 +
		$request->amount[3] * 0.25 +
		$request->amount[4] * 1 + 
		$request->amount[5] * 5 +
		$request->amount[6] * 10 +
		$request->amount[7] * 20 +
		$request->amount[8] * 50 +
		$request->amount[9] * 100 +
		$request->amount[10] * 200 +
		$request->amount[11] * 500 +
		$request->amount[12] * 1000
		;

    	$request->amount = implode($request->amount, ',');

		$lastid = RegistersActivity::orderBy('created_at', 'desc')->first()->id;

		RegistersWithdrawAmount::create(['amount' => $totalWithdrawAmount, 'registers_activities_id' => $lastid]);
		return redirect('sales');

    }
}
