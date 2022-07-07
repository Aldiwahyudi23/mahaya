@extends('template_backend.home')
@if (Auth::user()->pengumuman_id == 2)
@section('heading', 'Dashboard')
@section('page')
<li class="breadcrumb-item active">Dashboard</li>
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
@if(session('hadir'))
<div class="container">
  <div class="callout callout-success alert alert-success alert-dismissible fade show" role="alert">
    <h5><i class="fas fa-check"></i> Anjen Kudu Hadir :</h5>
    {{session('hadir')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</div>
@endif
@if(session('tidak'))
<div class="container">
  <div class="callout callout-warning alert alert-warning alert-dismissible fade show" role="alert">
    <h5><i class="fas fa-check"></i> Mudah-mudahan kapayunna tiasa :</h5>
    {{session('tidak')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</div>
@endif
<div class="col-lg-8">
  <div class="card">
    <div class="card-body">
      <div class="row table-responsive">
        <div class="col-12">
          <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
            <thead>
              <tr class="bg-light">
                <th>No.</th>
                <th>Nama</th>
                <th>Absen</th>
                <th>Alasan</th>
                <th>Tanggapan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 0;
              ?>
              @foreach($data_hadir as $hadir)
              <?php $no++; ?>
              <tr>
                <td>{{$no}}</td>
                <td>{{$hadir->anggota->name}}</td>
                <td>{{$hadir->kehadiran }}</td>
                <td>{{$hadir->alasan}}</td>
                <td>{{$hadir->tanggapan}}</td>
              </tr>

              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-4">
  <div class="card">
    <div class="card-body">
      <div class="d-flex">
        <p class="d-flex flex-column">
          <span class="text-bold text-lg">Data Kehadiran</span>
        </p>
        <p class="ml-auto d-flex flex-column text-right">
          <span class="text-success">
            <i class="fas fa-arrow-up"></i> {{$guru}}
          </span>
        </p>
      </div>
      <div class="position-relative mb-4">
        <div class="row">
          <div class="col-md-8">
            <div class="chart-responsive">
              <canvas id="pieChartGuru" height="200"></canvas>
            </div>
          </div>
          <div class="col-md-4">
            <ul class="chart-legend clearfix">
              <li><i class="far fa-circle text-primary"></i> Hadir {{$gurulk}}</li>
              <li><i class="far fa-circle text-danger"></i> Tidak {{$gurupr}}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class="card card-warning" style="min-height: 385px;">
    <div class="card-header">
      <h3 class="card-title" style="color: white;">
        Pengumuman
      </h3>
    </div>
    <div class="card-body table-responsive">
      <div class="tab-content p-0">
        <!-- isi pengumuman -->

        {!! $pengumuman->isi !!}
      </div>
    </div>
  </div>
</div>
<!-- lAPORAN kAS -->
<div class="row">
  <div class="col-md-6">
    <section class="content card" style="padding: 15px 15px 0px 15px ">
      <div class="box">
        <div class="row">
          <div class="col">
            <h4><i class="nav-icon fas fa-dollar-sign my-0 btn-sm-1"></i> Keuangan KAS</h4>
            <hr>
          </div>
        </div>
        <div class="card-body p-0">
          <?php
          // pengluaran
          $jumlah_pengeluaran = DB::table('pengeluaran')
            ->sum('pengeluaran.jumlah');
          $pengeluaran_pinjaman = DB::table('pengeluaran')->where('anggaran_id', 3)
            ->sum('pengeluaran.jumlah');
          $pengeluaran_darurat = DB::table('pengeluaran')->where('anggaran_id', 1)
            ->sum('pengeluaran.jumlah');
          $pengeluaran_amal = DB::table('pengeluaran')->where('anggaran_id', 2)
            ->sum('pengeluaran.jumlah');
          $pengeluaran_kas = DB::table('pengeluaran')->where('anggaran_id', 4)
            ->sum('pengeluaran.jumlah');
          $pemasukan_pinjaman = DB::table('bayar_pinjam')
            ->sum('bayar_pinjam.jumlah_bayar');

          // Pemasukan
          $jumlah_pemasukan = DB::table('pemasukan')
            ->sum('pemasukan.jumlah');
          $jumlah_pemasukan_asli = $jumlah_pemasukan - 362500;
          $darurat = $jumlah_pemasukan_asli * 20 / 100;
          $pinjam = $jumlah_pemasukan_asli * 20 / 100;
          $amal = $jumlah_pemasukan_asli * 10 / 100;
          $kas = $jumlah_pemasukan_asli * 50 / 100;
          $saldo = $jumlah_pemasukan - $jumlah_pengeluaran;

          // Saldo atm 
          $jumlah_ATM = DB::table('uang')->where('kategori', 'Transfer')
            ->sum('uang.jumlah');
          $saldo_atm = $jumlah_ATM - $jumlah_pengeluaran;

          // Uang di bendahara
          $jumlah_uang_cash = DB::table('uang')->where('kategori', 'Cash')
            ->sum('uang.jumlah');
          ?>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="/pemasukan/detail" class="product-title">Jumlah Pemasukan</a>
            <h5>{{ "Rp " . number_format($jumlah_pemasukan,2,',','.') }}</h5>
            <p>Jumlah sadayana artos nu terkumpul ti awal sareng dugi ayeuna</p>
            <hr>
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="/pengeluaran/detail" class="product-title">Jumlah Pengeluaran</a>
            <h5>{{ "Rp " . number_format($jumlah_pengeluaran- $pengeluaran_pinjaman,2,',','.') }}</h5>
            <p> Jumlah sadayana pengluaran sesuai data anggaran, kecuali data pinjaman tidak termasuk pengluaran.</p>
            <hr>
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <b> <a href="javascript:void(0)" class="product-title">Saldo</a>
              <h4>{{"Rp" . number_format( $saldo,2,',','.')}}</h4>
              <p> Jumlah Total saldo anu aya di bendahara atawa sisa tina pengeluaran termasuk data pinjaman. </p>
              <hr />
            </b>
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="javascript:void(0)" class="product-title">Saldo ATM</a>
            <h5>{{"Rp" . number_format($saldo_atm,2,',','.')}}</h5>
            <p>Saldo ATM, saldo anu aya tina tabungan kas keluarga. Jumlah <b>saldo ATM</b> di tambah artos nu masih di <b>bendahara</b> kedah <b>sami</b> sareng jumlah <b>SALDO</b> </p>
            <hr />
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="javascript:void(0)" class="product-title">Uang dibendahara nu teu acan di TF</a>
            <h5>{{"Rp" . number_format( $saldo-$saldo_atm,2,',','.')}}</h5>
            <p>Artos nu teu acan di setor tunai keun ku bendahara, sareng nu masih di pegang ku bendahara atanapi sekertaris</p>
            <hr />
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="javascript:void(0)" class="product-title">Uang nu di pinjem</a>
            <h5>{{"Rp" . number_format( $pengeluaran_pinjaman,2,',','.')}}</h5>
            <hr />
          </ul>

        </div>
      </div>
    </section>
  </div>

  <!-- lAPORAN DANA KAS -->
  <div class="col-md-3">
    <section class="content card" style="padding: 15px 15px 0px 15px ">
      <div class="box">
        <div class="row">
          <div class="col">
            <h4><i class="nav-icon fas fa-dollar-sign my-0 btn-sm-1"></i> Dana Anggaran KAS</h4>
            <hr>
          </div>
        </div>
        <div class="card-body p-0">
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="/anggaran/1/detail" class="product-title">Jumlah Dana Darurat</a>
            <h5>{{ "Rp " . number_format($darurat-$pengeluaran_darurat ,2,',','.') }}</h5>
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="/pengluaran/pinjam/anggota" class="product-title">Jumlah Dana Darurat nu tos ka angge </a>
            <h7>{{ "Rp " . number_format($pengeluaran_darurat ,2,',','.') }}</h7>
            <hr>
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="/anggaran/2/detail" class="product-title">Jumlah Dana Amal</a>
            <h5>{{ "Rp " . number_format($amal-$pengeluaran_amal,2,',','.') }}</h5>
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="/pengluaran/pinjam/anggota" class="product-title">Jumlah Dana Amal nu tos ka angge </a>
            <h7>{{ "Rp " . number_format($pengeluaran_amal ,2,',','.') }}</h7>
            <hr>
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="/anggaran/4/detail" class="product-title">Jumlah dana KAS</a>
            <h5>{{"Rp" . number_format($kas-$pengeluaran_kas,2,',','.')}}</h5>
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="/pengluaran/pinjam/anggota" class="product-title">Jumlah Dana Kas nu tos ka angge </a>
            <h7>{{ "Rp " . number_format($pengeluaran_kas ,2,',','.') }}</h7>
            <hr>
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="/anggaran/3/detail" class="product-title">Jumlah Dana Pinjam</a>
            <h5>{{"Rp" . number_format($pinjam-$pengeluaran_pinjaman+$pemasukan_pinjaman,2,',','.')}}</h5>
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="/pengluaran/pinjam/anggota" class="product-title">Uang nu di pinjem</a>
            <h7>{{"Rp" . number_format($pengeluaran_pinjaman-$pemasukan_pinjaman,2,',','.')}}</h7>
            <hr />
          </ul>
        </div>
      </div>
    </section>
  </div>

  <!-- rIWAYAT LOGIN -->
  <div class="col-md-3">
    <section class="content card" style="padding: 10px 10px 10px 10px ">
      <div class="box">
        <div class="row">
          <div class="col">
            <h4><i class="nav-icon fas fa-user-tag my-0 btn-sm-1"></i> Riwayat Login</h4>
            <hr>
          </div>
        </div>
        <div class="card-body p-0">
          <ul class="products-list product-list-in-card pl-2 pr-2">
            @foreach($data_login as $user_login)
            <li class="item">
              <div class="product-img">
                <img src="{{ asset('img/male.jpg') }}" alt="Product Image" class="img-size-50 img-circle">
              </div>
              <div class="product-info">
                <a href="javascript:void(0)" class="product-title">{{$user_login->name}} </a>
                @if(Cache::has('user-is-online-' .$user_login->id))
                <span class="text-success badge float-right">Online</span>
                @else
                <span class="text-secondary badge float-right">Offline</span>
                @endif <br>
                <span class="badge float-right"><i class="far fa-clock"></i> {{Carbon\Carbon::parse($user_login->last_seen)->diffForHumans()}}</span>
              </div>
            </li>
            @endforeach
            <!-- /.item -->
          </ul>
        </div>
      </div>
    </section>
  </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    'use strict'

    var pieChartCanvasGuru = $('#pieChartGuru').get(0).getContext('2d')
    var pieDataGuru = {
      labels: [
        'Laki-laki',
        'Perempuan',
      ],
      datasets: [{
        data: [{
          {
            $gurulk
          }
        }, {
          {
            $gurupr
          }
        }],
        backgroundColor: ['#007BFF', '#DC3545'],
      }]
    }
    var pieOptions = {
      legend: {
        display: false
      }
    }
    var pieChart = new Chart(pieChartCanvasGuru, {
      type: 'doughnut',
      data: pieDataGuru,
      options: pieOptions
    })

    var pieChartCanvasSiswa = $('#pieChartSiswa').get(0).getContext('2d')
    var pieDataSiswa = {
      labels: [
        'Laki-laki',
        'Perempuan',
      ],
      datasets: [{
        data: [{
          {
            $siswalk
          }
        }, {
          {
            $siswapr
          }
        }],
        backgroundColor: ['#007BFF', '#DC3545'],
      }]
    }
    var pieOptions = {
      legend: {
        display: false
      }
    }
    var pieChart = new Chart(pieChartCanvasSiswa, {
      type: 'doughnut',
      data: pieDataSiswa,
      options: pieOptions
    })


    var pieChartCanvasPaket = $('#pieChartPaket').get(0).getContext('2d')
    var pieDataPaket = {
      labels: [
        'Bisnis kontruksi dan Properti',
        'Desain Permodelan dan Informasi Bangunan',
        'Elektronika Industri',
        'Otomasi Industri',
        'Teknik dan Bisnis Sepeda Motor',
        'Rekayasa Perangkat Lunak',
        'Teknik Pemesinan',
        'Teknik Pengelasan',
      ],
      datasets: [{
        data: [{
          {
            $bkp
          }
        }, {
          {
            $dpib
          }
        }, {
          {
            $ei
          }
        }, {
          {
            $oi
          }
        }, {
          {
            $tbsm
          }
        }, {
          {
            $rpl
          }
        }, {
          {
            $tpm
          }
        }, {
          {
            $las
          }
        }],
        backgroundColor: ['#d4c148', '#ba6906', '#ff990a', '#00a352', '#2cabe6', '#999999', '#0b2e75', '#7980f7'],
      }]
    }
    var pieOptions = {
      legend: {
        display: false
      }
    }
    var pieChart = new Chart(pieChartCanvasPaket, {
      type: 'doughnut',
      data: pieDataPaket,
      options: pieOptions
    })
  })

  $("#Dashboard").addClass("active");
  $("#liDashboard").addClass("menu-open");
  $("#AdminHome").addClass("active");
</script>
@endsection

@endif