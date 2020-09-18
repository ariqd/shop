<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Helpers\Rajaongkir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    public function index()
    {
        $data['customers'] = Customer::latest()->get();

        // dd(getenv("RAJAONGKIR_URL"));
        // $arrayOfCustomerIds = Customer::all()->pluck('id')->toArray();
        // dd($arrayOfCustomerIds);

        return view('customer.index', $data);
    }

    public function create()
    {
        $rajaongkir = new Rajaongkir;
        $data['provinces'] = $rajaongkir->get('province');

        return view('customer.form', $data);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'province_id' => ['required', 'numeric'],
            'city_id' => ['required', 'numeric'],
            'phone' => ['required'],
            'status' => ['required'],
        ])->validate();

        $rajaongkir = new Rajaongkir;
        $data['province_name'] = $rajaongkir->get('province?id=' . $data['province_id'])->province;
        $data['city_name'] = $rajaongkir->get('city?id=' . $data['city_id'])->city_name;

        Customer::create($data);

        return redirect()->back()->with('info', 'Customer baru berhasil ditambahkan!');
    }

    public function edit(Customer $customer)
    {
        $rajaongkir = new Rajaongkir;
        $data['customer'] = $customer;
        $data['provinces'] = $rajaongkir->get('province');
        $data['province_name'] = $rajaongkir->get('province?id=' . $customer->province_id)->province;
        $data['cities'] = $rajaongkir->get('city?province=' . $customer->province_id);
        $postFields = [
            'origin' => 22, // Kota Bandung
            'destination' => $customer->city_id,
            'weight' => 1,
            'courier' => 'jne',
        ];

        $rajaongkir = new Rajaongkir;
        $cost = json_decode($rajaongkir->post('cost', $postFields)->getBody());

        return view('customer.form', $data);
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->all();

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'province_id' => ['required', 'numeric'],
            'city_id' => ['required', 'numeric'],
            'phone' => ['required', 'unique:customers'],
            'status' => ['required'],
        ])->validate();

        $rajaongkir = new Rajaongkir;
        $data['province_name'] = $rajaongkir->get('province?id=' . $data['province_id'])->province;
        $data['city_name'] = $rajaongkir->get('city?id=' . $data['city_id'])->city_name;

        $customer->update($data);

        return redirect()->back()->with('info', 'Customer berhasil di-update!');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->back()->with('info', 'Customer berhasil dihapus!');
    }

    public function searchCities($id)
    {
        $rajaongkir = new Rajaongkir;
        $data = $rajaongkir->get('city?province=' . $id);

        return response()->json($data, 200);
    }
}
