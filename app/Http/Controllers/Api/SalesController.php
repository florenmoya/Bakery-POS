<?php
namespace App\Http\Controllers\Api;
use App\Item;
use App\Sales;
use App\SalesItem;
use App\SalesRegister;
use App\RegistersActivity;
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
       public function all(SalesItem $items)
    {
        $data = $items->all();
        return response($data); 
    }
    
    public function store(Request $request)
    {
                $currentRegister = RegistersActivity::orderBy('created_at', 'desc')->first()->id;
                $sales_id = Sales::create(['registers_activity_id' =>$currentRegister])->id;
                //validation
                foreach($request->items as $items)
                    {
                        $item = Item::findOrFail($items['id']);
                        if(!$item){                        
                            return $item;
                        }
                    }
                //query
                foreach($request->items as $items)
                    {
                        $item = Item::findOrFail($items['id']);
                    if($items['cart_quantity'] > 0){
                        $createddata = SalesItem::create([
                        'sales_id' => $sales_id,
                        'quantity' => $items['cart_quantity'],
                        'price' => $item['price']*$items['cart_quantity'],
                        'item_cost' => $item['item_cost'],
                        'item_id' => $items['id'],
                        ]);
                        $item = Item::find($items['id']);
                        $item->quantity = $item->quantity - $items['cart_quantity'];
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
    public function report_sales()
    {
        $data = SalesItem::with('Item')->get();
        return response($data);
    }
}