@extends('layouts.admint')

@push('css')

@endpush

@push('js')

@endpush

@section('content')
<div class="tb-content tb-style1">
    <div class="tb-padd-lr-30 tb-uikits-heading mb-3 mt-2">
        <h2 class="tb-uikits-title">
            {{ @$sale ? 'Detail / Edit Nota Penjualan' : 'Nota Penjualan' }}
            <small class="text-muted"># {{ @$sale ? $sale->purchase_no : $no_so }}</small>
        </h2>
        <a href="{{ route('sales.index') }}" class="btn btn-outline-info btn-sm">Kembali ke list Nota Penjualan</a>
    </div>
    <div class="container-fluid">
        @include('layouts.feedback')
        <div class="row">
            <div class="col-12">
                <form action="{{ @$sale ? route('sales-toko.update', $sale) : route('sales-toko.store') }}"
                    method="POST">
                    @csrf
                    {{ @$sale ? method_field('PUT') : '' }}
                    <div class="row">
                        <div class="col-8">
                            @if (@!$sale)
                            <div class="form-group row">
                                <label for="search" class="col-sm-3 col-form-label">Cari Kode Produk:</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" name="search" id="search">
                                        <option value="0" selected disabled>- Pilih Produk -</option>
                                        @foreach ($stocks as $stock)
                                        <option value="{{ $stock->id }}">
                                            {{ $stock->product->code }} {{ $stock->product->name }} --
                                            {{ $stock->color }} -- {{ $stock->size }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                            <div class="tb-card tb-style1">
                                <div class="tb-data-table tb-lock-table tb-style1">
                                    <table class="table stripe row-border order-column no-footer table-hover"
                                        aria-describedby="tb-no-locked_info" id="table">
                                        <thead>
                                            <tr>
                                                <th class="sorting_asc" tabindex="0" aria-controls="tb-no-locked"
                                                    aria-label="Nama: activate to sort column descending"
                                                    style="width: 30%">Produk</th>
                                                <th class="sorting" tabindex="0" aria-controls="tb-no-locked"
                                                    aria-label="Kategori: activate to sort column ascending"
                                                    style="width: 10%">Qty (pcs)
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="tb-no-locked"
                                                    aria-label="Harga: activate to sort column ascending"
                                                    style="width: 25%">Harga (Rp)
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="tb-no-locked"
                                                    aria-label="Total: activate to sort column ascending"
                                                    style="width: 25%">Total (Rp)
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="tb-no-locked"
                                                    aria-label="Action: activate to sort column ascending"
                                                    style="width: 10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            @if (@$sale)
                                            @foreach ($sale->details as $key => $detail)
                                            <tr id="item-id-{{ $detail->id }}">
                                                <td style="width: 30%">
                                                    <b>{{ $detail->stock->product->code }}</b> <br>
                                                    {{ $detail->stock->product->name }} <br>
                                                    {{ $detail->stock->color }} - {{ $detail->stock->size }}
                                                    <input type="hidden" name="item[{{ $key }}][id]"
                                                        value="{{ $detail->id }}">
                                                </td>
                                                <td style="width: 10%">
                                                    <input type="number" class="form-control" id="qty-{{ $detail->id }}"
                                                        value="{{ $detail->qty }}" name="item[{{ $key }}][qty]"
                                                        oninput="countSubtotal({{ $detail->id }})">
                                                </td>
                                                <td style="width: 25%">
                                                    <input type="number" class="form-control"
                                                        id="price-{{ $detail->id }}"
                                                        value="{{ $detail->stock->product->price }}"
                                                        name="item[{{ $key }}][price]"
                                                        oninput="countSubtotal({{ $detail->id }})">
                                                </td>
                                                <td style="width: 25%">
                                                    <input type="number" class="form-control subtotal"
                                                        id="subtotal-{{ $detail->id }}" value="{{ $detail->subtotal }}"
                                                        name="item[{{ $key }}][subtotal]" readonly>
                                                </td>
                                                <td style="width: 10%">
                                                    {{-- <input type="number" class="form-control" 
                                                        id="qty-{{ $detail->id }}"
                                                    value="{{ $detail->qty }}"
                                                    name="item[{{ $key }}][qty]"
                                                    oninput="countSubtotal({{ $detail->id }})"> --}}
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="customers">Customer</label>
                                <select class="form-control select2" name="customer_id" id="customers" readonly>
                                    <option value="1" selected>Beli di Toko</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="discount">Diskon (%)</label>
                                <input type="number" class="form-control" id="discount" name="discount"
                                    value="{{ @$sale ? $sale->discount : 0 }}" oninput="countTotal()">
                            </div>
                            <div class="form-row">
                                <div class="col-2">
                                    <h5>Total:</h5>
                                </div>
                                <div class="col-10">
                                    <h5 class="float-right">Rp
                                        <span id="grand-total-span">
                                            {{ @$sale ? number_format($sale->total, 0, ',', '.') : '-' }}
                                        </span>
                                    </h5>
                                    <input type="hidden" id="grand-total-input" name="total">
                                </div>
                            </div>
                            <input type="hidden" value="{{ @$sale ? $sale->purchase_no : $no_so }}" name="purchase_no">
                            <button type="submit" id="btnPay" class="btn btn-info btn-block">Simpan</button>
                            @if (@$sale)
                            @if ($sale->status == 'FINISH')
                            {{-- <a href="#" class="btn btn-block btn-success"><i class="fa fa-check"></i> Pembelian Ini
                                FINISH</a> --}}
                                Pembelian ini FINISH
                            @else
                            <a href="#" class="btn btn-block btn-success">Cetak Nota Penjualan</a>
                            @endif
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
