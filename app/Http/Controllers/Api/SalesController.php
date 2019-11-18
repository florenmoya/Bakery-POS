<?php
namespace App\Http\Controllers\Api;
use App\Item;
use App\Categories;
use App\Sales;
use App\SalesItem;
use App\SalesRegister;
use App\RegistersActivities;
use App\Mail\SupplyDepleted;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
class SalesController extends Controller
{
    public function index(){
        $register = SalesRegister::find(1);
        return response($register);
    }
       public function all(Request $request)
    {
        $data = Sales::where('company_id', $request->user()->company_id)->get();
        return response($data); 
    }
    
    public function store(Request $request)
    {
                $total = 0;
                //validation
                foreach($request->items as $items)
                    {
                        $item = Item::findOrFail($items['id']);
                        if(!$item){                        
                            return $item;
                        }

                        $total += $items['cart_quantity']*$items['price'];
                    }
            $latest = RegistersActivities::where('company_id', $request->user()->company_id)->latest('created_at')->first();
            if($latest->released_amount){ 
                return response('Error', 401);
            }
            $sales_id = Sales::create(['company_id' => $request->user()->company_id, 'amount' => $total, 'user_id' => $request->user()->id, 'registers_activities_id' => $latest->id])->id;
                //query
                foreach($request->items as $items)
                    {
                        //query item
                        $item = Item::findOrFail($items['id']);
                        //
                        if($items['cart_quantity'] > 0){
                            //continue if cart quantity is greater than 0
                                $createddata = SalesItem::create([
                                'sales_id' => $sales_id,
                                'quantity' => $items['cart_quantity'],
                                'price' => $item['price']*$items['cart_quantity'],
                                'item_id' => $items['id'],
                                'company_id' => $request->user()->company_id,
                                ]);
                                
                            $item = Item::find($items['id']);
                            $item->stock = $item->stock - $items['cart_quantity'];
                            $item->save();
                        }
                    }
           // Mail::to('test@test.com')->send(new SupplyDepleted());
        return response($createddata);
    }
    public function sale_register_store(Request $request)
    {
        $SalesRegister = SalesRegister::updateOrCreate(['id' => 1], ['amount' => $request->amount, 'username' => $request->username, 'active' => true]);
        RegistersActivity::Create(['starting_amount' => $request->amount]);
        
        return response($SalesRegister);
    }
    public function sales_register_close_store(Request $request)
    {
        $lastid = RegistersActivity::orderBy('created_at', 'desc')->first()->id;
        $RegistersClosingAmount = RegistersActivity::find($lastid);
        $RegistersClosingAmount->ending_amount = $request->amount;
        $RegistersClosingAmount->save();
        SalesRegister::updateOrCreate(['id' => 1], ['active' => false]);
        return response($RegistersClosingAmount);
    }
    public function report_sales(Request $request)
    {
        $data = SalesItem::where('company_id', $request->user()->company_id)->where('created_at', '>=', Carbon::now()->subDays(8))->with(array('Item'=>function($query){
        $query->with('Categories');}))->get();
        return response($data);
    }
}
