<aside class="main-sidebar sidebar-light-danger elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{asset('adminLTE/dist/img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AGOGOPAY</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image col-12 text-center">
                <a href="{{ route('user.index') }}" class="d-block">
                    <h3>{{ Auth::User()->username }}</h3>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Request::route()->getName() == 'home' ? 'active':'' }}">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Halaman Utama
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pin.index') }}" class="nav-link {{ Request::route()->getName() == 'pin.index' ? 'active':'' }}">
                        <i class="nav-icon fa fa-barcode"></i>
                        <p>
                            Pin
                        </p>
                    </a>
                </li>
                @if(Auth::user()->username999)
                <li class="nav-item">
                    <a href="{{ route('doge') }}" class="nav-link {{ Request::route()->getName() == 'doge' ? 'active':'' }}">
                        <i class="nav-icon fa fa-steam"></i>
                        <p>
                            Game
                        </p>
                    </a>
                </li>
                @endif
                <li class="{{ explode('/', Request::path())[0] == 'network' ? 'nav-item has-treeview menu-open':'nav-item has-treeview' }}">
                    <a href="#" class="nav-link {{ explode('/', Request::path())[0] == 'network' ? 'active':'' }}">
                        <i class="nav-icon fa fa-sitemap"></i>
                        <p>Jaringan <i class="right fa fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" style="display: {{ explode('/', Request::path())[0] == 'network' ? 'block':'' }};">
                            <a href="{{ route('network.genealogi.index', Crypt::encrypt(Auth::user()->username)) }}" class="nav-link 
                            {{ explode('/', Request::path())[0] == 'network' ? (explode('/', Request::path())[1] == 'genealogi' ? 'active':'') : '' }}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Genealogy</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('network.sponsor.index') }}" class="nav-link {{ explode('/', Request::path())[0] == 'network' ?
                                    (explode('/', Request::path())[1] == 'sponsor' ? 'active':'') : '' }}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Sponsor</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ explode('/', Request::path())[0] == 'financial' ? 'nav-item has-treeview menu-open':'nav-item has-treeview' }}">
                    <a href="#" class="nav-link {{ explode('/', Request::path())[0] == 'financial' ? 'active':'' }}">
                        <i class="nav-icon fa fa-money"></i>
                        <p>Keuangan <i class="right fa fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('financial.all.financial') }}" class="nav-link {{ explode('/', Request::path())[0] == 'financial' ?
                                (explode('/', Request::path())[1] == 'all' ? 'active':'') : '' }}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Keseluruhan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('financial.profit') }}" class="nav-link {{ explode('/', Request::path())[0] == 'financial' ?
                                (explode('/', Request::path())[1] == 'profit' ? 'active':'') : '' }}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Keuntungan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('financial.statement') }}" class="nav-link {{ explode('/', Request::path())[0] == 'financial' ?
                                (explode('/', Request::path())[1] == 'statement' ? 'active':'') : '' }}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Penarikan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link">
                        <i class="nav-icon fa fa-power-off"></i>
                        <p>
                            Keluar
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>