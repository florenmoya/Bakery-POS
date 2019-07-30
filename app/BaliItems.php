<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class BaliItems extends Model
{
            use LogsActivity;
        protected $guarded = [];
        protected static $logUnguarded = true;
}
