@extends('front.layouts.app')

@section('title')
    Home
@endsection

@section('content')
    <section class="w-full mx-auto bg-nordic-gray-light flex pt-12 md:pt-0 md:items-center bg-cover bg-right" style="max-width:1600px; height: 32rem; background-image: url('https://images.unsplash.com/photo-1422190441165-ec2956dc9ecc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1600&q=80');">
        <div class="container mx-auto">
            <div class="flex flex-col w-full lg:w-1/2 justify-center items-start px-6 tracking-wide">
                <h1 class="text-black text-2xl my-4">Welcome to Atalla Official Store</h1>
                <a class="text-xl inline-block no-underline hover:no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black" href="#">Browse products</a>
            </div>
        </div>
    </section>

    {{-- <h1 class="text-4xl text-gray-500">Hello</h1> --}}
    <section class="bg-white py-8">
        <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 hover:text-gray-600 text-xl " href="#">
                        Latest
                    </a>
                    <div class="flex items-center" id="store-nav-content">
                        {{-- <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                            <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z" />
                            </svg>
                        </a> --}}
                        <form class="w-full max-w-sm">
                            <div class="flex items-center border-b border-gray-800 py-2">
                                <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Cari kode / nama produk" aria-label="Full name">
                                <button class="flex-shrink-0 border-transparent border-4 text-gray-500 hover:text-gray-800 text-sm py-1 px-2 rounded" type="button">
                                    <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                        <path d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10 c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z" />
                                    </svg>
                                </button>
                                </div>
                          </form>
                    </div>
                </div>
            </nav>

            @foreach ($latestProducts as $product)
                <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col ">
                    <a href="{{ url('detail/'.$product->slug ) }}" class="hover:no-underline">
                        <img class="hover:grow hover:shadow-lg" src="{{ asset($product->image) }}">
                        <div class="pt-3 flex items-center justify-between text-gray-800">
                            <p class="">{{ $product->code }} - {{ $product->name }}</p>
                        </div>
                        <p class="pt-1 text-gray-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endsection