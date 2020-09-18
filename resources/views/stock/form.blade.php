@extends('layouts.admint')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });

    </script>
@endpush

@section('content')
<div class="tb-content tb-style1">
    <div class="tb-padd-lr-30 tb-uikits-heading mb-3 mt-2">
        <h2 class="tb-uikits-title">
            {{ @$stock ? 'Edit Stok: ' . $stock->product->code . ' - ' . @$stock->product->name .' '. $stock->color : 'Tambah Stok' }} </h2>
        <a href="{{ url('stocks') }}" class="btn btn-danger btn-sm">Kembali</a>
    </div>
    <div class="container-fluid">
        @include('layouts.feedback')
        <div class="row">
            <div class="col-12">
                <form action="{{ @$stock ? route('stocks.update', $stock) : route('stocks.store') }}" method="POST">
                    @csrf
                    {{ @$stock ? method_field('PUT') : '' }}
                    <div class="form-group">
                        <label for="products">Produk</label>
                        @if(@$stock)
                            <br>
                            <h5>{{ @$stock->product->code }} | {{ @$stock->product->name }}</h5>
                            <input type="hidden" name="product_id" value="{{ @$stock->product_id }}">
                        @else
                            <select class="form-control select2" name="product_id" id="products" {{ @$stock ? 'disabled' : '' }}>
                                <option value="" selected disabled>- Pilih Produk -</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ @$stock->product_id == $product->id ? 'selected' : '' }}>
                                        {{ $product->code }} - {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="sizes">Size</label>
                        @if(@$stock)
                            <br>
                            <h5>{{ @$stock->size }}</h5>
                            <input type="hidden" name="size" value="{{ @$stock->size }}">
                        @else
                            <select class="form-control select2" name="size" id="sizes">
                                <option value="" selected disabled>- Pilih Size -</option>
                                @foreach($sizes as $size)
                                    <option value="{{ $size }}" {{ @$stock->size == $size ? 'selected' : '' }}>
                                        {{ $size }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="color">Warna</label>
                        @if(@$stock)
                            <br>
                            <h5>{{ @$stock->color }}</h5>
                            <input type="hidden" name="color" value="{{ @$stock->color }}">
                        @else
                            <select class="form-control select2" name="color" id="color">
                                <option value="" selected disabled>- Pilih Warna -</option>
                                @foreach($colors as $color)
                                    <option value="{{ $color }}" {{ @$stock->color == $color ? 'selected' : '' }}>
                                        {{ $color }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="qty">Jumlah</label>
                        <input type="number" class="form-control col-3" id="qty" name="qty" placeholder="Jumlah produk" autofocus value="{{ @$stock ? $stock->qty : '' }}" min="1">
                    </div>
                    @if(@$stock)
                        <div class="form-group">
                            <label for="qty_hold">Hold Qty</label>
                            <input type="number" class="form-control col-3" id="qty_hold" name="qty_hold" placeholder="Jumlah produk" autofocus value="{{ @$stock ? $stock->qty_hold : '' }}" min="0">
                        </div>
                    @endif
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
