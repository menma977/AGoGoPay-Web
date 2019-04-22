@extends('layouts.login') 
@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/') }}">
            <img src="{{asset('adminLTE/dist/img/logo.png')}}" class="spin" style="opacity: .9;width: 50%;">
            <!-- <label class="spin text-danger">AGOGOPAY</label> -->
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Masuk Admin</p>
            <form method="POST" action="{{ route('admin.dump.login.validates') }}">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input id="username" type="text" placeholder="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                        name="username" value="{{ old('username') }}" required autofocus>
                    <span class="fa fa-user form-control-feedback"></span> @if (Session::has('validate'))
                    <span class="text-danger">
                            <strong>{{ __('username not valid') }}</strong>
                        </span> @endif
                </div>

                <div class="form-group has-feedback">
                    <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                        name="password" required>
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-danger btn-block btn-flat">{{ __('Masuk') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection