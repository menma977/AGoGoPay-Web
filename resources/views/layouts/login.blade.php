<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" type="image/ico" href="{{asset('adminLTE/dist/img/logo.png')}}" />
  <title>AGoGoPay</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1"> @yield('beforeHead')

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminLTE/dist/css/adminlte.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/iCheck/square/blue.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>
    .backgroundImage {
      background-image: url('adminLTE/dist/img/background.jpg');
      background-size: cover;
    }

    .spin {
      -webkit-transition: -webkit-transform 1.1s ease-in-out;
      transition: transform 1.1s ease-in-out;
    }

    .spin:hover {
      -webkit-transform: rotate(360deg);
      transform: rotate(360deg);
    }

    .bg-danger {
      background-color: #f27e95 !important;
    }

    .sidebar-dark-danger .nav-sidebar>.nav-item>.nav-link.active {
      background-color: #f27e95 !important;
    }

    .card-danger:not(.card-outline) .card-header {
      background-color: #f27e95 !important;
    }

    .btn-danger {
      color: #fff;
      background-color: #f27e95 !important;
      border-color: #f27e95 !important;
    }
  </style>

  @yield('afterHead')

</head>

<body class="hold-transition login-page backgroundImage">
  @yield('content')
  <!-- /.login-box -->

  @yield('beforeScript')
  <!-- jQuery -->
  <script src="{{ asset('adminLTE/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- iCheck -->
  <script src="{{ asset('adminLTE/plugins/iCheck/icheck.min.js') }}"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      })
    })
  </script>
  @yield('afterScript')
</body>

</html>