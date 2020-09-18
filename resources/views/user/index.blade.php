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
        <h2 class="tb-uikits-title">Akun</h2>
        <a href="{{ url('users/create') }}" class="btn btn-success btn-sm">Tambah</a>
    </div>
    <div class="container-fluid">
        @include('layouts.feedback')
        <div class="row">
            <div class="col-12">
                <div class="tb-card tb-style1">
                    <div class="tb-card-heading"></div>
                    <div class="tb-data-table tb-lock-table tb-style1">
                        <table id="tb-no-locked"
                            class="table row-border order-column dataTable no-footer table-hover" role="grid"
                            aria-describedby="tb-no-locked_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="tb-no-locked" rowspan="1"
                                        colspan="1" style="width: 20px;" aria-sort="ascending"
                                        aria-label="No: activate to sort column descending">No</th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="tb-no-locked" rowspan="1"
                                        colspan="1" style="width: 100px;" aria-sort="ascending"
                                        aria-label="Nama: activate to sort column descending">Nama</th>
                                    <th class="sorting" tabindex="0" aria-controls="tb-no-locked" rowspan="1"
                                        colspan="1" style="width: 63px;"
                                        aria-label="Status: activate to sort column ascending">Status</th>
                                    <th class="sorting" tabindex="0" aria-controls="tb-no-locked" rowspan="1"
                                        colspan="1" style="width: 139px;"
                                        aria-label="Email: activate to sort column ascending">E-Mail</th>
                                    <th class="sorting" tabindex="0" aria-controls="tb-no-locked" rowspan="1"
                                        colspan="1" style="width: 83px;"
                                        aria-label="Action: activate to sort column ascending">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr role="row">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $user) }}" class="text-info mr-3">Edit</a>
                                        {{-- <a href="#" class="text-danger btnDelete">
                                            Hapus
                                        </a>
                                        <form action="{{ route('users.destroy', $user) }}" method="post"
                                            class="formDelete d-none">
                                            {!! csrf_field() !!}
                                            {!! method_field('delete') !!}
                                        </form> --}}
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
