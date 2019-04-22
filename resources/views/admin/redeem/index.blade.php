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
<form method="POST" action="{{ route('admin.redeem.update', $redeem->id) }}" class="row">
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
                            <span class="fa fa-user form-control-feedback"></span>
                            <label>Doge (%)</label>
                            <input id="doge" type="number" class="form-control{{ $errors->has('doge') ? ' is-invalid' : '' }}" name="doge" value="{{ old('doge') ? old('doge') : $redeem->doge * 100 }}"
                                placeholder="Doge" required autofocus> @if ($errors->has('doge'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('doge') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-sitemap form-control-feedback"></span>
                            <label>Redeem (%)</label>
                            <input id="value" type="number" class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}" name="value" value="{{ old('value') ? old('value') : $redeem->value * 100 }}"
                                placeholder="Redeem" required> @if ($errors->has('value'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('value') }}</strong>
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