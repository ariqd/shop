<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class FindController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // dd($request->q);
        // dd(Product::where('code', 'like', $request->q)->orWhere('name', 'like', $request->q)->get());
        if (!$request->q) {
            return redirect()->back();
        }

        return view('front.product.index', [
            'products' => Product::where('code', 'like', '%' . $request->q . '%')->orWhere('name', 'like', '%' . $request->q . '%')->get(),
            'term' => $request->q,
            'find' => true
        ]);
    }
}
