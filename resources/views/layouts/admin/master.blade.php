<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/ico" href="{{asset('adminLTE/dist/img/logo.png')}}" />
    <title>AGoGoPay</title>

    @yield('beforeHead')

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/font-awesome/css/font-awesome.min.css')  }}">
    <link rel="stylesheet" href="{{ url('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ url('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')  }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminLTE/dist/css/adminlte.min.css')  }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/iCheck/flat/blue.css')  }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/morris/morris.css')  }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css')  }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/datepicker/datepicker3.css')  }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables/dataTables.bootstrap4.css')  }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/daterangepicker/daterangepicker-bs3.css')  }}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/bootstrap/css/bootstrap.min.css')  }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')  }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="{{ url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700') }}" rel="stylesheet"> @yield('afterHead') @yield('afterHead')
    <style>
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

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- topbar -->
    @include('layouts.admin.master.header')
        <!-- /.topbar -->

        <!-- sidebar -->
    @include('layouts.admin.master.sidebar')
        <!-- /sidebar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <section class="content-header">
                <!-- Content Header (Page header) -->
                @yield('contentHeader')
                <!-- /.content-header -->
            </section>

            <!-- Main content -->
            <section class="content" style="min-height: 500px">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <footer class="main-footer">
            <strong>Copyright &copy; 2019 <a href="#">AGoGoPay</a>.</strong> Keseluruhan rights reserved
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.2
            </div>
        </footer>

    </div>
    <!-- ./wrapper -->

    @yield('beforeScript')

    <!-- jQuery -->
    <script src="{{ asset('adminLTE/plugins/jquery/jquery.min.js')  }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ url('https://code.jquery.com/ui/1.12.1/jquery-ui.min.js')  }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')  }}"></script>
    <!-- Morris.js charts -->
    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js')  }}"></script>
    <script src="{{ asset('adminLTE/plugins/morris/morris.min.js')  }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('adminLTE/plugins/sparkline/jquery.sparkline.min.js')  }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('adminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')  }}"></script>
    <script src="{{ asset('adminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')  }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('adminLTE/plugins/knob/jquery.knob.js')  }}"></script>
    <!-- daterangepicker -->
    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js')  }}"></script>
    <script src="{{ asset('adminLTE/plugins/daterangepicker/daterangepicker.js')  }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('adminLTE/plugins/datatables/jquery.dataTables.js')  }}"></script>
    <script src="{{ asset('adminLTE/plugins/datatables/dataTables.bootstrap4.js')  }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('adminLTE/plugins/datepicker/bootstrap-datepicker.js')  }}"></script>
    <!-- CK Editor -->
    <script src="{{ asset('adminLTE/plugins/ckeditor/ckeditor.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')  }}"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('adminLTE/plugins/slimScroll/jquery.slimscroll.min.js')  }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('adminLTE/plugins/fastclick/fastclick.js')  }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminLTE/dist/js/adminlte.js')  }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('adminLTE/dist/js/pages/dashboard.js')  }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('adminLTE/dist/js/demo.js')  }}"></script>

    @yield('afterScript')

</body>

</html>