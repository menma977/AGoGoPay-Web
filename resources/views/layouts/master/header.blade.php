<nav class="main-header navbar navbar-expand border-bottom navbar-dark bg-danger">
    <!-- Kiri navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
    </ul>
    <!-- Kanan navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                {{ Auth::User()->username }} <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <li>
                    <a href="{{ route('user.index') }}" style="color: black !important;">
                        <i class="fa fa-user" style="margin-left: 10%"></i> Profile
                    </a>
                </li>
                <div class="dropdown-divider"></div>
                <a style="color: black !important;" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <li>
                        <i class="fa fa-power-off" style="margin-left: 10%"></i>Keluar
                    </li>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </ul>
        </li>
    </ul>
</nav>