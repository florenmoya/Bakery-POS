<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistersActivity extends Model
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
        public function RegistersWithdrawAmount()
        {
        	return $this->hasMany('App\RegistersWithdrawAmount');
        }
}
