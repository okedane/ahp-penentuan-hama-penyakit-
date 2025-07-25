<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu </li>

                <li>
                    <a href="" class="waves-effect">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                @auth
                    @if (auth()->user()->role === 'ahli')
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="cpu"></i>
                                <span data-key="t-icons">Kriteria</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('kriteria.index') }}">Hama</a></li>
                            </ul>
                            {{-- <ul class="sub-menu" aria-expanded="false">
                                <li><a href="">Penyakit</a></li>
                            </ul> --}}
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="cpu"></i>
                                <span data-key="t-icons">Alternatif</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('alternatif.index') }}">Hama</a></li>
                            </ul>
                            {{-- <ul class="sub-menu" aria-expanded="false">
                                <li><a href="">Penyakit</a></li>
                            </ul> --}}
                        </li>
                    @endif
                @endauth

                @auth
                    @if (auth()->user()->role === 'petani')
                        <li>
                            <a href="{{ route('petani.input.gejala') }}" class="waves-effect">
                                <i data-feather="file-text"></i>
                                <span data-key="t-dashboard">Input Gejala</span>
                            </a>
                        </li>
                    @endif
                @endauth



                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="cpu"></i>
                        <span data-key="t-icons">Penyakit</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="">Kriteria</a></li>
                    </ul>
                     <ul class="sub-menu" aria-expanded="false">
                        <li><a href="">Sub Kriteria</a></li>
                    </ul>
                </li> --}}


                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="cpu"></i>
                        <span data-key="t-icons">Absesi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="">
                                <i data-feather="map-pin"></i>
                                Lokasi Restoran
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i data-feather="calendar"></i>
                                Jadwal
                            </a>
                        </li>
                        <li>
                            <a href="" data-key="t-font-awesome">
                                <i data-feather="check-square"></i>
                                Absensi
                            </a>
                        </li>
                        <li>
                            <a href="" data-key="t-font-awesome">
                                <i data-feather="user-x"></i>
                                Izin
                            </a>
                        </li>
                        <li>
                            <a href="" data-key="t-font-awesome">
                                <i data-feather="user-plus"></i>
                                Lembur
                            </a>
                        </li>
                    </ul>
                </li> --}}


                <li>
                    <a href="" class="waves-effect">
                        <i data-feather="users"></i>
                        <span data-key="t-dashboard">Management Akun</span>
                    </a>
                </li>
            </ul>


        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
