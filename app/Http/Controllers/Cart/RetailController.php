<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RetailController extends Controller
{
    public function create()
    {
        $data['stocks'] = Stock::with('product')->latest()->get();
        $data['customers'] = Customer::latest()->get();
        $counter = Counter::where("name", "=", "SO")->first();
        $data['no_so'] = "SO" . date("ymd") . str_pad(Auth::id(), 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);

        return view('sales-toko.form', $data);
    }
}
