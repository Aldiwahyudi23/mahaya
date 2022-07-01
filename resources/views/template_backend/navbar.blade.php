<!-- Navbar -->
<?php

use App\Models\Pemasukan;
use App\Models\Pemberitahuan;
use App\Models\Pengeluaran;

$data_pemberitahuan_anggota = Pemasukan::orderByRaw('id DESC')->where('anggota_id', Auth::user()->id)->limit(5)->get();
$jumlah_data_pemberitahuan_anggota = Pemasukan::where('status', 1)->count();

$data_pemberitahuan = Pemasukan::orderByRaw('id DESC')->limit(5)->get();
$jumlah_data_pemberitahuan = Pemasukan::where('status', 1)->count();

$data_pengeluaran = Pengeluaran::orderByRaw('id DESC')->limit(5)->get();
$jumlah_data_pengeluaran = Pengeluaran::where('status', 1)->count();

$total = $jumlah_data_pemberitahuan + $jumlah_data_pengeluaran;

use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

$data_pengajuan = Pengajuan::all();
$jumlah_data_pengajuan = Pengajuan::all()->count();
$jumlah_data_pengajuan_bayar = Pengajuan::where('kategori', 'Bayar')->count();
$jumlah_data_pengajuan_pinjam = Pengajuan::where('kategori', 3)->count();
$jumlah_data_pengajuan_bayar_pinjaman = Pengajuan::where('kategori', 'bayar_pinjaman')->count();
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #0f4c81;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="brand-link" style="color: #fff;" data-widget="pushmenu" href="#">
                <img src="{{ asset('img/logo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        @if (Auth::user()->role == "Admin" || Auth::user()->role == "Bendahara")
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell" style="color: #fff"></i>

                @if ($jumlah_data_pengajuan == 0 )
                @else
                <span class="badge badge-warning navbar-badge">{{$jumlah_data_pengajuan}}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{$jumlah_data_pengajuan}} Pemberitahuan</span>
                @foreach($data_pengajuan as $data)
                <div class="dropdown-divider"></div>
                @if ($data->kategori == 'Bayar' )
                <a href="/pengajuan/setor/anggota/{{$data->id}}/lihat" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('img/male.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                {{$data->anggota->name}}
                                <span class="float-right text-sm text-warning"></i></span>
                            </h3>
                            <p class="text-sm">Bayar Kas {{$data->jumlah}} {{$data->keterangan}}</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                @elseif ($data->kategori == 3)
                <a href="/pengajuan/pinjam/anggota/{{$data->id}}/lihat" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('img/male.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                {{$data->anggota->name}}
                                <span class="float-right text-sm text-warning"></i></span>
                            </h3>
                            <p class="text-sm">Pinjam Uang Kas {{$data->jumlah}} {{$data->keterangan}}</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                @else
                <a href="/pengajuan/bayar/anggota/{{$data->id}}/lihat" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('img/male.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                {{$data->anggota->name}}
                                <span class="float-right text-sm text-warning"></i></span>
                            </h3>
                            <p class="text-sm">Bayar Pinjaman kas {{$data->jumlah}} {{$data->keterangan}}</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                @endif
                @endforeach
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>

            </div>
        </li>
        @elseif (Auth::user()->role == "Ketua" || Auth::user()->role == "Sekertaris")
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell" style="color: #fff"></i>
                @if ($total == 0)
                @else
                <span class="badge badge-warning navbar-badge">{{$total}}</span>
                @endif
            </a>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">{{$jumlah_data_pemberitahuan}} Notifications</span>
                <div class="dropdown-divider"></div>
                @foreach($data_pemberitahuan as $data)
                <a href="/laporan/pemasukan/{{$data->id}}/detail" id="status" onclick="MyFunction()" class="dropdown-item">
                    <i class="fas fa-check mr-2"></i>pembayaran {{$data->anggota->name }}
                    @if ($data->status == 0 )
                    <span class="float-right text-muted text-sm">{{Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</span>
                    @else
                    <span class="float-right text-sm badge badge-primary">1</span>
                    @endif

                </a>
                @endforeach
                <!-- @foreach($data_pengeluaran as $data)
                <a href="/laporan/pemasukan/{{$data->id}}/detail" id="status" onclick="MyFunction()" class="dropdown-item">
                    <i class="fas fa-send mr-2"></i>pembayaran {{$data->anggaran->nama }}
                    @if ($data->status == 0 )
                    <span class="float-right text-muted text-sm">{{Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</span>
                    @else
                    <span class="float-right text-sm badge badge-primary">1</span>
                    @endif

                </a>
                @endforeach -->
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>

            </div>
        </li>
        @else
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell" style="color: #fff"></i>
                @if ($jumlah_data_pemberitahuan_anggota == 0)
                @else
                <span class="badge badge-warning navbar-badge">{{$jumlah_data_pemberitahuan_anggota}}</span>
                @endif
            </a>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">{{$jumlah_data_pemberitahuan_anggota}} Notifications</span>
                <div class="dropdown-divider"></div>
                @foreach($data_pemberitahuan_anggota as $data)
                <a href="/laporan/pemasukan/{{$data->id}}/detail" id="status" onclick="MyFunction()" class="dropdown-item">
                    <i class="fas fa-check mr-2"></i>Pembayaran SUKSES
                    @if ($data->status == 0 )
                    <span class="float-right text-muted text-sm">{{Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</span>
                    @else
                    <span class="float-right text-sm badge badge-primary">1</span>
                    @endif

                </a>
                @endforeach
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>

            </div>
        </li>
        @endif
        <li class="nav-item dropdown">
            <a class="nav-link" style="color: #fff">
                <i class="nav-icon fas fa-user-circle"></i> &nbsp; {{ Auth::user()->name }}
            </a>
        </li>

    </ul>
</nav>
<!-- /.navbar -->