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
    <div class="tb-padd-lr-30 tb-uikits-heading mb-3 mt-2">
        <h2 class="tb-uikits-title">Pembeli</h2>
        @if (Auth::user()->role == 'owner')
        <a href="{{ url('customers/create') }}" class="btn btn-success btn-sm">Tambah</a>
        @endif
    </div>
    <div class="container-fluid">
        @include('layouts.feedback')
        <div class="row">
            <div class="col-12">
                <div class="tb-card tb-style1">
                    <div class="tb-card-heading"></div>
                    <div class="tb-data-table tb-lock-table tb-style1">
                        <table id="tb-no-locked" class="table row-border order-column dataTable no-footer table-hover"
                            role="grid" aria-describedby="tb-no-locked_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="tb-no-locked"
                                        aria-label="No: activate to sort column descending">No</th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="tb-no-locked"
                                        aria-label="Nama: activate to sort column descending">Nama</th>
                                    <th class="sorting" tabindex="0" aria-controls="tb-no-locked"
                                        aria-label="Alamat: activate to sort column ascending">Alamat</th>
                                    <th class="sorting" tabindex="0" aria-controls="tb-no-locked"
                                        aria-label="No. Telp: activate to sort column ascending">No. Telp</th>
                                    <th class="sorting" tabindex="0" aria-controls="tb-no-locked"
                                        aria-label="Status: activate to sort column ascending">Status</th>
                                    @if (Auth::user()->role == 'owner')
                                    <th class="sorting" tabindex="0" aria-controls="tb-no-locked"
                                        aria-label="Action: activate to sort column ascending">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                <tr role="row">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->address }}, {{ $customer->city_name }},
                                        {{ $customer->province_name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->status }}</td>
                                    @if (Auth::user()->role == 'owner')
                                    <td>
                                        <a href="{{ route('customers.edit', $customer) }}"
                                            class="text-info mr-3">Edit</a>
                                        {{-- <a href="#" class="text-danger btnDelete">
                                            Hapus
                                        </a>
                                        <form action="{{ route('customers.destroy', $customer) }}" method="post"
                                            class="formDelete d-none">
                                            {!! csrf_field() !!}
                                            {!! method_field('delete') !!}
                                        </form> --}}
                                    </td>
                                    @endif
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
