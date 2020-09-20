@extends('front.layouts.app')

@section('title')
    Checkout Finished
@endsection

@section('content')
    <section class="bg-white py-8">
        <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 hover:text-gray-600 text-2xl " href="#">
                        Finish
                    </a>
                </div>
            </nav>
        </div>
        <div class="container mx-auto pt-4 pb-12">
            <div class="text-center text-black">
                Pembelian berhasil dicatat! Silahkan transfer ke Rekening BCA a/n JOHN DOE dalam 1x24 jam, atau transaksi akan dibatalkan oleh Admin. 
            </div>
        </div>
    </section>
@endsection