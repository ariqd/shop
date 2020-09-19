@extends('front.layouts.app')

@section('title')
    {{ $product->code .' - ' . $product->name }}
@endsection

@section('content')
    <section class="bg-white py-8">
        <div class="container mx-auto flex flex-wrap pt-4 pb-12">
            <div class="md:w-1/2 px-4 py-2">
                <img class="w-full" src="{{ asset($product->image) }}">
            </div>
            <div class="md:w-1/2 px-4 py-2">
                <div class="text-4xl text-black">
                    {{ $product->code .' - ' . $product->name }}
                </div>
                <div class="text-xl text-gray-700">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </div>

                {{-- <div class="table py-4">
                    <div class="table-row-group">
                        <div class="table-row">
                            <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">Warna</div>
                            <div class="table-cell bg-gray-200 text-gray-700 px-4 py-2 text-sm">:</div>
                            <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">
                                Select
                            </div>
                        </div>
                        <div class="table-row">
                            <div class="table-cell bg-gray-200 text-gray-700 px-4 py-2 text-sm">Ukuran</div>
                            <div class="table-cell bg-gray-400 text-gray-700 px-4 py-2 text-sm">:</div>
                            <div class="table-cell bg-gray-200 text-gray-700 px-4 py-2 text-sm">
                                Radio
                            </div>
                        </div>
                    </div>
                  </div> --}}
                
                {{-- <div class="border-t my-4"></div> --}}

                
                <div class="text-gray-700 my-4">
                    {{ $product->description }}
                </div>
            </div>
        </div>
    </section>
@endsection