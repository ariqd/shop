@extends('front.layouts.app')

@section('title')
Alamat Pengiriman
@endsection

@section('content')
<section class="bg-white py-8">
    <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
        <nav id="store" class="w-full z-30 top-0 px-6 py-1">
            <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
                <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 hover:text-gray-600 text-2xl " href="#">
                    Alamat Pengiriman
                </a>
            </div>
        </nav>
    </div>

    <div class="container mx-auto max-w-7xl px-8 flex justify-center">
        <form class="w-full max-w-xl" action="{{ route('front.address.update', Auth::id()) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="md:flex mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="address">
                        Alamat
                    </label>
                </div>
                <div class="md:w-2/3">
                    <textarea required name="address" rows="5" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="address">{{ auth()->user()->customer->address }}</textarea>
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="province_id">
                        Provinsi
                    </label>
                </div>
                <div class="md:w-2/3 inline-block relative">
                    <select required class="bg-gray-200 py-2 px-4 w-full appearance-none border-2 border-gray-200 rounded text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="province_id" id="provinces">
                        <option value="" selected disabled>- Pilih Provinsi -</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->province_id }}" {{ auth()->user()->customer->province_id == $province->province_id ? 'selected' : '' }}>
                                {{ $province->province }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                    </div>
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="province_id">
                        Kota
                    </label>
                </div>
                <div class="md:w-2/3 inline-block relative">
                    <select required class="bg-gray-200 py-2 px-4 w-full appearance-none border-2 border-gray-200 rounded text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="city_id" id="cities">
                        <option value="" selected disabled>- Pilih Kota -</option>
                        @if(auth()->user()->customer->city_id)
                            @foreach($cities as $city)
                                <option value="{{ $city->city_id }}" {{ auth()->user()->customer->city_id == $city->city_id ? 'selected' : '' }}>
                                    {{ $city->type }} {{ $city->city_name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                    </div>
                </div>
            </div>
            <div class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <button class="shadow bg-gray-800 hover:bg-gray-700 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                        Simpan Alamat
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@push('js')
    <script src="{{ asset('assets') }}/js/vendor/jquery-1.12.4.min.js"></script>
    <script>
        $("#provinces").change(function () {
            var id = $("#provinces").val();
            $('.loading').show();
            $.ajax({
                url: "{!! url('address/search-cities') !!}/" + id,
                type: 'GET',
                contentType: 'application/json; charset=utf-8',
            }).then(function (response) {
                $("#cities").empty().trigger('change');
                $('.loading').hide();
                $.map(response, function (item) {
                    $('#cities').append($("<option></option>")
                        .attr("value", item.city_id)
                        .text(item.type + ' ' + item.city_name));
                })
            });
        });
    </script>
@endpush
