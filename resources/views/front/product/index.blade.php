@extends('front.layouts.app')

@section('title')
    {{ @$category ?: @$term }}
@endsection

@section('content')
    <section class="bg-white py-8">
        <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 hover:text-gray-600 text-2xl " href="#">
                        @if (@$find)
                        {{-- {{ ucwords(str_replace('-', ' ', $category))--}}
                            {{ 'Cari produk ' . @$term  }}
                        @else
                            {{-- Hasil pencarian "{{ $term }} tidak ditemukan" --}}
                            {{ ucwords(str_replace('-', ' ', @$category)) }}
                        @endif
                    </a>
                    <div class="flex items-center" id="store-nav-content">
                        <form class="w-full max-w-sm" action="{{ url('find') }}" method="GET">
                            <div class="flex items-center border-b border-gray-800 py-2">
                                <input name="q" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Cari kode / nama produk" aria-label="Full name">
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

            @forelse ($products as $product)
                <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col ">
                    <a href="{{ url('detail/'.$product->slug ) }}" class="hover:no-underline">
                        <img class="hover:grow hover:shadow-lg" src="{{ asset($product->image) }}">
                        <div class="pt-3 flex items-center justify-between text-gray-800">
                            <p class="">{{ $product->code }} - {{ $product->name }}</p>
                        </div>
                        <p class="pt-1 text-gray-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </a>
                </div>
            @empty
                <div class="w-full text-center py-6 text-gray-500">
                    @if (@!$find)
                        {{-- {{ ucwords(str_replace('-', ' ', $category))--}}
                        Tidak ada produk untuk kategori "{{ $category }}"
                    @else
                        Hasil pencarian "{{ $term }}" tidak ditemukan
                    @endif
                </div>
            @endforelse
        </div>
    </section>
@endsection