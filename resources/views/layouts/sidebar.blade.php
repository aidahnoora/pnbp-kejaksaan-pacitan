<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="/home">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if (Auth::user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#master" aria-expanded="false" aria-controls="master">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Import</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="master">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="/import-ba-denda">Import BA Denda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/import-setor-debet">Import Setor Debet</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#data" aria-expanded="false" aria-controls="data">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Master Data</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="data">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="/detail-ba-denda">BA Denda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/detail-setor-debet">Setor Debet</a>
                    </li>
                </ul>
            </div>
        </li>
        @if (Auth::user()->role == 'admin')
            <li class="nav-item {{ Request::is('bidang*') ? 'active' : '' }}">
                <a class="nav-link" href="/bidang">
                    <i class="icon-paper menu-icon"></i>
                    <span class="menu-title">Bidang</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('inputan*') ? 'active' : '' }}">
                <a class="nav-link" href="/inputan">
                    <i class="icon-plus menu-icon"></i>
                    <span class="menu-title">Inputan Bidang</span>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#laporan" aria-expanded="false" aria-controls="laporan">
                <i class="icon-printer menu-icon"></i>
                <span class="menu-title">Laporan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="laporan">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="/laporan/pidum">Pidana Umum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/laporan/pidsus">Pidana Khusus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/laporan/bb">Barang Bukti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/laporan/pembinaan">Pembinaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/laporan">Bidang Lain</a>
                    </li>
                </ul>
            </div>
        </li>
        {{-- @if (Auth::user()->role == 'admin')
        <li class="nav-item {{ Request::is('user*') ? 'active' : '' }}">
            <a class="nav-link" href="/user">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">User</span>
            </a>
        </li>
        @endif --}}
    </ul>
</nav>
