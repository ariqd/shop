<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function details()
    {
        return $this->hasMany('App\Purchase_detail');
    }

    public function scopeWhereStatus($query, $value)
    {
        return $query->where('status', $value);
    }
}
