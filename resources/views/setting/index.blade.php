@extends('layouts.admint')

@section('content')
<div class="tb-content tb-style1">
    <div class="tb-padd-lr-30 tb-uikits-heading mb-3 mt-2">
        <h2 class="tb-uikits-title">Settings</h2>
    </div>
    <div class="container-fluid">
        @include('layouts.feedback')
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="{{ route('setting.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="target_revenue">Target Revenue</label>
                        <input type="number" required min="1000" class="form-control col-6" id="target_revenue" name="target_revenue" placeholder="Target Revenue" autofocus value="{{ $settings['target_revenue']->value }}">
                    </div>
                    <div class="form-group">
                        <label for="target_products_sold">Target Products Sold</label>
                        <input type="number" required min="10" class="form-control col-6" id="target_products_sold" name="target_products_sold" placeholder="Kode produk" autofocus value="{{ $settings['target_products_sold']->value }}">
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
