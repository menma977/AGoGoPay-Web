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
            <p class="login-box-msg">Daftarkan Anggota Baru</p>

            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                        placeholder="name" required autofocus>
                    <span class="fa fa-user form-control-feedback"></span> @if ($errors->has('name'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                        placeholder="email" required autofocus>
                    <span class="fa fa-envelope form-control-feedback"></span> @if ($errors->has('email'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                        placeholder="Password" required>
                    <span class="fa fa-lock form-control-feedback"></span> @if ($errors->has('password'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation"
                        required>
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-danger btn-block btn-flat">Daftar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="{{ route('login') }}" class="text-center">Sudah Punya Akun ?</a>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.card -->
</div>
<!-- /.register-box -->
@endsection