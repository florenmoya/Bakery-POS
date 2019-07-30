<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Deliver extends Model
{

        use LogsActivity;
        protected $guarded = [];
        protected static $logUnguarded = true;
        
        public $table = 'deliveries';

        public function DeliveriesItem()
        {
        	return $this->hasMany('App\DeliveriesItem' , 'deliveries_id');
        }
}
