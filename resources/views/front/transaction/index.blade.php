@extends('front.layouts.app')

@section('title')
Daftar Transaksi
@endsection

@section('content')
<section class="bg-white py-8">
    <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
        <nav id="store" class="w-full z-30 top-0 px-6 py-1">
            <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
                <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 hover:text-gray-600 text-2xl " href="#">
                    Daftar Transaksi
                </a>
            </div>
        </nav>
    </div>

    <div class="container mx-auto max-w-7xl md:px-12">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr>
                    <td class="border px-4 py-2">{{ $transaction->purchase_no }}</td>
                    <td class="border px-4 py-2">{{ $transaction->created_at->toDayDateTimeString() }}</td>
                    <td class="border px-4 py-2">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2">
                        @if($transaction->status == 'BELUM LUNAS')
                            <span class="text-red-500">BELUM LUNAS</span>
                        @elseif($transaction->status == 'LUNAS')
                            <span class="text-blue-500">LUNAS</span>
                        @elseif($transaction->status == 'DIKIRIM')
                            <span class="text-orange-500">DIKIRIM</span>
                        @elseif($transaction->status == 'FINISH')
                            <span class="text-green-500">FINISH</span>
                        @elseif($transaction->status == 'CANCEL')
                            <span class="text-gray-500">CANCEL</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection