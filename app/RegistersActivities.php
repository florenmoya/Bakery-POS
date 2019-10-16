<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistersActivities extends Model
{
        protected $guarded = [];		

        public function sales()
        {
        	return $this->hasMany('App\Sales');
        }
        public function refunds()
        {
        	return $this->hasMany('App\Refunds');
        }
}
