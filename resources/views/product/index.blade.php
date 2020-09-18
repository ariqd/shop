@extends('layouts.admint')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/datatables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.5.7/dist/cleave.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> --}}
    <script src="{{ asset('assets') }}/js/datatables.min.js"></script>
    <script>
        var cleave = new Cleave('.input-number', {
            numeral: true,
            delimiter: '.',
            numeralDecimalMark: ',',
            numeralThousandsGroupStyle: 'thousand',
            prefix: 'Rp',
        });

        $(document).ready(function () {
            $('.select2').select2();

            // $('.btnDelete').on('click', function (e) {
            //     e.preventDefault();
            //     var parent = $(this).parent();

            //     Swal.fire({
            //             title: "Apa anda yakin?",
            //             text: "Data akan terhapus secara permanen!",
            //             icon: "warning",
            //             buttons: true,
            //             dangerMode: true,
            //         })
            //         .then(function (willDelete) {
            //             if (willDelete) {
            //                 parent.find('.formDelete').submit();
            //             }
            //         });
            // });
        });

    </script>
@endpush

@section('content')
<div class="tb-content tb-style1">
    <div class="tb-padd-lr-30 tb-uikits-heading mb-3 mt-2">
        <h1 class="tb-uikits-title">Produk</h1>
        {{-- @if(Auth::user()->role == 'owner') --}}
        {{-- <a href="{{ url('products/create') }}" class="btn btn-success btn-sm">Tambah</a> --}}
        {{-- @endif --}}
    </div>
    <div class="container-fluid">
        @include('layouts.feedback')
        <div class="row">
            @if(auth()->user()->role == 'owner')
                <div class="col-3">
                    <form action="{{ @$product ? route('products.update', $product) : route('products.store') }}" method="POST">
                        @csrf
                        {{ @$product ? method_field('PUT') : '' }}
                        <p class="font-weight-bold">{{ @$product ? 'Edit' : 'Tambah' }} Produk</p>
                        <div class="form-group">
                            <label for="code">Kode Produk</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Kode produk" autofocus value="{{ @$product ? $product->code : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama produk" autofocus value="{{ @$product ? $product->name : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="price">Harga Produk</label>
                            <input type="text" class="form-control input-number col-7" id="price" name="price" placeholder="Harga produk" autofocus value="{{ @$product ? $product->price : '' }}" min="1">
                            <small class="text-muted">Minimum Rp100</small>
                        </div>
                        <div class="form-group">
                            <label for="categories">Kategori</label> <br>
                            <select class="form-control select2" name="category" id="categories">
                                <option value="" selected disabled>- Pilih Kategori -</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ @$product->category == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">
                            {{ @$product ? 'Edit' : 'Tambah' }} Produk
                        </button>
                        @if(@$product)
                            <a href="{{ url('products') }}" class="float-right btn">Clear</a>
                        @endif
                    </form>
                </div>
            @endif
            <div class="col-9">
                <div class="tb-card tb-style1">
                    <div class="tb-card-heading"></div>
                    <div class="tb-data-table tb-lock-table tb-style1">
                        <table id="tb-no-locked" class="table row-border order-column dataTable no-footer table-hover" role="grid" aria-describedby="tb-no-locked_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="tb-no-locked" aria-label="No: activate to sort column descending">No</th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="tb-no-locked" aria-label="Nama: activate to sort column descending">Nama</th>
                                    <th class="sorting" tabindex="0" aria-controls="tb-no-locked" aria-label="Harga: activate to sort column ascending">Harga</th>
                                    <th class="sorting" tabindex="0" aria-controls="tb-no-locked" aria-label="Kategori: activate to sort column ascending">Kategori</th>
                                    {{-- <th class="sorting" tabindex="0" aria-controls="tb-no-locked" aria-label="Tanggal: activate to sort column ascending">Tanggal Dibuat</th> --}}
                                    @if(Auth::user()->role == 'owner')
                                        <th class="sorting" tabindex="0" aria-controls="tb-no-locked" aria-label="Action: activate to sort column ascending">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr role="row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->code }} - {{ $product->name }}</td>
                                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td>{{ $product->category }}</td>
                                        @if(Auth::user()->role == 'owner')
                                            <td>
                                                <a href="{{ url('products/'.$product->id) }}" class="text-primary mr-3">Stok</a>
                                                <a href="{{ url('products?product_id='.$product->id) }}" class="text-info mr-3">Edit</a>
                                                {{-- <a href="#" class="text-danger btnDelete">
                                            Hapus
                                        </a>
                                        <form action="{{ route('products.destroy', $product) }}" method="post"
                                                class="formDelete d-none">
                                                {!! csrf_field() !!}
                                                {!! method_field('delete') !!}
                                                </form> --}}
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
