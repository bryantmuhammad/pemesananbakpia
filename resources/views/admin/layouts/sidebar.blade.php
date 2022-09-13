<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard.index') }}">Bakpia 716 Annur</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard.index') }}">PSB</a>
        </div>
        <ul class="sidebar-menu ">
            <li class="menu-header">Dashboard</li>
            <li class="index {{ Request::is('dashboard*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <i class="far fa-square"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-header">Data Master</li>

            <li
                class="nav-item dropdown {{ Request::is('admin/users*', 'admin/produk*', 'admin/kategori*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Menu</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/users*') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('users.index') }}">Admin</a>
                    </li>
                    @can('crud')
                        <li class="{{ Request::is('admin/produk*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('produk.index') }}">Produk</a>
                        </li>
                        <li class="{{ Request::is('admin/kategori*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('kategori.index') }}">Kategori</a>
                        </li>
                    @endcan


                </ul>
            </li>

            <li class="nav-item dropdown {{ Request::is('admin/pemesanan*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-handshake"></i>
                    <span>Pemesanan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/pemesanan/belumbayar') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('pemesanan.belumbayar') }}">Belum Membayar</a>
                    </li>
                    <li class="{{ Request::is('admin/pemesanan/sudahbayar') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('pemesanan.sudahbayar') }}">Sudah Membayar</a>
                    </li>
                    <li class="{{ Request::is('admin/pemesanan/pembuatan') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('pemesanan.pembuatan') }}">Pembuatan</a>
                    </li>
                    <li class="{{ Request::is('admin/pemesanan/dikirim') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('pemesanan.dikirim') }}">Dikirim</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::is('admin/laporan*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file"></i>
                    <span>Laporan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/laporan/pemesanan') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('laporan.pemesanan') }}">Laporan Penjualan</a>
                    </li>
                    <li class="{{ Request::is('admin/laporan/produk') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('laporan.produk') }}">Laporan Produk</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
