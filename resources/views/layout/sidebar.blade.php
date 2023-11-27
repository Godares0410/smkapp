    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('AdminLTE-2/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    @if (auth('web')->check())
                        @php
                            $nama = auth()->user()->name;
                        @endphp
                    @elseif (auth('siswa')->check())
                        @php
                            $nama = auth('siswa')->user()->nama_siswa;
                        @endphp
                    @elseif (auth('guru')->check())
                        @php
                            $nama = auth('guru')->user()->nama_guru;
                        @endphp
                    @else
                        @php
                            $nama = 'tidak ada nama';
                        @endphp
                    @endif
                    <p>{{ $nama }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                                class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li class="@yield('dashboard-active')">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                @if (auth('web')->check())
                    {{-- @unless (auth('siswa')->check()) --}}
                    <li class="@yield('data-umum') treeview">
                        <a href="#">
                            <i class="fa fa-cubes"></i>
                            <span>Data Umum</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="@yield('tapel-active')"><a href="#"><i class="fa fa-circle-o"></i>
                                    Tahun Pelajaran</a></li>
                            <li class="@yield('siswa-active')"><a href="{{ route('siswa.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Siswa</a></li>
                            <li class="@yield('guru-active')"><a href="{{ route('guru.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Guru</a></li>
                            <li class="@yield('mapel-active')"><a href="{{ route('mapel.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Mapel</a></li>
                            <li class="@yield('gurumapel-active')"><a href="{{ route('guru_mapel.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Guru dan Mapel</a></li>
                            <li class="@yield('jurusan-active')"><a href="{{ route('jurusan.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Jurusan</a></li>
                            <li class="@yield('kelas_rombel-active')"><a href="{{ route('kelas_rombel.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Kelas/Rombel</a></li>
                            <li class="@yield('ekstrakulikuler-active')"><a
                                    href="{{ asset('AdminLTE-2/pages/charts/chartjs.html') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Ekstrakulikuler</a></li>
                        </ul>
                    </li>
                    {{-- @endunless --}}
                    <li class="@yield('data-ujian') treeview ">
                        <a href="#">
                            <i class="fa fa-laptop"></i>
                            <span>Data Ujian</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="@yield('jenis_ujian-active')"><a href="{{ route('jenis_ujian.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Jenis Ujian</a></li>
                            <li class="@yield('banksoal-active')"><a href="{{ route('banksoal.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Bank Soal</a></li>
                            <li class="@yield('ujian-active')"><a href="{{ route('bankujian.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Ujian</a></li>
                            <li class="@yield('jadwal_ujian-active')"><a href="{{ route('jadwal_ujian.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Jadwal Ujian</a></li>
                            <li class="@yield('sesi-active')"><a href="{{ route('sesi.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Sesi</a></li>
                            <li><a href="{{ asset('AdminLTE-2/pages/UI/general.html') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Ruang</a></li>
                            <li><a href="{{ asset('AdminLTE-2/pages/UI/general.html') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Ruang dan Sesi</a></li>
                            <li><a href="{{ asset('AdminLTE-2/pages/UI/general.html') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Nomor Peserta</a></li>
                            <li><a href="{{ asset('AdminLTE-2/pages/UI/general.html') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Alokasi Waktu</a></li>
                            <li><a href="{{ asset('AdminLTE-2/pages/UI/general.html') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Token</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-edit"></i> <span>Buat Pengumuman</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-table"></i> <span>Raport</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ asset('AdminLTE-2/pages/UI/general.html') }}"><i
                                        class="fa fa-circle-o"></i>Rekap Nilai</a></li>
                            <li><a href="{{ asset('AdminLTE-2/pages/UI/general.html') }}"><i
                                        class="fa fa-circle-o"></i>Hasil Ujian</a></li>
                            <li><a href="{{ asset('AdminLTE-2/pages/UI/general.html') }}"><i
                                        class="fa fa-circle-o"></i>Cetak Nilai</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-calendar"></i> <span>Absen</span>
                            {{-- <span class="pull-right-container">
                            <small class="label pull-right bg-red">3</small>
                            <small class="label pull-right bg-blue">17</small>
                        </span> --}}
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ asset('AdminLTE-2/pages/UI/general.html') }}"><i
                                        class="fa fa-circle-o"></i>Absen Harian</a></li>
                            <li><a href="{{ asset('AdminLTE-2/pages/UI/general.html') }}"><i
                                        class="fa fa-circle-o"></i>Absen Bulanan</a></li>
                            <li><a href="{{ asset('AdminLTE-2/pages/UI/general.html') }}"><i
                                        class="fa fa-circle-o"></i>Laporan</a></li>
                        </ul>
                    </li>
                @endif
                @if (auth('siswa')->check())
                    <li class="@yield('assesmen') treeview">
                        <a href="#">
                            <i class="fa fa-cubes"></i>
                            <span>Assessmen</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="@yield('assesmen-active')"><a href="{{ route('siswas.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Ujian</a></li>
                            <li class="@yield('siswa-active')"><a href="#"><i class="fa fa-circle-o"></i>
                                    Tugas</a></li>
                            <li class="@yield('guru-active')"><a href="#"><i class="fa fa-circle-o"></i>
                                    E-Learning</a></li>
                        </ul>
                    </li>
                @endif
        </section>
        <!-- /.sidebar -->
    </aside>
