<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Dashboard</li>

                <li>
                    <a href="{{ url('/dashboard') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('profil') }}">
                        <i class="bx bxs-user"></i>
                        <span data-key="t-dashboard">Profil</span>
                    </a>
                </li>
                @if (Auth::user()->isAdmin())
                    <li class="menu-title" data-key="t-menu">Data Master</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="bx bx-group"></i>
                            <span data-key="t-authentication">Pengguna</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ url('peran') }}">
                                    <span data-key="t-calendar">Role</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('user') }}">
                                    <span data-key="t-calendar">User</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="bx bx-buildings"></i>
                            <span data-key="t-apps">Fasilitas</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ url('gedung') }}" class="">
                                    <span data-key="t-calendar">Gedung & Ruangan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('fasilitas') }}">
                                    <span data-key="t-chat">Fasilitas</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="index.html">
                            <i class="bx bx-calendar"></i>
                            <span data-key="t-dashboard">Periode</span>
                        </a>
                    </li>

                    <li class="menu-title" data-key="t-menu">Laporan Perbaikan</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="bx bx-wrench"></i>
                            <span data-key="t-apps">laporan Perbaikan</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li class="{{ $activeMenu == 'pelaporan' ? 'mm-active' : '' }}">
                                <a href="{{ url('pelaporan') }}">
                                    <span data-key="t-calendar">Laporan</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="{{ $activeMenu == 'pelaporan' ? 'mm-active' : '' }}">
                                    <span data-key="t-chat">Penugasan</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                </li>
                @if (Auth::user()->isUser())
                    <li class="menu-title" data-key="t-menu">Laporan Perbaikan</li>
                    
                    <li class="{{ $activeMenu == 'pelaporan' ? 'mm-active' : '' }}">
                        <a href="{{ url('pelaporan') }}">
                            <i class="bx bx-wrench"></i>
                            <span data-key="t-calendar">Laporan</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->isAdmin() || Auth::user()->isSarpras())
                    <li class="menu-title" data-key="t-menu">Laporan</li>
                    <li>
                        <a href="index.html">
                            <i class="bx bx-trending-up"></i>
                            <span data-key="t-dashboard">Statistik Laporan</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="bx bx-bar-chart-square"></i>
                            <span data-key="t-">laporan Periode</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="bx bx-sync"></i>
                            <span data-key="t-">Riwayat Perbaikan</span>
                        </a>
                    </li>
                    <li class="menu-title" data-key="t-menu">Rekomendasi Keputusan</li>
                    <li>
                        <a href="index.html">
                            <i class="bx bx-list-ol"></i>
                            <span data-key="t-dashboard">Kriteria</span>
                        </a>
                    </li>

                    <li>
                        <a href="index.html">
                            <i class="bx bx-calculator"></i>
                            <span data-key="t-dashboard">Perhitungan</span>
                        </a>
                    </li>
                <li class="menu-title" data-key="t-menu">Log Activity</li>
                <li>
                    <a href="index.html">
                        <i class="bx bx-time"></i>
                        <span data-key="t-dashboard">Log Activity</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
