@extends('layouts.admint')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });

        $("#provinces").change(function () {
            var id = $("#provinces").val();
            $('.loading').show();
            $.ajax({
                url: "{!! url('customers/search-cities') !!}/" + id,
                type: 'GET',
                contentType: 'application/json; charset=utf-8',
            }).then(function (response) {
                $("#cities").empty().trigger('change');
                $('.loading').hide();
                $("#cities").select2({
                    placeholder: '- Pilih Kota / Kabupaten -',
                    data: $.map(response, function (item) {
                        return {
                            text: item.type + ' ' + item.city_name,
                            id: item.city_id
                        }
                    })
                });
            });
        });

    </script>
@endpush

@section('content')
<div class="tb-content tb-style1 pb-5">
    <div class="tb-padd-lr-30 tb-uikits-heading mb-3 mt-2">
        <h2 class="tb-uikits-title">{{ @$customer ? 'Edit Pembeli: '.$customer->name : 'Tambah Pembeli' }} </h2>
        <div class="text-right">
            <a href="{{ url('customers') }}"><i class="fa fa-times"></i> Kembali</a>
        </div>
    </div>
    <div class="container-fluid">
        @include('layouts.feedback')
        <div class="row">
            <div class="col-12">
                <form action="{{ @$customer ? route('customers.update', $customer) : route('customers.store') }}" method="POST">
                    @csrf
                    {{ @$customer ? method_field('PUT') : '' }}
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama pembeli" autofocus value="{{ @$customer ? $customer->name : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Alamat" autofocus value="{{ @$customer ? $customer->address : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="provinces">Provinsi</label>
                        <select class="form-control select2" name="province_id" id="provinces">
                            <option value="" selected disabled>- Pilih Provinsi -</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->province_id }}" {{ @$customer->province_id == $province->province_id ? 'selected' : '' }}>
                                    {{ $province->province }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cities">Kota</label>
                        <select autocomplete="off" name="city_id" id="cities" class="form-control cities w-100 select2">
                            <option value="" selected disabled></option>
                            @if(@$customer)
                                @foreach($cities as $city)
                                    <option value="{{ $city->city_id }}" {{ @$customer->city_id == $city->city_id ? 'selected' : '' }}>
                                        {{ $city->city_name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">No. Telp</label>
                        <input type="text" class="form-control col-2" id="phone" name="phone" placeholder="No. Telp" autofocus value="{{ @$customer ? $customer->phone : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio6" name="status" class="custom-control-input" value="Distributor" {{ @$customer->status == 'Distributor' ? 'checked' : (!@$customer ? 'checked' : '') }}>
                            <label class="custom-control-label" for="customRadio6">Distributor</label>
                        </div>
                        <div class="tb-height-b5 tb-height-lg-b5"></div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio5" name="status" class="custom-control-input" value="Agen" {{ @$customer->status == 'Agen' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio5">Agen</label>
                        </div>
                        <div class="tb-height-b5 tb-height-lg-b5"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Data Pembeli</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
