<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Spatie\Activitylog\Traits\LogsActivity;

class Item extends Model
{
        // use LogsActivity;
        protected $guarded = [];
        protected static $logUnguarded = true;

    public function itemCheckout($id, $quantity , $oldquantity)
    {
    			$id->quantity = $oldquantity - $quantity;
                $id->save();
    }

    public function itemDelivery($id, $quantity , $oldquantity)
    {
    			$id->quantity = $oldquantity + $quantity;
                $id->save();
    }
}
