<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $data['customers'] = Customer::latest()->get();

        return view('front.index', [
            'latestProducts' => Product::has('stocks')->latest()->limit(4)->get()
        ]);
    }
}
