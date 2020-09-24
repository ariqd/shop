<?php

namespace App\Http\Controllers\Customer;

use App\Counter;
use App\Http\Controllers\Controller;
use App\Purchase;
use App\Purchase_detail;
use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login')->withInfo('Harap Masuk atau Daftar untuk melanjutkan');
        }

        $data = $request->validate([
            'courier_fee' => 'required|numeric',
            'courier_name' => 'required|string',
            'courier_service_name' => 'required|string',
            'subtotal' => 'required|numeric',
        ]);

        $counter = Counter::where("name", "=", "SO")->first();
        $no_so = "SO" . date("ymd") . str_pad(Auth::id(), 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);

        // foreach ($data['item'] as $value) {
        //     $stock = Stock::find($value['id']);

        //     if ($stock->qty < $value['qty']) {
        //         return redirect()->back()->with(
        //             'error',
        //             'Stok produk "' . $stock->product->code . ' ' . $stock->color . ' ' . $stock->size . '" tidak cukup untuk menyelesaikan transaksi! Stok tersedia: ' . $stock->qty
        //         );
        //     } else {
        //         $stock->qty -= $value['qty'];
        //         $stock->save();
        //     }
        // }

        $purchase = Purchase::create([
            // 'customer_id' => $data['customer_id'],
            'sales_id' => Auth::id(),
            'purchase_no' => $no_so,
            'courier_name' => $data['courier_name'],
            'courier_service_name' => $data['courier_service_name'],
            'courier_fee' => $data['courier_fee'],
            'discount' => 0,
            'status' => 'BELUM LUNAS',
            'weight' => 1,
            'total' => str_replace('.', '', Cart::total())
        ]);

        if ($purchase) {
            $counter = Counter::where("name", "=", "SO")->first();
            $counter->counter += 1;
            $counter->save();

            foreach (Cart::content() as $cartItem) {
                $stock = Stock::find($cartItem->id);

                if ($stock->qty < $cartItem->qty) {
                    $stock->keep += $stock->qty;
                    $stock->qty = 0;
                } else {
                    $stock->qty -= $cartItem->qty;
                    $stock->keep += $cartItem->qty;
                }

                $stock->save();

                Purchase_detail::create([
                    'purchase_id' => $purchase->id,
                    'inventory_id' => $cartItem->id,
                    'qty' => $cartItem->qty,
                    'status' => 'OK',
                    'subtotal' => str_replace('.', '', $cartItem->subtotal())
                ]);
            }

            return redirect()->route('front.checkout.success')->with([
                'info' => 'Pembelian berhasil!',
                'from-checkout' => TRUE,
            ]);
        } else {
            return redirect()->back()->withErrors('Pembelian gagal!');
        }
    }

    public function success()
    {
        if (!session('from-checkout')) {
            return redirect()->back();
        } else {
            Cart::destroy();

            return view('front.checkout.finish');
        }
    }
}
