@extends('layouts.admint')

@push('css')
    <style>
        a.active {
            color: #5856d6;
            font-weight: bold;
        }

        .text-atalla {
            color: #5856d6;
            /* font-weight: bold; */
        }

        .hover:hover {
            color: #5856d6;
        }

        #red {
            width: 10px;
            height: 10px;
            -webkit-border-radius: 25px;
            -moz-border-radius: 25px;
            border-radius: 25px;
            background: red;
            display: inline-block;
        }

        #green {
            width: 10px;
            height: 10px;
            -webkit-border-radius: 25px;
            -moz-border-radius: 25px;
            border-radius: 25px;
            background: green;
            display: inline-block;
        }

        #orange {
            width: 10px;
            height: 10px;
            -webkit-border-radius: 25px;
            -moz-border-radius: 25px;
            border-radius: 25px;
            background: orange;
            display: inline-block;
        }

    </style>
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $data['transactionsChart']->script() !!}
    {!! $data['productsBarChart']->script() !!}
    {!! $data['pie']->script() !!}
@endpush

@section('content')
<div class="tb-content tb-style1 pb-5">
    <div class="tb-height-b10 tb-height-lg-b10"></div>
    <div class="container-fluid">
        <div class="form-row">
            <div class="col-lg-12">
                <div class="tb-sectin-heading tb-style1">
                    <div class="tb-sectin-heading-left d-flex">
                        <h2 class="tb-section-title">Dashboard</h2>
                        <div class="ml-3">
                            <div id="green"></div> Mencapai Target
                        </div>
                        <div class="ml-3">
                            <div id="red"></div> Dibawah Target
                        </div>
                    </div>
                    <div class="tb-sectin-heading-center text-center">
                    </div>
                    <div class="tb-sectin-heading-right">
                        <div>
                            <form class="form-inline" method="GET">
                                <label class="my-1 mr-2" for="m">Periode:</label>

                                <select class="custom-select my-1 mr-sm-2" id="m" name="m">
                                    @foreach($months as $month)
                                        <option value="{{ $loop->iteration }}" {{ $loop->iteration == $month_today ? 'selected' : '' }}>
                                            {{ $month }}
                                        </option>
                                    @endforeach
                                </select>

                                <select class="custom-select my-1 mr-sm-2" id="y" name="y">
                                    @for($year = date('Y'); $year >= 2019; $year--)
                                        <option value="{{ $year }}" {{ $year == $year_today ? 'selected' : '' }}>{{ $year }}</option>
                                    @endfor
                                </select>

                                <button type="submit" class="btn btn-info btn-sm my-1">Cari</button>
                                <a href="{{ url('/') }}" class="btn btn-link btn-sm my-1">Reset</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tb-height-b10 tb-height-lg-b10"></div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-lg-3 col-sm-6">
                <div class="tb-card tb-style1 text-center">
                    <a href="" data-toggle="modal" data-target="#transactionsModal" class="tb-card-body hover">
                        <div class="tb-height-b30 tb-height-lg-b30"></div>
                        <div class="tb-iconbox tb-style1">
                            <div class="tb-iconbox-text hover">
                                <div class="tb-iconbox-sub-heading hover pb-2"><strong>Transaksi Finish / Total Transaksi</strong></div>
                                <h4>
                                    <span class="{{ $purchases->where('status', '=', 'FINISH')->count() < $purchases->count() ? 'text-danger' : 'text-success' }}">
                                        {{ $purchases->where('status', '=', 'FINISH')->count() }}
                                    </span>
                                    / <small>{{ $purchases->count() }}</small>
                                </h4>
                                <div class="tb-height-b20 tb-height-lg-b20"></div>
                                <hr />
                            </div>
                        </div>
                    </a>
                </div>
                <div class="modal fade" id="transactionsModal" tabindex="-1" role="dialog" aria-labelledby="transactionsModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="transactionsModalLabel">
                                    Grafik Status Transaksi
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="min-height:300px">
                                {!! $data['pie']->container() !!}
                            </div>
                            <div class="modal-footer">
                                <a href="{{ url('sales?m='.date('m').'&y='.date('Y')) }}" class="btn btn-primary">Lihat Semua Transaksi</a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .col -->
            <div class="col-lg-3 col-sm-6">
                <div class="tb-card tb-style1 text-center">
                    <div class="tb-card-body">
                        <div class="tb-height-b30 tb-height-lg-b30"></div>
                        <div class="tb-iconbox tb-style1">
                            <div class="tb-iconbox-text">
                                <div class="tb-iconbox-sub-heading pb-2">
                                    <strong>Revenue</strong> / Target
                                </div>
                                <h5>
                                    <span class="{{ $purchases->where('status', '!=', 'BELUM LUNAS')->sum('total') <= $setting['target_revenue']->value ? 'text-danger' : 'text-success' }}">
                                        Rp {{ number_format($purchases->where('status', '!=', 'BELUM LUNAS')->sum('total'), 0, ',', '.') }}
                                    </span> / Rp {{ number_format($setting['target_revenue']->value, 0, ',', '.') }}
                                </h5>
                                <div class="tb-height-b25 tb-height-lg-b25"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .col -->
            <div class="col-lg-3 col-sm-6">
                <div class="tb-card tb-style1 text-center">
                    <div class="tb-card-body">
                        <div class="tb-height-b30 tb-height-lg-b30"></div>
                        <div class="tb-iconbox tb-style1">
                            <div class="tb-iconbox-text">
                                <div class="tb-iconbox-sub-heading pb-2">
                                    <strong>Produk Terjual</strong> / Target
                                </div>
                                <h4>
                                    <span class="{{ $data['products_sold'] <= $setting['target_products_sold']->value ? 'text-danger' : 'text-success' }}">
                                        {{ $data['products_sold'] }}
                                    </span> / {{ number_format($setting['target_products_sold']->value, 0, ',', '.') }}
                                </h4>
                                <div class="tb-height-b20 tb-height-lg-b20"></div>
                                <hr />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- .col -->
            <div class="col-lg-3 col-sm-6">
                <div class="tb-card tb-style1 text-center">
                    <a class="tb-card-body hover" href="" data-toggle="modal" data-target="#exampleModal">
                        <div class="tb-height-b30 tb-height-lg-b30"></div>
                        <div class="tb-iconbox tb-style1">
                            <div class="tb-iconbox-text">
                                <h4>{{ $restocks->count() }}</h4>
                                <div class="tb-iconbox-sub-heading hover">
                                    <strong>Produk Perlu di-<i>Restock</i></strong>
                                </div>
                                <div class="tb-height-b25 tb-height-lg-b25"></div>
                                <hr />
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Detail Produk Perlu di-<i>Restock</i>
                            </h5>
                            <div class="ml-3">
                                <div id="orange"></div> Stok Qty kurang dari safety
                            </div>
                            <div class="ml-3">
                                <div id="red"></div> Stok Qty kurang dari hold
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Safety</th>
                                    <th>Hold</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($restocks as $restock)
                                    <tr>
                                        <td class="align-middle">
                                            <a href="{{ url('products/'.$restock->product->id) }}">
                                                <span class="text-atalla">{{ $restock->product->code }}</span>
                                            </a>
                                            <br>
                                            {{ $restock->product->name }}
                                            {{ $restock->color }} | {{ $restock->size }}
                                        </td>
                                        <td class="align-middle">
                                            <strong>{{ $restock->qty }} pcs</strong>
                                        </td>
                                        <td class="align-middle {{ $restock->qty <= $restock->safety ? 'text-warning' : '' }}">
                                            <strong>{{ $restock->safety }} pcs</strong>
                                        </td>
                                        <td class="align-middle {{ $restock->qty < $restock->qty_hold ? 'text-danger' : '' }}">
                                            <strong>{{ $restock->qty_hold }} pcs</strong>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-secondary">Tidak ada produk yang harus di-restock</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-row my-2">
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="card-title text-atalla">Produk Terlaris ({{ $months[$month_today] }} {{ $year_today }})</h6>
                            <a href="#" data-toggle="modal" data-target="#bestseller">Lihat Detail</a>
                        </div>
                        <div class="w-100 pt-1">
                            {!! $data['productsBarChart']->container() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if(request()->get('chart') == 'jumlah-transaksi')
                            @include('charts.jumlah-transaksi')
                        @else
                            @include('charts.total-revenue')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bestseller" tabindex="-1" role="dialog" aria-labelledby="bestsellerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bestsellerLabel">Detail Produk Terlaris ({{ $months[$month_today] }} {{ $year_today }})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Pcs Terjual Bulan Ini</th>
                        <th>Action</th>
                        {{-- <th>Hold Qty</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse($bestsellers as $bestseller)
                        <tr>
                            <td class="align-middle">
                                <a href="{{ url('products/'.$bestseller['stock']->product->id) }}">
                                    <span class="text-atalla">{{ $bestseller['stock']->product->code }}</span>
                                </a>
                                <br>
                                {{ $bestseller['stock']->product->name }}
                                {{ $bestseller['stock']->color }} | {{ $bestseller['stock']->size }}
                            </td>
                            <td class="align-middle">
                                <strong>{{ $bestseller['qty'] }} pcs</strong>
                            </td>
                            <td class="align-middle">
                                <a href="{{ url('products/'.$bestseller['stock']->product->id.'?edit='. $bestseller['stock']->color) }}" class="text-atalla">
                                    Edit Safety Stock
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-secondary">Tidak ada produk bestseller</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
