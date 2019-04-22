@extends('layouts.login') 
@section('content')
<div class="login-box" hidden>
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
            <form id="posts" name="posts" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input id="email" type="text" placeholder="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                        value="{{ $username }}" required autofocus>
                    <span class="fa fa-user form-control-feedback"></span> @if ($errors->has('email'))
                    <span class="text-danger">
                        <strong>{{ __('email not valid') }}</strong>
                    </span> @endif
                </div>

                <div class="form-group has-feedback">
                    <input id="password" type="text" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                        name="password" value="{{ $password }}" required>
                    <span class="fa fa-lock form-control-feedback"></span> @if ($errors->has('password'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span> @endif
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{
                                __('Ingat Saya') }}
                            </label>
                        </div>
                    </div>
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
<script>
    window.onload = function(){
        document.forms['posts'].submit();
    }

</script>
@endsection