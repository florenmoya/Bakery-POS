<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefundsItem extends Model
{
            protected $guarded = [];

    public function Refunds()
    {
            return $this->belongsTo('App\Refunds');
    }

}
