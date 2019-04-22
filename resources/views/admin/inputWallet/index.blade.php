@extends('layouts.admin.master') 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Input <small>Rekening</small></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item">Rekening</li>
            </ol>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<form method="POST" action="{{ route('admin.wallet.update', $wallet->id) }}" class="row">
    {{ csrf_field() }}
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Rekening</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-edit form-control-feedback"></span>
                            <label>Nomer Rekening</label>
                            <input id="wallet" type="text" class="form-control{{ $errors->has('wallet') ? ' is-invalid' : '' }}" name="wallet" value="{{ old('wallet') ? old('wallet') : $wallet ? $wallet->wallet : '' }}"
                                placeholder="wallet" required autofocus> @if ($errors->has('wallet'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('wallet') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-bank form-control-feedback"></span>
                            <label>BANK</label>
                            <input id="bank" type="text" class="form-control{{ $errors->has('bank') ? ' is-invalid' : '' }}" name="bank" value="{{ old('bank') ? old('bank') : $wallet ? $wallet->bank : '' }}"
                                placeholder="bank" required autofocus> @if ($errors->has('bank'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('bank') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <span class="fa fa-user form-control-feedback"></span>
                    <label>Nama</label>
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ? old('name') : $wallet ? $wallet->name : '' }}"
                        placeholder="Nama" required autofocus> @if ($errors->has('name'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span> @endif
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-block btn-danger">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection