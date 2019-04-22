@extends('layouts.master') 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ Auth::User()->username }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item">{{ Auth::User()->username }}</li>
            </ol>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-danger card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <h3 class="profile-username text-center">{{ Auth::User()->nama }}</h3>
                </div>
                <p class="text-muted text-center">{{ Auth::User()->username }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Email</b> <a class="float-right">{{ Auth::User()->email }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Nomor Telfon</b> <a class="float-right">{{ Auth::User()->phone }}</a>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-6">
                                <b>User Kiri</b> <a class="float-right">{{ Auth::User()->jmlkiri }}</a>
                            </div>
                            <div class="col-6">
                                <b>User Kanan</b> <a class="float-right">{{ Auth::User()->jmlkanan }}</a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <b>Bank</b> <a class="float-right">{{ Auth::user()->bank }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Nomor Rekening</b> <a class="float-right">{{ Auth::user()->norek }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Saldo</b> <a class="float-right">Rp {{ number_format($balance, 2, ',', '.') }}</a>
                    </li>
                    @if ($doge != '0') @if ($doge == '1')
                    <li class="list-group-item">
                        <b>Doge</b> <a class="float-right">Tolong refres ulang halaman ini</a>
                    </li>
                    @else
                    <li class="list-group-item">
                        <b>Doge</b> <a class="float-right">{{ number_format( $doge, 8, '.', '') }}</a>
                    </li>
                    @endif @endif
                </ul>
                <a href="{{ route('user.email', Auth::user()->id) }}" class="btn btn-danger btn-block"><b>Edit User/Password</b></a>
            </div>
        </div>
    </div>
</div>
@endsection