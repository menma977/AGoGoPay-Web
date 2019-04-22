<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/ico" href="{{asset('adminLTE/dist/img/logo.png')}}" />
    <title>AGOGOPAY</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #000;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .spin {
            -webkit-transition: -webkit-transform 1.1s ease-in-out;
            transition: transform 1.1s ease-in-out;
        }

        .spin:hover {
            -webkit-transform: rotate(720deg);
            transform: rotate(720deg);
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">

        </div>
        @endif

        <div class="content">
            @if (Route::has('login'))
            <div class="title m-b-md">
                @if (Auth::check())
                <a href="{{ url('/login') }}">
                            <img src="{{asset('adminLTE/dist/img/logo.png')}}" class="spin" style="opacity: .9;width: 50%;">
                        </a> @else
                <a href="{{ url('/login') }}">
                            <img src="{{asset('adminLTE/dist/img/logo.png')}}" class="spin" style="opacity: .9;width: 50%;">
                        </a> @endif
            </div>
            @endif @if (Route::has('login'))
            <div class="links">
                @if (Auth::check())
                <a href="{{ url('/home') }}">Halaman Utama</a> @else
                <a href="{{ url('/login') }}">Masuk</a> @endif
            </div>
            @endif
        </div>
    </div>
</body>

</html>