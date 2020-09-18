@extends('layouts.admint')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/cleave.js@1.5.7/dist/cleave.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2();
    });

    var cleave = new Cleave('.input-number', {
        numeral: true,
        delimiter: '.',
        numeralDecimalMark: ',',
        numeralThousandsGroupStyle: 'thousand',
        prefix: 'Rp',
    });
</script>
@endpush

@section('content')
<div class="tb-content tb-style1">
    <div class="tb-padd-lr-30 tb-uikits-heading mb-3 mt-2">
        <h2 class="tb-uikits-title">{{ @$product ? 'Edit Produk: '.$product->name : 'Tambah Produk' }} </h2>
        <a href="{{ url('products') }}" class="btn btn-danger btn-sm">Kembali</a>
    </div>
    <div class="container-fluid">
        @include('layouts.feedback')
        <div class="row">
            <div class="col-12">
                <form action="{{ @$product ? route('products.update', $product) : route('products.store') }}"
                    method="POST">
                    @csrf
                    {{ @$product ? method_field('PUT') : '' }}
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control col-6" id="name" name="name" placeholder="Nama produk"
                            autofocus value="{{ @$product ? $product->name : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="code">Kode Produk</label>
                        <input type="text" class="form-control col-6" id="code" name="code" placeholder="Kode produk"
                            autofocus value="{{ @$product ? $product->code : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Harga Produk</label>
                        <input type="text" class="form-control input-number col-2" id="price" name="price"
                            placeholder="Harga produk" autofocus value="{{ @$product ? $product->price : '' }}" min="1">
                    </div>
                    <div class="form-group">
                        <label for="categories">Kategori</label> <br>
                        <select class="form-control select2 col-6" name="category" id="categories">
                            <option value="" selected disabled>- Pilih Kategori -</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category }}" {{ @$product->category == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection