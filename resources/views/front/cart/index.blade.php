@extends('front.layouts.app')

@section('title')
Cart
@endsection

@section('content')
<section class="bg-white py-8">
    <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
        <nav id="store" class="w-full z-30 top-0 px-6 py-1">
            <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
                <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 hover:text-gray-600 text-2xl " href="#">
                    Shopping Cart
                </a>
                <div>
                    @if(!$products->isEmpty())
                        <a href="{{ url('cart/empty') }}" class="mt-4 md:md-0 hover:no-underline float-right inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-900 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Hapus Semua
                        </a>
                    @endif
                </div>
            </div>
        </nav>
    </div>

    <div class="container mx-auto px-10 py-1">
        @if(!$products->isEmpty())
            <div class="grid grid-cols-3 gap-4 w-full px-2">
                <div class="md:col-span-2 col-span-3">
                    @foreach($products as $product)
                        <div class="grid grid-cols-3 gap-4 w-full mb-6 border rounded">
                            <div class="col-span-3 md:col-span-1">
                                <img class="object-fill" src="{{ asset($product->model->product->image) }}">
                            </div>
                            <div class="relative col-span-3 md:col-span-2 md:py-3 md:px-0 px-3">
                                <p class="text-xl text-black">
                                    {{ $product->name }}
                                </p>
                                <p class="">
                                    {{ $product->model->color }} - {{ $product->model->size }}
                                </p>
                                <p class="">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>

                                <div class="md:absolute md:bottom-0 flex flex-col md:items-center md:justify-between md:flex-row md:py-2 pr-4 w-full">
                                    <div class="flex flex-wrap items-center my-3 md:mt-0">
                                        <div>
                                            Qty : &nbsp;
                                        </div>
                                        <form action="{{ route('cart.update', $product->rowId) }}" method="POST" class="flex flex-wrap">
                                            @csrf
                                            @method('PUT')
                                            <input id="qty" name="qty" value="{{ $product->qty }}" class="bg-gray-100 focus:outline-none focus:shadow-outline border-t border-l border-b w-1/3 border-gray-300 rounded-l-lg py-2 px-4 block appearance-none leading-none" type="number">
                                            <button type="submit" class="p-2 text-gray-600 border border-gray-300 rounded-r-lg">
                                                Update
                                            </button>
                                        </form>
                                    </div>
                                    <div class="my-3 md:mt-0 md:mx-2">
                                        <form method="POST" action="{{ route('cart.destroy', $product->rowId) }}">
                                            @csrf
                                            @method('DELETE')
                                            <a class="text-red-600 hover:text-red-800 hover:underline" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                Hapus
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div>9</div>
            </div>

            {{-- <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nama</th>
                        <th>Warna</th>
                        <th>Size</th>
                        <th>Jumlah</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
@foreach($products as $product)
                        <tr>
                            <td class="w-40"><img class="object-fill" src="{{ asset($product->model->product->image) }}"></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->model->color }}</td>
            <td>{{ $product->model->size }}</td>
            <td>{{ $product->qty }} pcs</td>
            <td class="text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            <td class="text-right">Rp {{ $product->subtotal() }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">
                    <div class="text-right font-bold">
                        Ongkos Kirim :
                    </div>
                </td>
                <td>
                    <div class="text-right">
                        Rp 10.000
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <div class="text-right font-bold">
                        Total :
                    </div>
                </td>
                <td>
                    <div class="text-right">
                        Rp {{ number_format(str_replace('.', '', Cart::total()) + 10000, 0, ',', '.') }}
                    </div>
                </td>
            </tr>
        </tfoot>
        </table> --}}

        {{-- <div class="text-right py-4 text-black">
                <span class="text-right font-bold">
                    Pembayaran :
                </span>
                Bank Transfer (BCA 12121212 a/n John Doe)
            </div> --}}

        {{-- <form action="{{ url('checkout') }}" method="POST">
        @csrf
        <button type="submit" class="hover:no-underline float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
            Checkout
        </button>
        </form> --}}
    @else
        <div class="text-center text-xl text-gray-800">Keranjang Belanja kosong.</div>
        @endif
    </div>
</section>
@endsection
