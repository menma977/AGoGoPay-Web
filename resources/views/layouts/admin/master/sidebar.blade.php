<aside class="main-sidebar sidebar-dark-danger elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('adminLTE/dist/img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AGOGOPAY</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image col-12 text-center">
                <a href="#" class="d-block">
                    <h3>{{ Session::get('user')->username }}</h3>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link {{ Request::route()->getName() == 'admin.index' ? 'active':'' }}">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Halaman Utama
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.profit.index') }}" class="nav-link {{ Request::route()->getName() == 'admin.profit.index' ? 'active':'' }}">
                        <i class="nav-icon fa fa-gear"></i>
                        <p>
                            Input profit
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.wallet.index') }}" class="nav-link {{ Request::route()->getName() == 'admin.wallet.index' ? 'active':'' }}">
                        <i class="nav-icon fa fa-gear"></i>
                        <p>
                            Input Rekening
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.profile.index') }}" class="nav-link {{ Request::route()->getName() == 'admin.profile.index' ? 'active':'' }}">
                        <i class="nav-icon fa fa-gear"></i>
                        <p>
                            Profil Member
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.valid.index') }}" class="nav-link {{ Request::route()->getName() == 'admin.valid.index' ? 'active':'' }}">
                        <i class="nav-icon fa fa-gear"></i>
                        <p>
                            Validasi Aktivasi
                        </p>
                        <br>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pin.index') }}" class="nav-link {{ Request::route()->getName() == 'admin.pin.index' ? 'active':'' }}">
                        <i class="nav-icon fa fa-gear"></i>
                        <p>
                            Pin
                        </p>
                        <br>
                    </a>
                </li>
                <li class="{{ explode('.', Request::route()->getName())[0].'.'.explode('.', Request::route()->getName())[1] == 'admin.wd' ?
                        'nav-item has-treeview menu-open':'nav-item has-treeview' }}">
                    <a href="#" class="nav-link {{ explode('.', Request::route()->getName())[0].'.'.explode('.', Request::route()->getName())[1] == 'admin.wd'
                             ? 'active':'' }}">
                        <i class="nav-icon fa fa-gear"></i>
                        <p>Penarikan <i class="right fa fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.wd.index.bonus') }}" class="nav-link {{ Request::route()->getName() == 'admin.wd.index.bonus' ? 'active' : '' }}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Penarikan Bonus</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.wd.create') }}" class="nav-link {{ Request::route()->getName() == 'admin.wd.create' ? 'active' : '' }}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Debet Bonus</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ explode('.', Request::route()->getName())[0].'.'.explode('.', Request::route()->getName())[1] == 'admin.history' ?
                        'nav-item has-treeview menu-open':'nav-item has-treeview' }}">
                    <a href="#" class="nav-link {{ explode('.', Request::route()->getName())[0].'.'.explode('.', Request::route()->getName())[1] == 'admin.history'
                             ? 'active':'' }}">
                        <i class="nav-icon fa fa-gear"></i>
                        <p>History <i class="right fa fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.history.reg') }}" class="nav-link {{ Request::route()->getName() == 'admin.history.reg' ? 'active' : '' }}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Pendaftaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.history.wd') }}" class="nav-link {{ Request::route()->getName() == 'admin.history.wd' ? 'active' : '' }}">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Penarikan</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>