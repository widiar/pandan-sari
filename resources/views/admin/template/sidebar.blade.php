<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('gambar/logo.png') }}" alt="Pandan Sari Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.booking') }}"
                        class="nav-link{{request()->is('admin/booking') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Data Booking
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link{{request()->is('admin/banner') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Laporan Transaksi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.water-sport.index') }}"
                        class="nav-link{{request()->is('admin/water-sport*') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Informasi WaterSport
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link{{request()->is('admin/banner') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Gallery
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>