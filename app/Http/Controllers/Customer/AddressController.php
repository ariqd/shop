<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\Rajaongkir;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rajaongkir = new Rajaongkir;

        return view('front.address.index', [
            'provinces' => $rajaongkir->get('province'),
            'cities' => $rajaongkir->get('city?province=' . Auth::user()->customer->province_id)
        ]);
    }

    public function searchCities($id)
    {
        $rajaongkir = new Rajaongkir;
        $data = $rajaongkir->get('city?province=' . $id);

        return response()->json($data, 200);
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
        //
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

        $validated = $request->validate([
            'address' => 'required',
            'city_id' => 'required',
            'province_id' => 'required',
        ], [
            'province_id' => 'Provinsi harus dipilih',
            'city_id' => 'Kota harus dipilih',
        ]);

        $rajaongkir = new Rajaongkir;
        $validated['province_name'] = $rajaongkir->get('province?id=' . $validated['province_id'])->province;
        $validated['city_name'] = $rajaongkir->get('city?id=' . $validated['city_id'])->city_name;

        Auth::user()->customer->update($validated);

        return redirect()->back()->with('success', 'Alamat pengiriman berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
