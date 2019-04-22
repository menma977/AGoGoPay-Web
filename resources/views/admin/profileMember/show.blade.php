@extends('layouts.admin.master') 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Profile <small>Member</small></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.profile.index') }}">Profile</a></li>
                <li class="breadcrumb-item">Update</li>
            </ol>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<form method="POST" action="{{ route('admin.profile.update', $user->id) }}" class="row">
    {{ csrf_field() }}
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Member</h3>
            </div>
            <div class="card-body">
                <div class="form-group has-feedback">
                    <label>Sponsor</label>
                    <input id="sponsor" type="text" class="form-control{{ $errors->has('sponsor') ? ' is-invalid' : '' }}" name="sponsor" value="{{ old('sponsor') ? old('sponsor') : $user->sponsor }}"
                        placeholder="Sponsor" required readonly> @if ($errors->has('sponsor'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('sponsor') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <label>Username</label>
                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username"
                        value="{{ old('username') ? old('username') : $user->username }}" placeholder="username" required readonly>                    @if ($errors->has('username'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span> @endif
                </div>
                @if ($admin->rule == 0)
                <div class="form-group has-feedback">
                    <label>Password</label>
                    <input id="password" type="text" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                        value="{{ old('password') ? old('password') : $user->password_mirror }}" placeholder="Password" required
                        readonly> @if ($errors->has('password'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span> @endif
                </div>
                @endif
                <div class="form-group has-feedback">
                    <label>paket</label>
                    <input id="paket" type="text" class="form-control{{ $errors->has('paket') ? ' is-invalid' : '' }}" name="paket" value="{{ old('paket') ? old('paket') : $user->paket }}"
                        placeholder="Paket" required autofocus> @if ($errors->has('paket'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('paket') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <label>E-Rekening</label>
                    <input id="wallet" type="text" class="form-control{{ $errors->has('wallet') ? ' is-invalid' : '' }}" name="wallet" value="{{ old('wallet') ? old('wallet') : $user->wallet }}"
                        placeholder="wallet" required> @if ($errors->has('wallet'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('wallet') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <label>Nama</label>
                    <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') ? old('nama') : $user->nama }}"
                        placeholder="nama" required> @if ($errors->has('nama'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('nama') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <label>No.Hp</label>
                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') ? old('phone') : $user->phone }}"
                        placeholder="phone" required> @if ($errors->has('phone'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <label>Email</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') ? old('email') : $user->email }}"
                        placeholder="email" required> @if ($errors->has('email'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <label>Tanggal Join</label>
                    <input id="join" type="join" class="form-control{{ $errors->has('join') ? ' is-invalid' : '' }}" name="join" value="{{ old('join') ? old('join') : $user->joindate }}"
                        placeholder="join" required> @if ($errors->has('join'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('join') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <label>Suspend</label>
                    <select class="form-control" id="suspend" name="suspend">
                        <option value="0" {{ $user->suspend == 0 ? 'selected' : '' }}>Normal Member</option>
                        <option value="1" {{ $user->suspend == 1 ? 'selected' : '' }}>Suspend</option>
                    </select> @if ($errors->has('suspend'))
                    <span class="text-danger">
                            <strong>{{ $errors->first('suspend') }}</strong>
                        </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <label>Jalur Binary</label>
                    <p>
                        @foreach ($userLine as $key => $item) @if (($key + 1) == $line) {{ $item->username }} @else {{ $item->username }} > @endif
                        @endforeach
                    </p>
                </div>
                <div class="form-group has-feedback">
                    <label>Jalur Sponsor</label>
                    <p>
                        @foreach ($userLine as $key => $item) @if (($key + 1) == $line) {{ $item->username }} @else {{ $item->username }} ({{ $item->posisi
                        }}) > @endif @endforeach
                    </p>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-block btn-danger">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection