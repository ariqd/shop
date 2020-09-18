<div class="row">
    <div class="col-6">
        <div class="d-flex">
            <p>
                <a href="{{ url('/?m='.request()->get('m').'&y='.request()->get('y')) }}" class="{{ request()->get('chart') == '' ? 'active' : '' }}">Total Revenue</a>
            </p>
            <p class="ml-3">
                <a href="{{ url('/?chart=jumlah-transaksi&m='.request()->get('m').'&y='.request()->get('y')) }}" class="{{ request()->get('chart') == 'jumlah-transaksi' ? 'active' : '' }}">Jumlah Transaksi Finish</a>
            </p>
        </div>
    </div>
    <div class="col-6">
        <div class="d-flex justify-content-end">
            <p>
                <a href="{{ url('/?chart=jumlah-transaksi&m='.$month_today.'&y='.$year_today) }}" class="{{ request()->get('period') == '' ? 'active' : '' }}">Per Hari</a>
                {{-- <a href="{{ url('/?m='.request()->get('m').'&y='.request()->get('y')) }}" class="{{ request()->get('period') == '' ? 'active' : '' }}">Per Hari</a> --}}
            </p>
            <p class="ml-3">
                <a href="{{ url('/?chart=jumlah-transaksi&period=monthly&m='.$month_today.'&y='.$year_today.'&m_from='.$month_from.'&y_from='.$year_from) }}" class="{{ request()->get('period') == 'monthly' ? 'active' : '' }}">Per Bulan</a>
                {{-- <a href="{{ url('/?chart=jumlah-transaksi&period=monthly&m='.request()->get('m').'&y='.request()->get('y')) }}" class="{{ request()->get('period') == 'monthly' ? 'active' : '' }}">Per Bulan</a> --}}
            </p>
        </div>
    </div>
</div>

<hr>

@if(request()->has('m_from'))
    <div class="row pt-2">
        <div class="col">
            <form class="form-inline" method="GET">
                <label class="my-1 mr-2" for="m">Dari Periode:</label>

                <input type="hidden" name="chart" value="jumlah-transaksi">
                <input type="hidden" name="period" value="monthly">
                <input type="hidden" name="m" value="{{ $month_today }}">
                <input type="hidden" name="y" value="{{ $year_today }}">

                <select class="custom-select my-1 mr-sm-2" id="m" name="m_from">
                    @foreach($months as $month)
                        <option value="{{ $loop->iteration }}" {{ $loop->iteration == $month_from ? 'selected' : '' }}>
                            {{ $month }}
                        </option>
                    @endforeach
                </select>

                <select class="custom-select my-1 mr-sm-2" id="y" name="y_from">
                    @for($year = date('Y'); $year >= 2019; $year--)
                        <option value="{{ $year }}" {{ $year == $year_from ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                </select>

                <button type="submit" class="btn btn-info btn-sm my-1">Cari</button>

                <span class="ml-2">hingga {{ $months[$month_today] }} {{ $year_today }}</span>

                @if(sizeof($period) <= 1)
                    <span class="text-danger ml-3">*Periode awal harus lebih kecil dari periode akhir</span>
                @endif
            </form>
        </div>
    </div>
@endif

<div class="w-100">
    {!! $data['transactionsChart']->container() !!}
</div>
