<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\Contracts\Buyable;

class Stock extends Model implements Buyable
{
    protected $table = 'inventories';
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function scopeAvailable($query)
    {
        return $query->where('qty', '>', 0);
    }

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    public function getBuyableDescription($options = null)
    {
        return $this->product->code . ' - ' . $this->product->name;
    }

    public function getBuyablePrice($options = null)
    {
        return $this->product->price;
    }
}
