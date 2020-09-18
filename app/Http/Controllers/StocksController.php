<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StocksController extends Controller
{
    public function index()
    {
        $data['stocks'] = Stock::latest()->get();

        return view('stock.index', $data);
    }

    public function create()
    {
        $data['products'] = Product::latest()->get();
        $data['sizes'] = ['XS', 'S', 'M', 'L', 'XL'];
        $data['colors'] = ['Merah', 'Kuning', 'Hijau', 'Biru', 'Coklat', 'Hitam', 'Putih'];

        return view('stock.form', $data);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        unset($data['_token']);

        Validator::make($data, [
            'size.xs' => ['numeric', 'min:0'],
            'size.s' => ['numeric', 'min:0'],
            'size.m' => ['numeric', 'min:0'],
            'size.l' => ['numeric', 'min:0'],
            'size.xl' => ['numeric', 'min:0'],
        ])->validate();

        foreach ($data['size'] as $size => $qty) {
            Stock::create([
                'product_id' => $data['product_id'],
                'color' => $data['color'],
                'size' => strtoupper($size),
                'qty' => $qty ?: 0,
            ]);
        }

        return redirect()->back()->with('info', 'Stok Produk baru berhasil ditambahkan!');
    }

    public function edit(Stock $stock)
    {
        $data['products'] = Product::latest()->get();
        $data['sizes'] = ['XS', 'S', 'M', 'L', 'XL'];
        $data['colors'] = ['Merah', 'Kuning', 'Hijau', 'Biru', 'Coklat', 'Hitam', 'Putih'];
        $data['stock'] = $stock;

        return view('stock.form', $data);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->all();

        dd($product);

        // Validator::make($data, [
        //     'product_id' => ['required'],
        //     'size' => ['required'],
        //     'color' => ['required'],
        //     'qty' => ['required'],
        // ])->validate();

        // $stock->update($data);

        return redirect()->back()->with('info', 'Stok Produk berhasil di-update!');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->back()->with('info', 'Stok Produk berhasil dihapus!');
    }
}
