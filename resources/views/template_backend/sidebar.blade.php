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
                     
                    <li class="nav-item">
                        <a href="" class="nav-link" id="pengajuanpinjam">
                            <i class="fas fa-file-alt nav-icon"></i>
                            <p>Deskripsi Kas</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview" id="likas">
                        <a href="#" class="nav-link" id="kas">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>
                                Anggaran
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        
                        <ul class="nav nav-treeview ml-4">
                        <li class="nav-item">
                                <a href="/anggaran/1/detail" class="nav-link" id="darurat">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Darurat</p>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="/anggaran/2/detail" class="nav-link" id="amal">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Amal</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/anggaran/3/detail" class="nav-link" id="pinjam">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Pinjam</p>
                                </a>
                            </li>
                        
                            <li class="nav-item">
                                <a href="/anggaran/4/detail" class="nav-link" id="usaha">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Usaha</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/anggaran/5/detail" class="nav-link" id="acara">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Acara</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/anggaran/5/detail" class="nav-link" id="lain">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Data Lain-Lain</p>
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
                                <a href="{{route('pengurus')}}" class="nav-link" id="DataGuru">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Data Pengurus</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('program')}}" class="nav-link" id="DataKelas">
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
                                <a href="{{route('anggaran')}}" class="nav-link" id="DataMapel">
                                    <i class="fas fa-book nav-icon"></i>
                                    <p>Data Anggaran</p>
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
                                <a href="{{route('pengajuan.bayar.anggota')}}" class="nav-link" id="pemasukan">
                                    <i class="nav-icon fas fa-clipboard"></i>
                                    <p>Pemasukan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('pengajuan.pinjaman.anggota')}}" class="nav-link" id="Pinjaman">
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
                @elseif (Auth::user()->role == 'Bendahara' || Auth::user()->role == 'Sekertaris')

                    <li class="nav-item">
                        <a href="/pemasukan/setor" class="nav-link" id="UlanganGuru">
                            <i class="fas fa-file-alt nav-icon"></i>
                            <p>Input Uang</p>
                        </a>
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
                                <a href="{{route('pengajuan.bayar.anggota')}}" class="nav-link" id="pemasukan">
                                    <i class="nav-icon fas fa-clipboard"></i>
                                    <p>Pemasukan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('pengajuan.pinjaman.anggota')}}" class="nav-link" id="Pinjaman">
                                    <i class="nav-icon fas fa-clipboard"></i>
                                    <p>Peminjaman</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pengumuman') }}" class="nav-link" id="Pengumuman">
                            <i class="nav-icon fas fa-clipboard"></i>
                            <p>Pengumuman</p>
                        </a>
                    </li>
                    
                
                @else

                @endif
                <hr>
                <li class="nav-item has-treeview">
                        <a href="{{ route('logout') }}" class="nav-link" id="Home">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Kaluar</p>
                        </a>
                    </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>