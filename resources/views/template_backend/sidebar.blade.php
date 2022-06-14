<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link" style="">
        <img src="{{ asset('img/logo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">KELUARGA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if (Auth::user()->role == 'Admin')
                    <li class="nav-item has-treeview" id="liDashboard">
                        <a href="#" class="nav-link" id="Dashboard">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-4">
                            <li class="nav-item">
                                <a href="{{ url('/') }}" class="nav-link" id="Home">
                                    <i class="fas fa-home nav-icon"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if (Auth::user()->role == "Admin")
                    <li class="nav-item has-treeview" id="liMasterData">
                        <a href="#" class="nav-link" id="MasterData">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Master Data
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-4">
                            <li class="nav-item">
                                <a href="" class="nav-link" id="DataJadwal">
                                    <i class="fas fa-calendar-alt nav-icon"></i>
                                    <p>Data Jadwal</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="DataGuru">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Data Pengurus</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="DataKelas">
                                    <i class="fas fa-home nav-icon"></i>
                                    <p>Data Program</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="DataSiswa">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Data Anggota</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="DataMapel">
                                    <i class="fas fa-book nav-icon"></i>
                                    <p>Data Jabtan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('pengguna')}}" class="nav-link" id="DataUser">
                                    <i class="fas fa-user-plus nav-icon"></i>
                                    <p>Data User</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                        <li class="nav-item has-treeview" id="liViewTrash">
                            <a href="#" class="nav-link" id="ViewTrash">
                                <i class="nav-icon fas fa-recycle"></i>
                                <p>
                                    View Trash
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ml-4">
                                <li class="nav-item">
                                    <a href="" class="nav-link" id="TrashJadwal">
                                        <i class="fas fa-calendar-alt nav-icon"></i>
                                        <p>Trash Jadwal</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link" id="TrashGuru">
                                        <i class="fas fa-users nav-icon"></i>
                                        <p>Trash Guru</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link" id="TrashKelas">
                                        <i class="fas fa-home nav-icon"></i>
                                        <p>Trash Kelas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link" id="TrashSiswa">
                                        <i class="fas fa-users nav-icon"></i>
                                        <p>Trash Siswa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link" id="TrashMapel">
                                        <i class="fas fa-book nav-icon"></i>
                                        <p>Trash Mapel</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link" id="TrashUser">
                                        <i class="fas fa-user nav-icon"></i>
                                        <p>Trash User</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @else
                    @endif
                    <li class="nav-item">
                        <a href="" class="nav-link" id="DataKas">
                            <i class="fas fa-file-alt nav-icon"></i>
                            <p>Data Kas</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{route('pemasukan.setor')}}" class="nav-link" id="DataKas">
                            <i class="fas fa-file-alt nav-icon"></i>
                            <p>Bayar</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview" id="likas">
                        <a href="#" class="nav-link" id="kas">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>
                                Kas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-4">
                            <li class="nav-item">
                                <a href="" class="nav-link" id="Input_pemasukan">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Input Pemasukan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="DataPemasukan">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Pemasukan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="Input_pengluaran">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Input Pengluaran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="pinjam">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Pinjam</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="darurat">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Darurat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="amal">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Amal</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="usaha">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Usaha</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="acara">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Acara</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="lain">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Lain</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="Deskripsi">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Laporan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview" id="penglink">
                        <a href="#" class="nav-link" id="pengajuan">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>
                                Pengajuan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-4">
                            <li class="nav-item">
                                <a href="" class="nav-link" id="pemasukan">
                                    <i class="nav-icon fas fa-clipboard"></i>
                                    <p>Pemasukan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="Pinjaman">
                                    <i class="nav-icon fas fa-clipboard"></i>
                                    <p>Peminjaman</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link" id="Pengumuman">
                            <i class="nav-icon fas fa-clipboard"></i>
                            <p>Pengumuman</p>
                        </a>
                    </li>
                @elseif (Auth::user()->role == 'Sekertaris')
                    <li class="nav-item has-treeview">
                        <a href="}" class="nav-link" id="Home">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link" id="JadwalGuru">
                            <i class="fas fa-calendar-alt nav-icon"></i>
                            <p>Jadwal</p>
                        </a>
                    </li>
                    <li class="nav-item">
                                <a href="" class="nav-link" id="UlanganGuru">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Input Uang</p>
                                </a>
                    </li>
                    
                @elseif (Auth::user()->role == 'Anggota')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link" id="Home">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('pemasukan.setor')}}" class="nav-link" id="DataKas">
                            <i class="fas fa-file-alt nav-icon"></i>
                            <p>Data Kas</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="" class="nav-link" id="Input">
                            <i class="fas fa-file-alt nav-icon"></i>
                            <p>Bayar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link" id="pengajuanpinjam">
                            <i class="fas fa-file-alt nav-icon"></i>
                            <p>Pengajuan Dana Pinjam</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview" id="likas">
                        <a href="#" class="nav-link" id="kas">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>
                                Pengluaran
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-4">
                            <li class="nav-item">
                                <a href="" class="nav-link" id="pinjam">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Pinjam</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="darurat">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Darurat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="amal">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Amal</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="usaha">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Usaha</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="acara">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Acara</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" id="lain">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Lain</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item has-treeview">
                        <a href="/home" class="nav-link" id="Home">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>