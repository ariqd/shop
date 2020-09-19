<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    // private $categories = [
    //     'Hijab',
    //     'Gamis',
    //     'Blus',
    //     'Rompi',
    //     'Rok'
    // ];

    public function index()
    {
        $data['products'] = Product::latest()->get();

        $data['categories'] = Category::orderBy('name')->get();

        // dd($data['categories']);

        if (@$_GET['product_id']) {
            $product = Product::find(@$_GET['product_id']);
            if ($product)
                $data['product'] = $product;
        }

        return view('product.index', $data);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        unset($data['_token']);

        $data['price'] = $this->toNumber($data['price']);

        $data['slug'] = strtolower(Str::slug($data['code'])) . '-' . strtolower(Str::slug($data['name']));

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $extension = $request->image->extension();
                $request->image->storeAs('/public', $data['name'] . "." . $extension);
                $url = Storage::url($data['name'] . "." . $extension);
                $data['image'] = $url;
            }
        } else {
            abort(500, 'Could not upload image :(');
        }

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:products'],
            'code' => ['required', 'string', 'max:255', 'unique:products'],
            // 'description' => ['string'],
            'image' => ['required'],
            'price' => ['required', 'numeric', 'min:100'],
            'category_id' => ['required'],
        ])->validate();

        $product = Product::create($data);

        if ($product) {
            return redirect('admin/products')->with('info', 'Produk baru berhasil ditambahkan!');
        }

        return redirect('admin/products')->with('error', `$product->code $product->name berhasil di update!`);
    }

    public function show(Product $product)
    {
        $color = request()->get('edit');

        return view('product.stock', [
            'product' => $product,
            'sizes' => ['XS', 'S', 'M', 'L', 'XL'],
            'edit' => $color ? $product->stocks()->where('color', $color)->get()->groupBy('size')->toArray() : null,
            'colors' => $product->stocks()->select('color')->groupBy('color')->latest()->get()->toArray()
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->all();

        $data['price'] = $this->toNumber($data['price']);

        $data['slug'] = strtolower(Str::slug($data['code'])) . '-' . strtolower(Str::slug($data['name']));

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $extension = $request->image->extension();
                $request->image->storeAs('/public', $data['name'] . "." . $extension);
                $url = Storage::url($data['name'] . "." . $extension);
                $data['image'] = $url;
            }
        }

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
            // 'description' => ['string'],
            'price' => ['required', 'numeric', 'min:100'],
            'category_id' => ['required'],
        ])->validate();

        $product->update($data);

        return redirect('admin/products')->with('info', 'Produk berhasil di-update!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('admin/products')->with('info', 'Produk berhasil dihapus!');
    }

    public function updateStock(Request $request, Product $product)
    {
        $data = $request->all();

        foreach ($data['size'] as $size => $qty) {
            $stock = $product->stocks()->where([
                'color' => $data['color'],
                'size' => $size
            ])->first();

            $stock->qty = $qty;
            $stock->qty_hold = $data['hold'][$size];
            $stock->safety = $data['safety'][$size];

            $stock->save();
        }

        return redirect()->back()->with('info', 'Stok berhasil di-update!');
    }
}
