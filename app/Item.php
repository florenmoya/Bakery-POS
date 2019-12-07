<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class Item extends Model
{
    use LogsActivity;

    protected $guarded = [];

    protected static $logAttributes = ['description', 'stock', 'price', 'company_id'];

    public function SalesItem()
    {
        return $this->hasMany('App\SalesItem');
    }
    public function DeliveriesItem()
    {
        return $this->hasMany('App\DeliveriesItem');
    }
    public function Categories()
    {
        return $this->belongsTo('App\Categories', 'category_id');
    }
    public function BaliItems()
    {
        return $this->hasMany('App\BaliItems');
    }
}
