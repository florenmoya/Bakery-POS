<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $guarded = [];

        public function Item()
    {
            return $this->hasMany('App\Item');
    }

}
