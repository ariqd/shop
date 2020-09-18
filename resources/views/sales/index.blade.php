@extends('layouts.admint')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/datatables.min.css" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('assets') }}/js/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.btnDelete').on('click', function (e) {
                e.preventDefault();
                var parent = $(this).parent();

                Swal.fire({
                        title: "Apa anda yakin?",
                        text: "Data akan terhapus secara permanen!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then(function (willDelete) {
                        if (willDelete) {
                            parent.find('.formDelete').submit();
                        }
                    });
            });
        });

    </script>
@endpush

@section('content')
<div class="tb-content tb-style1">
    <div class="tb-padd-lr-30 tb-uikits-heading mb-3 justify-content-between">
        <h2 class="tb-uikits-title">Semua Nota Penjualan</h2>
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
                <a href="{{ url('sales?m='.date('m').'&y='.date('Y')) }}" class="btn btn-link btn-sm my-1">Reset</a>
            </form>
        </div>
    </div>
    <div class="container-fluid">
        <div class="form-row mb-3">

            <div class="col-lg-2 col-sm-6">
                <div class="tb-card tb-style1 text-center">
                    <div class="tb-card-body">
                        <div class="tb-height-b30 tb-height-lg-b30"></div>
                        <div class="tb-iconbox tb-style1">
                            <div class="tb-iconbox-text">
                                <h4>{{ $sales->count() }}</h4>
                                <div class="tb-iconbox-sub-heading">Total transaksi</div>
                                <div class="tb-height-b25 tb-height-lg-b25"></div>
                                <hr />
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .col -->

            <div class="col-lg-2 col-sm-6">
                <div class="tb-card tb-style1 text-center">
                    <div class="tb-card-body">
                        <div class="tb-height-b30 tb-height-lg-b30"></div>
                        <div class="tb-iconbox tb-style1">
                            <div class="tb-iconbox-text">
                                <h4>{{ $sales->where('status', 'CANCEL')->count() }}</h4>
                                <div class="tb-iconbox-sub-heading"><span class="tb-badge tb-box-colo7">CANCEL</span></div>
                                <div class="tb-height-b25 tb-height-lg-b25"></div>
                                <hr />
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .col -->

            <div class="col-lg-2 col-sm-6">
                <div class="tb-card tb-style1 text-center">
                    <div class="tb-card-body">
                        <div class="tb-height-b30 tb-height-lg-b30"></div>
                        <div class="tb-iconbox tb-style1">
                            <div class="tb-iconbox-text">
                                <h4>{{ $sales->where('status', 'BELUM LUNAS')->count() }}</h4>
                                <div class="tb-iconbox-sub-heading"><span class="tb-badge tb-box-colo4">BELUM LUNAS</span></div>
                                <div class="tb-height-b25 tb-height-lg-b25"></div>
                                <hr />
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .col -->

            <div class="col-lg-2 col-sm-6">
                <div class="tb-card tb-style1 text-center">
                    <div class="tb-card-body">
                        <div class="tb-height-b30 tb-height-lg-b30"></div>
                        <div class="tb-iconbox tb-style1">
                            <div class="tb-iconbox-text">
                                <h4>{{ $sales->where('status', 'LUNAS')->count() }}</h4>
                                <div class="tb-iconbox-sub-heading">
                                    <span class="tb-badge tb-box-colo3">LUNAS</span>
                                </div>
                                <div class="tb-height-b25 tb-height-lg-b25"></div>
                                <hr />
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .col -->

            <div class="col-lg-2 col-sm-6">
                <div class="tb-card tb-style1 text-center">
                    <div class="tb-card-body">
                        <div class="tb-height-b30 tb-height-lg-b30"></div>
                        <div class="tb-iconbox tb-style1">
                            <div class="tb-iconbox-text">
                                <h4>{{ $sales->where('status', 'DIKIRIM')->count() }}</h4>
                                <div class="tb-iconbox-sub-heading"><span class="tb-badge tb-box-colo2">DIKIRIM</span></div>
                                <div class="tb-height-b25 tb-height-lg-b25"></div>
                                <hr />
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .col -->

            <div class="col-lg-2 col-sm-6">
                <div class="tb-card tb-style1 text-center">
                    <div class="tb-card-body">
                        <div class="tb-height-b30 tb-height-lg-b30"></div>
                        <div class="tb-iconbox tb-style1">
                            <div class="tb-iconbox-text">
                                <h4>{{ $sales->where('status', 'FINISH')->count() }}</h4>
                                <div class="tb-iconbox-sub-heading"><span class="tb-badge tb-box-colo1">FINISH</span></div>
                                <div class="tb-height-b25 tb-height-lg-b25"></div>
                                <hr />
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .col -->

        </div>
        @include('layouts.feedback')
        <div class="row">
            <div class="col-12">
                <div class="tb-card tb-style1">
                    <div class="tb-card-heading"></div>
                    <div class="tb-data-table tb-lock-table tb-style1">
                        <table id="tb-no-locked" class="table row-border order-column dataTable no-footer table-hover" role="grid" aria-describedby="tb-no-locked_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="tb-no-locked" aria-label="No: activate to sort column descending">No</th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="tb-no-locked" aria-label="Tgl Transaksi: activate to sort column descending">
                                        Tgl Transaksi
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="tb-no-locked" aria-label="No. SO: activate to sort column ascending">No. SO</th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="tb-no-locked" aria-label="Customer: activate to sort column descending">Customer</th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="tb-no-locked" aria-label="Tipe: activate to sort column descending">Tipe</th>
                                    <th class="sorting" tabindex="0" aria-controls="tb-no-locked" aria-label="Status: activate to sort column ascending">Status</th>
                                    <th class="sorting" tabindex="0" aria-controls="tb-no-locked" aria-label="Action: activate to sort column ascending">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $sale)
                                    <tr role="row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sale->created_at->toDayDateTimeString() }}</td>
                                        <td>{{ $sale->purchase_no }}</td>
                                        <td>{{ $sale->customer->name }}</td>
                                        <td>
                                            @if($sale->customer_id == 1)
                                                Retail
                                            @else
                                                {{ $sale->customer->status }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($sale->status == 'BELUM LUNAS')
                                                <span class="tb-badge tb-box-colo4">BELUM LUNAS</span>
                                            @elseif($sale->status == 'LUNAS')
                                                <span class="tb-badge tb-box-colo3">LUNAS</span>
                                            @elseif($sale->status == 'DIKIRIM')
                                                <span class="tb-badge tb-box-colo2">DIKIRIM</span>
                                            @elseif($sale->status == 'FINISH')
                                                <span class="tb-badge tb-box-colo1">FINISH</span>
                                            @elseif($sale->status == 'CANCEL')
                                                <span class="tb-badge tb-box-colo7">CANCEL</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($sale->customer_id == 1)
                                                <a href="{{ route('sales-toko.edit', $sale) }}" class="text-info mr-3">
                                                    Detail
                                                </a>
                                            @else
                                                @if($sale->status != 'FINISH')
                                                    <a href="{{ route('sales.edit', $sale) }}" class="text-primary mr-3">
                                                        Edit
                                                    </a>
                                                @else
                                                    <a href="{{ route('sales.edit', $sale) }}" class="text-info mr-3">
                                                        Detail
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
