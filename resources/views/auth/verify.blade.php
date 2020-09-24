@extends('front.layouts.app')

@section('title')
Verifikasi email
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifikasi alamat email') }}</div>

                <div class="card-body">
                    @if(session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Email verifikasi baru telah dikirimkan ke ') . auth()->user()->email }}
                            {{-- {{ __('A fresh verification link has been sent to your email address.') }} --}}
                        </div>
                    @endif

                    {{ __('Harap cek inbox / spam email anda untuk verifikasi email terlebih dahulu sebelum melanjutkan.') }}
                    {{-- {{ __('Before proceeding, please check your email for a verification link.') }} --}}
                    {{ __('Jika email belum diterima') }},
                    {{-- {{ __('If you did not receive the email') }}, --}}
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klik disini untuk mengirim ulang email verifikasi') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
