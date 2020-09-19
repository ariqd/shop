<?php

namespace App\Http\Controllers\Customer;

// use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index($slug = '')
    {
        $products = Product::has('stocks')->whereHas('category', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->get();

        return view('front.product.index', [
            'products' => $products,
            'category' => ucwords(str_replace('-', ' ', $slug))
        ]);
    }

    public function show($slug = '')
    {
        $product = Product::where('slug', $slug)->first();

        $colors = $product->stocks()->get(['color', 'qty'])->groupBy('color')->toArray();

        // dd($colors);

        return view('front.product.detail', [
            'product' => $product,
            'colors' => $colors,
        ]);
    }
}
