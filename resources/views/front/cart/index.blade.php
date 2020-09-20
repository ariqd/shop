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
                </div>
            </nav>
        </div>

        <div class="container mx-auto px-10 py-1">
            <table class="table">
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        {{-- <td>{{ $product->id }}</td> --}}
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->qty }} pcs</td>
                        <td>{{ $product->price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="">
                Checkout
            </a>
        </div>
    </section>
@endsection