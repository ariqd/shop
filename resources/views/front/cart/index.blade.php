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

    <div class="container mx-auto px-8 pb-12">
        @if(!$products->isEmpty())
            <div class="grid grid-cols-3 gap-4 w-full md:px-2">
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
                                    Rp {{ $product->subtotal() }}
                                    <span class="subtotal hidden">{{ $product->subtotal() * 1000 }}</span>
                                </p>

                                <div class="md:absolute md:bottom-0 flex flex-col md:items-center md:justify-between md:flex-row md:py-2 pr-4 w-full">
                                    <div class="flex flex-wrap items-center my-3 md:mt-0">
                                        <div>
                                            Qty : &nbsp;
                                        </div>
                                        <form action="{{ route('front.cart.update', $product->rowId) }}" method="POST" class="flex flex-wrap">
                                            @csrf
                                            @method('PUT')
                                            <input id="qty" name="qty" value="{{ $product->qty }}" class="bg-gray-100 focus:outline-none focus:shadow-outline border-t border-l border-b w-1/3 border-gray-300 rounded-l-lg py-2 px-4 block appearance-none leading-none" type="number">
                                            <button type="submit" class="p-2 text-gray-600 border border-gray-300 rounded-r-lg">
                                                Update
                                            </button>
                                        </form>
                                    </div>
                                    <div class="my-3 md:mt-0 md:mx-2">
                                        <form method="POST" action="{{ route('front.cart.destroy', $product->rowId) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="md:col-span-1 col-span-3">
                    <div class="text-xl text-black mb-2">
                        Pengiriman
                    </div>
                    @if(!auth()->user()->customer->province_id)
                        <div class="py-2">
                            Anda belum memiliki alamat pengiriman.
                        </div>
                        <a href="{{ route('front.address.index') }}" class="w-full justify-center hover:no-underline float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Tambah alamat pengiriman
                        </a>
                    @else
                        <form action="{{ url('checkout') }}" method="POST">
                            @csrf

                            <input type="hidden" id="destination" name="destination" value="{{ Auth::user()->customer->city_id }}">

                            <div class="mb-2">
                                <div class="text-black">
                                    Alamat
                                </div>
                                <div>
                                    {{ Auth::user()->customer->address }}
                                </div>
                                <div>
                                    {{ Auth::user()->customer->city_name }}, {{ Auth::user()->customer->province_name }}
                                </div>
                                <div>
                                    <a class="text-gray-700 hover:text-gray-900 underline" href="{{ route('front.address.index') }}">
                                        Ganti
                                    </a>
                                </div>
                            </div>

                            <div class="pt-1 mb-2">
                                <div class="text-black">
                                    <label for="courier">
                                        Kurir
                                    </label>
                                </div>
                                <div>
                                    <div class="inline-block relative w-full">
                                        <select required name="courier_name" id="couriers" class="block appearance-none w-full bg-gray-100 border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none">
                                            <option value="" selected disabled>-- Pilih Kurir --</option>
                                            @foreach($couriers as $key => $courier)
                                                <option value="{{ $key }}">
                                                    {{ $courier }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-1 mb-2">
                                <div class="text-black">
                                    <label for="courier">
                                        Layanan
                                    </label>
                                </div>
                                <div>
                                    <div class="inline-block relative w-full">
                                        <select required name="courier_fee" id="services" class="block appearance-none w-full bg-gray-100 border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none">
                                            <option value="" selected disabled>-- Pilih Kurir terlebih dahulu --</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                                        </div>
                                    </div>
                                    <input type="hidden" name="courier_service_name" id="courier_service_name">
                                </div>
                            </div>

                            <div class="pt-1 mb-2">
                                <div class="text-black">
                                    <label for="courier">
                                        Ongkos Kirim
                                    </label>
                                </div>
                                <div>
                                    <div class="text-xl">
                                        Rp <span id="courier_fee-text">-</span>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-1 mb-2">
                                <div class="text-black">
                                    <label for="courier">
                                        Total
                                    </label>
                                </div>
                                <div>
                                    <div class="text-xl">
                                        <input type="text" class="hidden" id="total" name="subtotal" value="{{ str_replace('.', '', Cart::total()) }}">
                                        Rp <span id="grand-total-span">-</span>
                                        <input type="text" class="hidden" id="grand-total-input">
                                    </div>
                                </div>
                            </div>

                            <div class="pt-1 mb-4">
                                <div class="text-black">
                                    <label for="courier">
                                        Metode Pembayaran
                                    </label>
                                </div>
                                <div>
                                    <div class="text-xl">
                                        Bank Transfer
                                        {{-- Rp <span id="courier_fee-text">-</span> --}}
                                    </div>
                                    <div class="text-sm">
                                        Transfer ke BCA 12121212 a/n John Doe <strong>Setelah Checkout</strong>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="w-full justify-center hover:no-underline float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Checkout
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @else
            <div class="text-center text-xl text-gray-800">Keranjang Belanja kosong.</div>
        @endif
    </div>
</section>
@endsection

@push('js')
    <script src="{{ asset('assets') }}/js/vendor/jquery-1.12.4.min.js"></script>

    <script>
        $('#couriers').change(function () {
            calculateCost();
        });

        $('#services').change(function () {
            var ongkir = $(this).val();
            $('#courier_service_name').val($('#services option:selected').text());
            $('#courier_fee-text').html(number_format(ongkir, '.', ',', 0));
            countTotal(ongkir);
        });

        function calculateCost() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#services').empty();

            $.ajax({
                url: "{!! url('cart/cost') !!}",
                method: "post",
                data: {
                    _token: CSRF_TOKEN,
                    courier: $('#couriers').val(),
                    weight: 1,
                    destination: $('#destination').val(),
                },
                beforeSend: function () {
                    $('.loading').show();
                    $('#services').append($("<option></option>")
                            .attr("value", null)
                            .attr("disabled", true)
                            .attr("selected", true)
                            .text('-- Pilih layanan --'));

                },
                success: function (response) {
                    $('.loading').hide();

                    var costs = response.rajaongkir.results[0].costs;

                    $('#services').prop('disabled', false);

                    $.map(costs, function (item) {
                        $('#services').append($("<option></option>")
                            .attr("value", item.cost[0].value)
                            .text(item.service));
                    })
                },
                error: function (xhr) {
                    $('#ajax-errors').html('');
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        $('#ajax-errors').append('<div class="alert alert-danger">' + value + '</div');
                    });
                },
            });
        }

        function countTotal(ongkir) {
            var total = parseFloat($("#total").val() || 0);
            var ongkirFloat = parseFloat(ongkir)
            var grand_total = total + ongkirFloat

            $("#grand-total-span").text(number_format(grand_total, '.', ',', 0));
            $("#grand-total-input").val(grand_total);
        }

        function number_format(number, thousandsSep, decPoint, decimals) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number;
            var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals);
            var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep;
            var dec = (typeof decPoint === 'undefined') ? '.' : decPoint;
            var s = '';

            var toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + (Math.round(n * k) / k)
                    .toFixed(prec)
            };

            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0')
            }

            return s.join(dec)
        }

    </script>
@endpush
