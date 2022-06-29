@extends('template_backend.home')

@section('heading', 'Peminjaman')
@section('page')
<li class="breadcrumb-item active">Peminjaman</li>
@endsection

@section('content')

@if(session('sukses'))
<div class="container">
    <div class="callout callout-success alert alert-success alert-dismissible fade show" role="alert">
        <h5><i class="fas fa-check"></i> Sukses :</h5>
        {{session('sukses')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif

@if(session('warning'))
<div class="container">
    <div class="callout callout-warning alert alert-warning alert-dismissible fade show" role="alert">
        <h5><i class="fas fa-info"></i> Informasi :</h5>
        {{session('warning')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif

@if ($errors->any())
<div class="container">
    <div class="callout callout-danger alert alert-danger alert-dismissible fade show">
        <h5><i class="fas fa-exclamation-triangle"></i> Peringatan :</h5>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
<div class="alert alert-info alert-dismissible fade show col-md-12" role="alert">
    <b><i class="fas fa-info"></i> INFO !!!</b> <br>
    - Mangga input peminjaman di handap sesuai kebutuhan <br>
    - hasil input masih tina pengajuan, kantun ngantosan konfirmasi <br>
    <b> Alasan : </b><br>
    Pami ngesian alasan, kedah detail sareng lengkap tur jelas <br>
    <br>
    Sateacan nginput kedah paham heula kana syarat & ketentuanna <br>
    <b> Supados jelas mangga <a href="/anggaran/3/detail">Klik</a> deskripsi</b>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
// Pemasukan

use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

$anggaran_pinjaman = DB::table('anggaran')->find(3); // mengambil data anggaraan
$jumlah_pemasukan = DB::table('pemasukan')
    ->sum('pemasukan.jumlah');
$jumlah_pemasukan_asli = $jumlah_pemasukan - 362500; //Jumlah semua pemasukan
$pinjam = $jumlah_pemasukan_asli * 20 / 100; // Menghitung Jumlah anggaran pinjaman dari semua pemasukan
$jatah = $pinjam * $anggaran_pinjaman->persen / 100;
$pengeluaran_pinjaman = DB::table('pengeluaran')->where('anggaran_id', 3) //Jumlah uang  yang sudah di pinjam
    ->sum('pengeluaran.jumlah');

?>
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        <h4><i class="nav-icon fas fa-credit-card my-1 btn-sm-1"></i> Pinjam Uang Kas</h4>
        <hr>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">

                            @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Sekertaris' )
                            <div class="card-header bg-light p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active btn-sm" href="#to" data-toggle="tab"> PINJAMAN KAS </a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#ang" data-toggle="tab"> PENGLUARAN ANGGARAN</a></li>

                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- Awal data pemasukan -->
                                    <div class="active tab-pane" id="to">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="card">
                                                    <h6 class="card-header bg-light p-3"><i class="fas fa-credit-card"></i> PINJAMAN KAS</h6>
                                                    <div class="card-body">
                                                        <form action="/pengluaran/pinjam/anggota/tambah" method="POST" enctype="multipart/form-data">
                                                            {{csrf_field()}}
                                                            <div class="form-group row">
                                                                <label for="tanggal">Tanggal</label>
                                                                <input value="{{old('tanggal')}}" name="tanggal" type="date" class="form-control bg-light" id="tanggal" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                                                <input name="anggota_id" type="hidden" id="anggota_id">
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="jumlah">Jumlah</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Rp.</span>
                                                                    </div>
                                                                    <input value="{{old('jumlah')}}" name="jumlah" type="number" class="form-control" id="jumlah" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">.00</span>
                                                                    </div>
                                                                </div>
                                                                @if ($pinjam-$pengeluaran_pinjaman >= 1000000)
                                                                <span class="text-danger" style="font-size: 10px">Jatah perorang 30 % tina jumlah sadayana anggaran pinjaman yaeta {{"Rp" . number_format($jatah,2,',','.')}}, teu kengeng ngalebihi.</span>
                                                                @else
                                                                <span class="text-danger" style="font-size: 10px">Saldo Anggaran pinjaman nembe {{"Rp" . number_format($pinjam - $pengeluaran_pinjaman,2,',','.')}}, </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="keterangan">Alasan</label>
                                                                <textarea name="keterangan" class="form-control bg-light" id="keterangan" rows="3" placeholder=" Alasan ieu esian sesuai alasan minjem dana pinjam" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{old('keterangan')}}</textarea>
                                                            </div>
                                                            <hr>
                                                            <?php
                                                            $status = DB::table('pengeluaran')->where('status', 'Nunggak')->count();

                                                            $status4 = DB::table('pengeluaran')->where('anggota_id', Auth::user()->id)->get();
                                                            $status5 = $status4->where('status', 'Nunggak')->count();
                                                            ?>
                                                            @if ($pinjam-$pengeluaran_pinjaman >= $anggaran_pinjaman->nominal_max_anggaran && $status <= $anggaran_pinjaman->max_orang && $status5==0 ) <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> PINJAM</button> <br>
                                                                <span class="text-danger" style="font-size: 10px">Kouta pinjaman anggaran kas keluaraga maxsimal 3 orang, ayeuna Kouta pinjaman nembe {{$status}} orang</span>
                                                                @else
                                                                @if ($pinjam-$pengeluaran_pinjaman <= $anggaran_pinjaman->nominal_max_anggaran) <button type="submit" class="btn btn-success btn-sm" disabled><i class="fas fa-save"></i> Saldo Teu Acan Cukup </button> <br>
                                                                    <span class="text-danger" style="font-size: 10px">Saldo Anggaran Pinjamanna masih kurang ti min pengluaran anggaran dana pinjam, pami atos min. Sajuta tiasa </span>
                                                                    @elseif ($status5 == 1)
                                                                    <button type="submit" class="btn btn-success btn-sm" disabled><i class="fas fa-save"></i> Punten Anjen Masih Gaduh Tunggakan</button> <br>
                                                                    <span class="text-danger" style="font-size: 10px">Punten, Lunasan heula Tunggakananna pami bade ngajukeun deui </span>
                                                                    @elseif ($status >= $anggaran_pinjaman->max_orang)
                                                                    <button type="submit" class="btn btn-success btn-sm" disabled><i class="fas fa-save"></i> Kouta pinjaman tos pinuh</button> <br>
                                                                    <span class="text-danger" style="font-size: 10px">Kouta pinjaman anggaran kas keluaraga maxsimal 3 orang, ayeuna Kouta pinjaman atos pinuh</span>

                                                                    @endif
                                                                    @endif
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Akhir 1 -->
                                    <!-- Awal 2 -->
                                    <div class="tab-pane" id="ang">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="card">
                                                    <h6 class="card-header bg-light p-3"><i class="fas fa-credit-card"></i> TAMBAH PENARIKAN KAS</h6>
                                                    <div class="card-body">
                                                        <form action="/pengeluaran/tarik/tambah" method="POST" enctype="multipart/form-data">
                                                            {{csrf_field()}}
                                                            <div class="form-group row" id="noId">

                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="anggaran_id">Anggaran</label>
                                                                <select name="anggaran_id" id="anggaran_id" class="form-control select2bs4" required>
                                                                    <option value="">-- Pilih Anggaran --</option>
                                                                    @foreach($data_anggaran as $anggaran)
                                                                    <option value="{{$anggaran->id}}">{{$anggaran->nama_anggaran}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="tanggal">Tanggal Penarikan</label>
                                                                <input value="{{old('tanggal')}}" name="tanggal" type="date" class="form-control bg-light" id="tanggal" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="jumlah">Jumlah</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Rp.</span>
                                                                    </div>
                                                                    <input value="{{old('jumlah')}}" name="jumlah" type="number" class="form-control" id="jumlah" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="keterangan">Keterangan</label>
                                                                <textarea name="keterangan" class="form-control bg-light" id="keterangan" rows="3" placeholder="Eusian Keterangan ieu sesuai keterangan artos anu di tarik" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{old('keterangan')}}</textarea>
                                                            </div>
                                                            <hr>
                                                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPEN</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Akhir 2-->
                                </div>
                            </div>
                            @else
                            <h6 class="card-header bg-light p-3"><i class="fas fa-credit-card"></i> PINJAMAN KAS</h6>
                            <div class="card-body">
                                <form action="/pengluaran/pinjam/anggota/tambah" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group row">
                                        <label for="tanggal">Tanggal</label>
                                        <input value="{{old('tanggal')}}" name="tanggal" type="date" class="form-control bg-light" id="tanggal" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                        <input name="anggota_id" type="hidden" id="anggota_id">
                                    </div>
                                    <div class="form-group row">
                                        <label for="jumlah">Jumlah</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input value="{{old('jumlah')}}" name="jumlah" type="number" class="form-control" id="jumlah" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                        @if ($pinjam-$pengeluaran_pinjaman >= 1000000)
                                        <span class="text-danger" style="font-size: 10px">Jatah perorang 30 % tina jumlah sadayana anggaran pinjaman yaeta {{"Rp" . number_format($jatah,2,',','.')}}, teu kengeng ngalebihi.</span>
                                        @else
                                        <span class="text-danger" style="font-size: 10px">Saldo Anggaran pinjaman nembe {{"Rp" . number_format($pinjam - $pengeluaran_pinjaman,2,',','.')}}, </span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label for="keterangan">Alasan</label>
                                        <textarea name="keterangan" class="form-control bg-light" id="keterangan" rows="3" placeholder=" Alasan ieu esian sesuai alasan minjem dana pinjam" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{old('keterangan')}}</textarea>
                                    </div>
                                    <hr>
                                    <?php
                                    $status = DB::table('pengeluaran')->where('status', 'Nunggak')->count();

                                    $status4 = DB::table('pengeluaran')->where('anggota_id', Auth::user()->id)->get();
                                    $status5 = $status4->where('status', 'Nunggak')->count();
                                    ?>
                                    @if ($pinjam-$pengeluaran_pinjaman >= $anggaran_pinjaman->nominal_max_anggaran && $status <= $anggaran_pinjaman->max_orang && $status5==0 ) <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> PINJAM</button> <br>
                                        <span class="text-danger" style="font-size: 10px">Kouta pinjaman anggaran kas keluaraga maxsimal 3 orang, ayeuna Kouta pinjaman nembe {{$status}} orang</span>
                                        @else
                                        @if ($pinjam-$pengeluaran_pinjaman <= $anggaran_pinjaman->nominal_max_anggaran) <button type="submit" class="btn btn-success btn-sm" disabled><i class="fas fa-save"></i> Saldo Teu Acan Cukup </button> <br>
                                            <span class="text-danger" style="font-size: 10px">Saldo Anggaran Pinjamanna masih kurang ti min pengluaran anggaran dana pinjam, pami atos min. Sajuta tiasa </span>
                                            @elseif ($status5 == 1)
                                            <button type="submit" class="btn btn-success btn-sm" disabled><i class="fas fa-save"></i> Punten Anjen Masih Gaduh Tunggakan</button> <br>
                                            <span class="text-danger" style="font-size: 10px">Punten, Lunasan heula Tunggakananna pami bade ngajukeun deui </span>
                                            @elseif ($status >= $anggaran_pinjaman->max_orang)
                                            <button type="submit" class="btn btn-success btn-sm" disabled><i class="fas fa-save"></i> Kouta pinjaman tos pinuh</button> <br>
                                            <span class="text-danger" style="font-size: 10px">Kouta pinjaman anggaran kas keluaraga maxsimal 3 orang, ayeuna Kouta pinjaman atos pinuh</span>

                                            @endif
                                            @endif
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8">

                        <div class="card-body">
                            <b><i class="fas fa-info"></i> Catatan !!!</b> <br>
                            <b> Syarat : </b><br>
                            - Bertanggung jawab <br>
                            - Masih dalam lingkungan keluarga <br>
                            - Sanggup membayar dalam jangka waktu tertentu <br>
                            <b> Ketentuan : </b><br>
                            - Dana Pinjaman di keluarkan min 1 juta <br>
                            - Per satu orang 30 % dari 1 juta <br>
                            - Pelunasan max 3 bulan<br>
                            - Pembayaran bisa di cicil<br>
                            <br>
                            syarat & ketentuan nu di luhur nembe sebagian <br>
                            <b> Supados jelas mangga klik deskripsi di handap </b> <br> <br>

                            <table class="table" style="margin-top: -10px;">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{Auth::user()->name}}</td>
                                </tr>
                                <tr>
                                    <td>Program</td>
                                    <td>:</td>
                                    <td>Kas Keluaraga</td>
                                </tr>
                                <tr>
                                    <td>Ketua</td>
                                    <td>:</td>
                                    <td>Supriatna</td>
                                </tr>
                                @php
                                $bulan = date('m');
                                $tahun = date('Y');
                                @endphp
                                <tr>
                                <tr>
                                    <td>Tahun</td>
                                    <td>:</td>
                                    <td>
                                        @if ($bulan > 5)
                                        {{ $tahun }}/{{ $tahun+1 }}
                                        @else
                                        {{ $tahun-1 }}/{{ $tahun }}
                                        @endif
                                    </td>
                                </tr>

                            </table>


                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-light p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active btn-sm" href="#pinj" data-toggle="tab"><i class="fas fa-credit-card"></i> Data Pengluaran</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#anggota" data-toggle="tab"><i class="fas fa-child"></i> Deskripsi</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- Awal data pemasukan -->
                                    <div class="active tab-pane" id="pinj">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>Ket.</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $no = 0;
                                                            ?>
                                                            @php
                                                            $total = 0;
                                                            @endphp
                                                            @foreach($data_pinjam as $pinjam)
                                                            <?php $no++;
                                                            $status2 = DB::table('pengeluaran')->find($pinjam->id);
                                                            ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>
                                                                    <a href="/pemasukan/bayar/{{$pinjam->id}}/pinjaman/" class="">
                                                                        @if ( $status2->status == 'Lunas')
                                                                        <i class="btn btn-success "> LUNAS </i>
                                                                        @else
                                                                        <i class=" btn btn-warning "> Bayar </i>
                                                                        @endif
                                                                        </i></a>
                                                                </td>
                                                                <td>{{$pinjam->tanggal}}</td>
                                                                <td>{{ "Rp " . number_format($pinjam->jumlah,2,',','.') }}</td>
                                                            </tr>

                                                            @php
                                                            $total += $pinjam->jumlah;
                                                            @endphp
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="2" class="text-center"><b>Total</b></th>
                                                                <th colspan="1"><b>{{ "Rp " . number_format( $total,2,',','.') }}</b></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Akhir togle data pemasukan -->

                                    <!-- awal data anggota -->
                                    <div class="tab-pane" id="anggota">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaKeluar'>
                                                        <p>Kas keluarga </p>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <!-- /.col -->
                    </div>

                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-header bg-light p-2">
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <b><i class="fas fa-info"></i> Laporan !!!</b> <br>
                                    Sadayana laporan pengluaran tiasa di tingal di handap <br>
                                    Supados jelas mangga klik pilihan di handap
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active btn-sm" href="#setor" data-toggle="tab"><i class="fas fa-credit-card"></i> Data Pengluaran</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#darura" data-toggle="tab"><i class=""></i> Data Darurat</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#ama" data-toggle="tab"><i class=""></i> Data Amal</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#pinja" data-toggle="tab"><i class=""></i> Data Pinjam</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#usah" data-toggle="tab"><i class=""></i> Data Usaha</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#acar" data-toggle="tab"><i class=""></i> Data Acara</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#lai" data-toggle="tab"><i class=""></i> Data Lain-Lain</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- seluruh data penarikan -->
                                    <div class="active tab-pane" id="setor">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($data_tarik as $tarik)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>{{$tarik->tanggal}}</td>
                                                                <td>{{ "Rp " . number_format($tarik->jumlah,2,',','.') }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Akhir togle data penarikan -->


                                    <!-- awal data darurat -->
                                    <div class="tab-pane" id="darura">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($dana_darurat as $tarik)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>{{$tarik->tanggal}}</td>
                                                                <td>{{ "Rp " . number_format($tarik->jumlah,2,',','.') }}</td>
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/detail" class=""><i class="nav-icon fas fa-book"></i></a>
                                                                </td>
                                                                @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Sekertaris')
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/edit/" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                                                </td>
                                                                @endif
                                                                <td>
                                                                    @if (auth()->user()->role == 'Admin')
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/hapus" class="" onclick="return confirm('Leres bade ngahapus data anu namina {{$tarik->anggota->name}} tanggal {{$tarik->tanggal}}  ?')"><i class="nav-icon fas fa-trash"></i></a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- awal data amal -->
                                    <div class="tab-pane" id="ama">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaAmal'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($dana_amal as $tarik)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>{{$tarik->tanggal}}</td>
                                                                <td>{{ "Rp " . number_format($tarik->jumlah,2,',','.') }}</td>
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/detail" class=""><i class="nav-icon fas fa-book"></i></a>
                                                                </td>
                                                                @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Sekertaris')
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/edit/" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                                                </td>
                                                                @endif
                                                                <td>
                                                                    @if (auth()->user()->role == 'Admin')
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/hapus" class="" onclick="return confirm('Leres bade ngahapus data anu namina {{$tarik->anggota->name}} tanggal {{$tarik->tanggal}}  ?')"><i class="nav-icon fas fa-trash"></i></a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- awal data pinjam -->
                                    <div class="tab-pane" id="pinja">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaAmal'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>Nama Peminjam</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($dana_pinjam as $tarik)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>{{$tarik->anggota->name}}</td>
                                                                <td>{{$tarik->tanggal}}</td>
                                                                <td>{{ "Rp " . number_format($tarik->jumlah,2,',','.') }}</td>
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/detail" class=""><i class="nav-icon fas fa-book"></i></a>
                                                                </td>
                                                                @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Sekertaris')
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/edit/" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                                                </td>
                                                                @endif
                                                                <td>
                                                                    @if (auth()->user()->role == 'Admin')
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/hapus" class="" onclick="return confirm('Leres bade ngahapus data anu namina {{$tarik->anggota->name}} tanggal {{$tarik->tanggal}}  ?')"><i class="nav-icon fas fa-trash"></i></a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- awal data usaha -->
                                    <div class="tab-pane" id="usah">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaAmal'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>

                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($dana_usaha as $tarik)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>{{$tarik->tanggal}}</td>
                                                                <td>{{ "Rp " . number_format($tarik->jumlah,2,',','.') }}</td>
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/detail" class=""><i class="nav-icon fas fa-book"></i></a>
                                                                </td>
                                                                @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Sekertaris')
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/edit/" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                                                </td>
                                                                @endif
                                                                <td>
                                                                    @if (auth()->user()->role == 'Admin')
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/hapus" class="" onclick="return confirm('Leres bade ngahapus data anu namina {{$tarik->anggota->name}} tanggal {{$tarik->tanggal}}  ?')"><i class="nav-icon fas fa-trash"></i></a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- awal data acara -->
                                    <div class="tab-pane" id="acar">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaAmal'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>

                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($dana_acara as $tarik)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>{{$tarik->tanggal}}</td>
                                                                <td>{{ "Rp " . number_format($tarik->jumlah,2,',','.') }}</td>
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/detail" class=""><i class="nav-icon fas fa-book"></i></a>
                                                                </td>
                                                                @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Sekertaris')
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/edit/" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                                                </td>
                                                                @endif
                                                                <td>
                                                                    @if (auth()->user()->role == 'Admin')
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/hapus" class="" onclick="return confirm('Leres bade ngahapus data anu namina {{$tarik->anggota->name}} tanggal {{$tarik->tanggal}}  ?')"><i class="nav-icon fas fa-trash"></i></a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- awal data laian-laian -->
                                    <div class="tab-pane" id="lai">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaAmal'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>

                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($dana_lain as $tarik)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>{{$tarik->tanggal}}</td>
                                                                <td>{{ "Rp " . number_format($tarik->jumlah,2,',','.') }}</td>
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/detail" class=""><i class="nav-icon fas fa-book"></i></a>
                                                                </td>
                                                                @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Sekertaris')
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/edit/" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                                                </td>
                                                                @endif
                                                                <td>
                                                                    @if (auth()->user()->role == 'Admin')
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/hapus" class="" onclick="return confirm('Leres bade ngahapus data anu namina {{$tarik->anggota->name}} tanggal {{$tarik->tanggal}}  ?')"><i class="nav-icon fas fa-trash"></i></a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- akhir -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- /.container-fluid -->
        </section>
    </div>
</section>

@endsection
@section('script')
<script>
    $("#Peminjaman").addClass("active");
</script>
@endsection