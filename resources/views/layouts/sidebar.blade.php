<div class="tb-sidebarheader-toggle">
    <div class="tb-button-bar1"></div>
    <div class="tb-button-bar2"></div>
    <div class="tb-button-bar3"></div>
</div>
<div class="tb-sidebarheader">
    <div class="tb-sidebarheader-in" data-scrollbar>
        <div class="tb-sidebar-nav">
            @if(Auth::user()->role == 'owner')
                <ul class="tb-sidebar-nav-list tb-mp0">
                    <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ url('admin/dashboard') }}">
                            <span class="tb-sidebar-link-title">
                                <span class="tb-sidebar-link-icon"><i class="material-icons-outlined">poll</i></span>
                                <span class="tb-sidebar-link-text">Dashboard</span>
                            </span>
                        </a>
                    </li>
                </ul><!-- .tb-sidebar-nav-list -->
            @endif
            <div class="tb-sidebar-nav-title">
                <span class="tb-sidebar-nav-title-text">Master Data</span>
                <span class="tb-sidebar-nav-title-dotline"><i class="material-icons-outlined">more_horiz</i></span>
            </div>
            <ul class="tb-sidebar-nav-list tb-mp0">
                {{-- <li class="{{ request()->is('admin/customers*') ? 'active' : '' }}">
                    <a href="{{ url('admin/customers') }}">
                        <span class="tb-sidebar-link-title">
                            <span class="tb-sidebar-link-icon"><i class="material-icons-outlined">people</i></span>
                            <span class="tb-sidebar-link-text">Pembeli</span>
                        </span>
                    </a>
                </li> --}}
                <li class="{{ request()->is('admin/categories*') ? 'active' : '' }}">
                    <a href="{{ url('admin/categories') }}">
                        <span class="tb-sidebar-link-title">
                            <span class="tb-sidebar-link-icon"><i class="material-icons-outlined">book</i></span>
                            <span class="tb-sidebar-link-text">Kategori</span>
                        </span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/products*') ? 'active' : '' }}">
                    <a href="{{ url('admin/products') }}">
                        <span class="tb-sidebar-link-title">
                            <span class="tb-sidebar-link-icon"><i class="material-icons-outlined">dashboard</i></span>
                            <span class="tb-sidebar-link-text">Produk</span>
                        </span>
                    </a>
                </li>
                @if(Auth::user()->role == 'owner')
                    <li class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                        <a href="{{ url('admin/users') }}">
                            <span class="tb-sidebar-link-title">
                                <span class="tb-sidebar-link-icon"><i class="material-icons-outlined">account_circle</i></span>
                                <span class="tb-sidebar-link-text">Akun</span>
                            </span>
                        </a>
                    </li>
                @endif
            </ul><!-- .tb-sidebar-nav-list -->
            {{-- <div class="tb-sidebar-nav-title">
                <span class="tb-sidebar-nav-title-text">Sales</span>
                <span class="tb-sidebar-nav-title-dotline"><i class="material-icons-outlined">more_horiz</i></span>
            </div> --}}
            <ul class="tb-sidebar-nav-list tb-mp0">
                <li class="{{ request()->is('admin/sales') ? 'active' : '' }}">
                    <a href="{{ url('admin/sales?m='.date('m').'&y='.date('Y')) }}">
                        <span class="tb-sidebar-link-title">
                            <span class="tb-sidebar-link-icon"><i class="material-icons-outlined">book</i></span>
                            <span class="tb-sidebar-link-text">Semua Transaksi</span>
                        </span>
                    </a>
                </li>
                {{-- <li class="{{ request()->is('admin/sales-toko/create') ? 'active' : '' }}">
                    <a href="{{ url('admin/sales-toko/create') }}">
                        <span class="tb-sidebar-link-title">
                            <span class="tb-sidebar-link-icon"><i class="material-icons-outlined">home</i></span>
                            <span class="tb-sidebar-link-text">Buat Nota Penjualan Toko</span>
                        </span>
                    </a>
                </li> --}}
                {{-- <li class="{{ request()->is('admin/sales/create') ? 'active' : '' }}">
                    <a href="{{ url('admin/sales/create') }}">
                        <span class="tb-sidebar-link-title">
                            <span class="tb-sidebar-link-icon"><i class="material-icons-outlined">attach_money</i></span>
                            <span class="tb-sidebar-link-text">Buat Nota Penjualan Distributor / Agen</span>
                        </span>
                    </a>
                </li> --}}
                @if(Auth::user()->role == 'owner')
                    <br>
                    <li class="{{ request()->is('admin/settings*') ? 'active' : '' }}">
                        <a href="{{ url('admin/settings') }}">
                            <span class="tb-sidebar-link-title">
                                <span class="tb-sidebar-link-icon"><i class="material-icons-outlined">settings</i></span>
                                <span class="tb-sidebar-link-text">Settings</span>
                            </span>
                        </a>
                    </li>
                    <br>
                @endif
                <hr>
                <br>
                <li class="{{ request()->is('admin/settings*') ? 'active' : '' }}">
                    <a href="{{ url('/') }}">
                        <span class="tb-sidebar-link-title">
                            {{-- <span class="tb-sidebar-link-icon"><i class="material-icons-outlined">settings</i></span> --}}
                            <span class="tb-sidebar-link-text">Go to Frontpage</span>
                        </span>
                    </a>
                </li>
            </ul><!-- .tb-sidebar-nav-list -->
        </div>
    </div>
</div><!-- .tb-sidebarheader -->
