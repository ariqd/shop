<?php

namespace App\Http\Controllers;

use App\Counter;
use App\Customer;
use App\Helpers\Rajaongkir;
use App\Product;
use App\Purchase;
use App\Purchase_detail;
use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    private $couriers = [
        'jne' => 'JNE',
        'pos' => 'Pos Indonesia',
        'tiki' => 'TIKI',
    ];

    private $months = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];

    public function index()
    {
        $year = request()->get('y') ?: date('Y');
        $month = request()->get('m') ?: date('m');

        $data['sales'] = Purchase::latest()
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        $data['months'] = $this->months;

        $data['year_today'] = $year;
        $data['month_today'] = $month;

        return view('sales.index', $data);
    }

    public function create()
    {
        $data['products'] = Product::has('stocks')->latest()->get();

        $data['customers'] = Customer::latest()->get()->except(1);

        $counter = Counter::where("name", "=", "SO")->first();

        $data['no_so'] = "SO" . date("ymd") . str_pad(Auth::id(), 2, 0, STR_PAD_LEFT) . str_pad($counter->counter, 5, 0, STR_PAD_LEFT);

        $data['couriers'] = $this->couriers;

        return view('sales.form', $data);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $purchase = Purchase::create([
            'customer_id' => $data['customer_id'],
            'sales_id' => Auth::id(),
            'purchase_no' => $data['purchase_no'],
            'courier_name' => $data['courier_name'],
            'courier_service_name' => $data['courier_service_name'],
            'courier_fee' => $data['courier_fee'],
            'discount' => $data['discount'],
            'status' => 'BELUM LUNAS',
            'weight' => $data['weight'],
            'total' => $data['total'],
        ]);

        if ($purchase) {
            $counter = Counter::where("name", "=", "SO")->first();
            $counter->counter += 1;
            $counter->save();

            foreach ($data['item'] as $value) {
                foreach ($value['qty'] as $size => $quantity) {
                    if ($quantity > 0) {
                        $stock = Stock::where([
                            'product_id' => $value['id'],
                            'color' => $value['color'],
                            'size' => $size
                        ])->first();

                        if ($size == 'S' || $size == 'M' || $size == 'L') {
                            if ($purchase->customer->status == 'Distributor' && $quantity < 2) {
                                return redirect()->back()->with(
                                    'info',
                                    'Produk ' . $stock->product->code . ' dibawah 2. Distributor harus membeli minimal 1 Set S, M, dan L masing-masing 2pcs'
                                );
                            } elseif ($quantity < 1) {
                                return redirect()->back()->with(
                                    'info',
                                    'Produk ' . $stock->product->code . ' dibawah 1. Agen harus membeli minimal 1 Set S, M, dan L masing-masing 1pcs'
                                );
                            }
                        }

                        // if ($stock->qty < $quantity) {
                        //     $stock->keep += $stock->qty;
                        //     $stock->qty_hold += ($quantity - $stock->qty);
                        //     $stock->qty = 0;
                        // } else {
                        //     $stock->keep += $quantity;
                        //     $stock->qty -= $quantity;
                        // }

                        if ($stock->qty < $quantity) {
                            $stock->keep += $stock->qty;
                            $stock->qty = 0;
                        } else {
                            $stock->qty -= $quantity;
                            $stock->keep += $quantity;
                        }

                        $stock->save();

                        Purchase_detail::create([
                            'purchase_id' => $purchase->id,
                            'inventory_id' => $stock->id,
                            'qty' => $quantity,
                            'status' => 'OK',
                            'subtotal' => $quantity * $stock->product->price
                        ]);
                    }
                }
            }

            return redirect()->back()->with('info', 'Nota penjualan toko berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Nota penjualan toko gagal ditambahkan!');
        }
    }

    public function edit($id)
    {
        $data['sale'] = Purchase::with('details.stock.product')->find($id);
        $data['stocks'] = Stock::with('product')->latest()->get();
        $data['customers'] = Customer::latest()->get()->except(1);
        $data['couriers'] = $this->couriers;

        return view('sales.form', $data);
    }

    public function update(Request $request, $id)
    {
        $purchase = Purchase::with('details')->find($id);

        $purchase->fill($request->only([
            'courier_name',
            'courier_service_name',
            'courier_fee',
            'discount'
        ]))->save();

        return redirect()->back()->with('info', 'Nota penjualan toko berhasil diupdate!');
    }

    public function search($id)
    {
        $data['product'] = Product::with('stocks')->find($id);
        $data['colors'] = $data['product']->stocks()->get(['color', 'qty'])->groupBy('color')->toArray();

        return response()->json($data, 200);
    }

    public function searchCustomer($id)
    {
        $data['customer'] = Customer::find($id);

        return response()->json($data, 200);
    }

    public function cost(Request $request)
    {
        $input = $request->all();

        $postFields = [
            'origin' => 23, // Kota Bandung
            'destination' => $input['destination'],
            'weight' => $input['weight'],
            'courier' => $input['courier'],
        ];

        $rajaongkir = new Rajaongkir;
        $cost = $rajaongkir->post('cost', $postFields);
        $data = json_decode($cost->getBody());

        return response()->json($data, 200);
    }

    public function makeLunas($id)
    {
        $sale = Purchase::find($id);
        $sale->status = 'LUNAS';
        $sale->save();

        foreach ($sale->details as $detail) {
            $stock = Stock::find($detail->inventory_id);
            // $stock->qty -= $detail->qty;
            // if ($stock->keep < $detail->qty) {
            // $stock->keep -= $detail->qty;
            $stock->keep -= $detail->qty;
            // }

            if ($stock->keep < 0) {
                // if ($stock->qty < 0) {
                $hold = abs($stock->keep - 0);

                $stock->qty_hold += $hold;

                $stock->keep = 0;

                $detail->status = 'HOLD';

                $detail->save();
            }

            $stock->save();
        }

        return redirect()->back()->with('info', 'Status Nota penjualan berhasil diubah!');
    }

    public function makeDikirim($id)
    {
        $sale = Purchase::find($id);
        $sale->status = 'DIKIRIM';
        $sale->save();

        return redirect()->back()->with('info', 'Status Nota penjualan berhasil diubah!');
    }

    public function makeFinish($id)
    {
        $sale = Purchase::find($id);
        $sale->status = 'FINISH';
        $sale->save();

        return redirect()->back()->with('info', 'Status Nota penjualan berhasil diubah!');
    }

    public function makeCancel($id)
    {
        $sale = Purchase::find($id);

        $sale->status = 'CANCEL';

        foreach ($sale->details as $detail) {
            $stock = Stock::find($detail->inventory_id);

            if ($stock->keep < $detail->qty) {
                $stock->qty += $stock->keep;
            } else {
                $stock->qty += $detail->qty;
            }

            $stock->keep -= $detail->qty;

            if ($stock->keep < 0) {
                // $hold = abs($stock->keep - 0);

                // $stock->qty_hold += $hold;

                $stock->keep = 0;

                // $detail->status = 'HOLD';

                // $detail->save();
            }

            $stock->save();
        }

        $sale->save();

        return redirect()->back()->with('info', 'Status Nota penjualan berhasil diubah!');
    }

    public function deleteDetail($id)
    {
        $stock = Stock::find($id);

        $stock->delete();

        return redirect()->back()->with('info', 'Detail penjualan berhasil diubah!');
    }
}
