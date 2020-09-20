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
                            <a href="{{ url('cart/empty') }}" class="hover:no-underline float-right inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-900 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Hapus Semua
                            </a>
                        @endif
                    </div>
                </div>
            </nav>
        </div>

        <div class="container mx-auto px-10 py-1">
            @if(!$products->isEmpty())
                <table class="table">
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
                        @foreach ($products as $product)
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
                        {{-- <tr>
                            <td colspan="6">
                                <div class="text-right font-bold">
                                    Pembayaran :
                                </div>
                            </td>
                            <td>
                                <div class="text-right">
                                    Bank Transfer (BCA 12121212 a/n John Doe)
                                </div>
                            </td>
                        </tr> --}}
                    </tfoot>
                </table>
                
                <div class="text-right py-4 text-black">
                    <span class="text-right font-bold">
                        Pembayaran :
                    </span>
                    Bank Transfer (BCA 12121212 a/n John Doe)
                </div>

                <form action="{{ url('checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="hover:no-underline float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        Checkout
                    </button>
                </form>
            @else
                <div class="text-center text-xl text-gray-800">Keranjang Belanja kosong.</div>
            @endif
        </div>
    </section>
@endsection