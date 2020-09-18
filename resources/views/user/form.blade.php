@extends('layouts.admint')

@section('content')
<div class="tb-content tb-style1">
    <div class="tb-padd-lr-30 tb-uikits-heading mb-3 mt-2">
        <h2 class="tb-uikits-title">{{ @$user ? 'Edit Akun '.$user->name : 'Tambah Akun' }} </h2>
        <a href="{{ url('users') }}" class="btn btn-danger btn-sm">Kembali</a>
    </div>
    <div class="container-fluid">
        @include('layouts.feedback')
        <div class="row">
            <div class="col-12">
                <form action="{{ @$user ? route('users.update', $user) : url('users') }}" method="POST">
                    @csrf
                    {{ @$user ? method_field('PUT') : '' }}
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama pengguna"
                            autofocus value="{{ @$user ? $user->name : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                            value="{{ @$user ? $user->email : '' }}">
                    </div>
                    @if (@!$user)
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" id="pass" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Ketik Ulang Password</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="Ketik Ulang Password">
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="status">Status</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio6" name="role" class="custom-control-input" value="Sales"
                                {{ @$user->role == 'sales' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio6">Sales</label>
                        </div>
                        <div class="tb-height-b5 tb-height-lg-b5"></div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio5" name="role" class="custom-control-input" value="Owner"
                                {{ @$user->role == 'owner' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio5">Owner</label>
                        </div>
                        <div class="tb-height-b5 tb-height-lg-b5"></div>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
        @if (@$user)
        <div class="row mt-3">
            <div class="col-12">
                <h4>Ganti Password</h4>
                <form action="{{ url('users/change-password/'.$user->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" id="pass" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Ketik Ulang Password</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="Ketik Ulang Password">
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
        @endif
    </div>
    
</div>
@endsection
