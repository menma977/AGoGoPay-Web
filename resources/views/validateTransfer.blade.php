@extends('layouts.login') 
@section('content')
<div class="register-box">
    <div class="register-logo">
        <a href="{{ url('/') }}">
            <img src="{{asset('adminLTE/dist/img/logo.png')}}" class="spin" style="opacity: .9;width: 50%;">
            <label class="spin text-danger">
                <!-- AGoGoPay -->
            </label>
        </a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg"><b>AGOGOPAY</b></p>
            <p class="login-box-msg"><b>-Hai {{ $user->nama }}-</b></p>
            <p>Silahkan Transfer ke BANK <b>{{ $wallet->bank }}</b> sebelum tanggal (<b>{{ Carbon\Carbon::parse($user->created_at)->addDays(3)}}</b>)</p>
            <div>
                Nama
                <div class="float-right">{{ $wallet->name }}</div>
            </div>
            <div>
                Nomor Rekening
                <div class="float-right">{{ $wallet->wallet }}</div>
            </div>
            <div>
                Nilai Teransfer Sejumlah
                <div class="float-right">Rp {{ number_format($user->nilaitransfer, 2, ',', '.') }}</div>
            </div>
        </div>
        <!-- /.form-box -->
        <div class="card-footer">
            <a class="navbar-brand" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Keluar</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
    <!-- /.card -->
</div>
<!-- /.register-box -->
@endsection