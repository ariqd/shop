<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    public function stocks()
    {
        return $this->hasMany('App\Stock', 'product_id');
    }
}
