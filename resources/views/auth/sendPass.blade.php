@extends('layouts.login') 
@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/') }}">
            <img src="{{asset('adminLTE/dist/img/logo.png')}}" class="spin" style="opacity: .9;width: 50%;">
            <label class="spin text-danger">
                <!-- AGoGoPay -->
            </label>
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Lupa Kata Sandi</p>
            <form method="POST" action="{{ route('sendPass') }}">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input id="email" type="text" placeholder="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                        value="{{ old('email') }}" required autofocus> @if ($errors->has('email'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span> @endif @if (Session::has('validate'))
                    <span class="text-danger">
                            <strong>{{ __('email not valid') }}</strong>
                        </span> @endif
                </div>

                <button type="submit" class="btn btn-danger btn-block btn-flat">{{ __('Send Password') }}</button>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection