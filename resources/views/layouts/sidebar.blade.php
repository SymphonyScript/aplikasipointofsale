<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div id="two-column-menu">
        </div>

        <div class="container-fluid">
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('home') }}">
                        <i class="mdi mdi-speedometer"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('supplier.index') }}">
                        <i class="mdi mdi-speedometer"></i> <span>Supplier</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('customer.index') }}">
                        <i class="mdi mdi-speedometer"></i> <span>Customer</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('user.index') }}">
                        <i class="mdi mdi-speedometer"></i> <span>User</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarProducts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProducts">
                        <i class="mdi mdi-speedometer"></i> <span>Produk</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProducts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('product.category.index') }}" class="nav-link">Kategori</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('product.unit.index') }}" class="nav-link">Unit</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('product.item.index') }}" class="nav-link">Item</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarStocks" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarStocks">
                        <i class="mdi mdi-speedometer"></i> <span>Stok</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarStocks">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('stock.in.index') }}" class="nav-link">Stock In</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('stock.out.index') }}" class="nav-link">Stock Out</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('transaction.create') }}">
                        <i class="mdi mdi-speedometer"></i> <span>Transaksi</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarReports" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarReports">
                        <i class="mdi mdi-speedometer"></i> <span>Laporan
                        </span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarReports">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="" class="nav-link">Penjualan</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">Stock In</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">Stock Out</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
