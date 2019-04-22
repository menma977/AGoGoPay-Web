@extends('layouts.admin.master') 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Input <small>Rate</small></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item">Rate</li>
            </ol>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<form method="POST" action="{{ route('admin.rate.update', [1,2]) }}" class="row">
    {{ csrf_field() }}
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Rate</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-sitemap form-control-feedback"></span>
                            <label>DEPOSIT <small>Saldo > DOLAR</small></label>
                            <input id="deposit" type="number" class="form-control{{ $errors->has('deposit') ? ' is-invalid' : '' }}" name="deposit" value="{{ old('deposit') ? old('deposit') : $deposit }}"
                                placeholder="deposit" required autofocus> @if ($errors->has('deposit'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('deposit') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-user form-control-feedback"></span>
                            <label>Penarikan <small>Saldo > DOLAR</small></label>
                            <input id="withdraw" type="number" class="form-control{{ $errors->has('withdraw') ? ' is-invalid' : '' }}" name="withdraw"
                                value="{{ old('withdraw') ? old('withdraw') : $withdraw }}" placeholder="withdraw">                            @if ($errors->has('withdraw'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('withdraw') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-block btn-danger">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection