@extends('front.layouts.app')

@section('title')
    {{ $product->code .' - ' . $product->name }}
@endsection

@push('js')
    <script>
        document.getElementById('color').addEventListener('change', function(event) {
            if (this.value > 0) {
                document.getElementById('available').classList.remove("hidden");
            } else {
                document.getElementById('available').classList.add("hidden");
            }

            var id = event.target.options[event.target.selectedIndex].dataset.id;
            var color = event.target.options[event.target.selectedIndex].dataset.color;
            var size = event.target.options[event.target.selectedIndex].dataset.size;

            document.getElementById('available').innerHTML = 'Tersedia ' + this.value + ' pcs';
            document.getElementById('stock-id').value = id;
            document.getElementById('stock-color').value = color;
            document.getElementById('stock-size').value = size;
        });
    </script>
@endpush

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

                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id" value="" id="stock-id">
                    <input type="hidden" name="color" value="" id="stock-color">
                    <input type="hidden" name="size" value="" id="stock-size">
                    <input type="hidden" name="name" value="{{ $product->code .' - ' . $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">

                <div class="py-4">
                    <div class="flex items-center py-2 flex-wrap w-full">
                        <div class="w-1/6">
                            <label for="color">Warna</label>
                        </div>
                        <div class="w-5/6 flex items-center flex-col md:flex-row">
                            <div class="inline-block relative ml-2 md:ml-0">
                                <select id="color" class="block appearance-none w-full bg-gray-100 border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none">
                                    <option value="" selected disabled>-- Pilih Warna dan Ukuran --</option>
                                    @foreach ($colors as $key => $sizes)
                                    <optgroup label="{{ $key }}">
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size['qty'] }}" 
                                            data-id="{{ $size['id'] }}"
                                            data-size="{{ $size['size'] }}"
                                            data-color="{{ $size['color'] }}"
                                            >
                                                {{ $size['color'] }} - {{ $size['size'] }}
                                            </option>
                                        @endforeach
                                      </optgroup>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                            <div class="md:pl-2 hidden" id="available"></div>
                        </div>
                    </div>

                    <div class="flex items-center py-2">
                        <div class="w-1/6">
                            <label for="qty">Qty</label>
                        </div>
                        <div class="w-5/6">
                            <input id="qty" name="qty" value="1" class="ml-2 md:ml-0 bg-gray-100 focus:outline-none focus:shadow-outline border border-gray-400 rounded-lg py-2 px-4 block appearance-none leading-tight" type="number">
                        </div>
                    </div>

                        <div class="flex items-center py-2">
                            <div class="w-1/6">
                            </div>
                            <div class="w-5/6">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                
                <div class="text-gray-700 my-4">
                    {{ $product->description }}
                </div>
            </div>
        </div>
    </section>
@endsection