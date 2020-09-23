<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Stock;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Cart::get('027c91341fd5cf4d2579b49c4b6a90da')->model->size);

        return view('front.cart.index', [
            'products' => Cart::content()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedRequest = $request->validate([
            'id' => ['required'],
            'name' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
        ]);

        $stock = Stock::find($validatedRequest['id']);

        if ($stock->qty < $validatedRequest['qty']) {
            return redirect()->back()->withErrors('Jumlah pembelian melebihi stok yang tersedia!');
        }

        $cartItem = Cart::search(function ($cartItem, $rowId) use ($validatedRequest) {
            return $cartItem->id === $validatedRequest['id'];
        })->first();

        if (!empty($cartItem)) {
            if (($stock->qty - $cartItem->qty) < $validatedRequest['qty']) {
                return redirect()->back()->withErrors('Jumlah pembelian melebihi stok yang tersedia!');
            }
        }

        // $cart = Cart::add($request->id, $request->name, $request->qty, $request->price, [
        //     'color' => $request->color,
        //     'size' => $request->size,
        // ]);

        $cart = Cart::add($stock, $request->qty);

        if ($cart) {
            return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
        }

        return redirect()->back()->withErrors('Produk gagal ditambahkan ke keranjang!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedRequest = $request->validate([
            'qty' => ['required', 'numeric', 'min:0'],
        ]);

        if ($validatedRequest['qty'] == 0) {
            Cart::remove($id);

            return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus');
        }

        $item = Cart::update($id, $validatedRequest['qty']);

        if ($item) {
            return redirect()->back()->with('success', 'Jumlah ' . $item->name . ' berhasil diubah menjadi ' . $validatedRequest['qty']);
        }

        return redirect()->back()->withErrors('Jumlah ' . $item->name . ' gagal diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }

    public function empty()
    {
        Cart::destroy();

        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan');
    }
}
