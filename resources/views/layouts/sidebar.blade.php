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
                    <li class="{{ request()->is('/') ? 'active' : '' }}">
                        <a href="{{ url('/') }}">
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
                <li class="{{ request()->is('customers*') ? 'active' : '' }}">
                    <a href="{{ url('customers') }}">
                        <span class="tb-sidebar-link-title">
                            <span class="tb-sidebar-link-icon"><i class="material-icons-outlined">people</i></span>
                            <span class="tb-sidebar-link-text">Pembeli</span>
                        </span>
                    </a>
                </li>
                <li class="{{ request()->is('products*') ? 'active' : '' }}">
                    <a href="{{ url('products') }}">
                        <span class="tb-sidebar-link-title">
                            <span class="tb-sidebar-link-icon"><i class="material-icons-outlined">dashboard</i></span>
                            <span class="tb-sidebar-link-text">Produk</span>
                        </span>
                    </a>
                </li>
                @if(Auth::user()->role == 'owner')
                    <li class="{{ request()->is('users*') ? 'active' : '' }}">
                        <a href="{{ url('users') }}">
                            <span class="tb-sidebar-link-title">
                                <span class="tb-sidebar-link-icon"><i class="material-icons-outlined">account_circle</i></span>
                                <span class="tb-sidebar-link-text">Akun</span>
                            </span>
                        </a>
                    </li>
                @endif
            </ul><!-- .tb-sidebar-nav-list -->
            <div class="tb-sidebar-nav-title">
                <span class="tb-sidebar-nav-title-text">Sales</span>
                <span class="tb-sidebar-nav-title-dotline"><i class="material-icons-outlined">more_horiz</i></span>
            </div>
            <ul class="tb-sidebar-nav-list tb-mp0">
                <li class="{{ request()->is('sales') ? 'active' : '' }}">
                    <a href="{{ url('sales?m='.date('m').'&y='.date('Y')) }}">
                        <span class="tb-sidebar-link-title">
                            <span class="tb-sidebar-link-icon"><i class="material-icons-outlined">book</i></span>
                            <span class="tb-sidebar-link-text">Semua Nota Penjualan</span>
                        </span>
                    </a>
                </li>
                <li class="{{ request()->is('sales-toko/create') ? 'active' : '' }}">
                    <a href="{{ url('sales-toko/create') }}">
                        <span class="tb-sidebar-link-title">
                            <span class="tb-sidebar-link-icon"><i class="material-icons-outlined">home</i></span>
                            <span class="tb-sidebar-link-text">Buat Nota Penjualan Toko</span>
                        </span>
                    </a>
                </li>
                <li class="{{ request()->is('sales/create') ? 'active' : '' }}">
                    <a href="{{ url('sales/create') }}">
                        <span class="tb-sidebar-link-title">
                            <span class="tb-sidebar-link-icon"><i class="material-icons-outlined">attach_money</i></span>
                            <span class="tb-sidebar-link-text">Buat Nota Penjualan Distributor / Agen</span>
                        </span>
                    </a>
                </li>
                @if(Auth::user()->role == 'owner')
                    <br>
                    <li class="{{ request()->is('settings*') ? 'active' : '' }}">
                        <a href="{{ url('settings') }}">
                            <span class="tb-sidebar-link-title">
                                <span class="tb-sidebar-link-icon"><i class="material-icons-outlined">settings</i></span>
                                <span class="tb-sidebar-link-text">Settings</span>
                            </span>
                        </a>
                    </li>
                @endif
            </ul><!-- .tb-sidebar-nav-list -->
        </div>
    </div>
</div><!-- .tb-sidebarheader -->
