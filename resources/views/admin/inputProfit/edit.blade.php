@extends('layouts.admin.master') 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Input <small>Keuntungan</small></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.profit.index') }}">Keuntungan</a></li>
                <li class="breadcrumb-item">Create</li>
            </ol>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<form method="POST" action="{{ route('admin.profit.update', $profit->id) }}" class="row">
    {{ csrf_field() }}
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Create</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group has-feedback">
                            <label>Paket</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input id="join" type="text" class="form-control{{ $errors->has('join') ? ' is-invalid' : '' }}" name="join" value="{{ number_format($profit->joins, 0, ',', '.') }}"
                                    placeholder="Paket" required readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text">,00</span>
                                </div>
                            </div>
                            @if ($errors->has('join'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('join') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group has-feedback">
                            <label>Sponsor</label>
                            <div class="input-group">
                                <input id="sponsor" type="text" class="form-control{{ $errors->has('sponsor') ? ' is-invalid' : '' }}" name="sponsor" value="{{ old('sponsor') ? old('sponsor') : $profit->sponsor * 100 }}"
                                    placeholder="Sponsor" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            @if ($errors->has('sponsor'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('sponsor') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group has-feedback">
                            <label>Pairing</label>
                            <div class="input-group">
                                <input id="pairing" type="text" class="form-control{{ $errors->has('pairing') ? ' is-invalid' : '' }}" name="pairing" value="{{ old('pairing') ? old('pairing') : $profit->pairing * 100 }}"
                                    placeholder="Pairing" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            @if ($errors->has('pairing'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('pairing') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group has-feedback">
                            <label>Hari</label>
                            <div class="input-group">
                                <input id="day" type="text" class="form-control{{ $errors->has('day') ? ' is-invalid' : '' }}" name="day" value="{{ old('day') ? old('day') : $profit->day }}"
                                    placeholder="Royalty" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">Hari</span>
                                </div>
                            </div>
                            @if ($errors->has('day'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('day') }}</strong>
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