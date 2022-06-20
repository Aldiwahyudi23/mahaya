@extends('template_backend.home')
@section('heading', 'Dashboard')
@section('page')
  <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
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
          </div>
        </div>
      </div>
    </div>
<!-- lAPORAN kAS -->
    <div class="col-md-3">
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
            $pengeluaran_pinjaman = DB::table('pengeluaran')->where('anggaran_id',3)
             ->sum('pengeluaran.jumlah');
            $pengeluaran_darurat = DB::table('pengeluaran')->where('anggaran_id',1)
             ->sum('pengeluaran.jumlah');
            $pengeluaran_amal = DB::table('pengeluaran')->where('anggaran_id',2)
             ->sum('pengeluaran.jumlah');
            $pengeluaran_kas = DB::table('pengeluaran')->where('anggaran_id',4)
             ->sum('pengeluaran.jumlah');

       // Pemasukan
       $jumlah_pemasukan = DB::table('pemasukan')
       ->sum('pemasukan.jumlah');
       $jumlah_pemasukan_asli = $jumlah_pemasukan - 362500;
       $darurat = $jumlah_pemasukan_asli * 20 / 100 ;
       $pinjam = $jumlah_pemasukan_asli * 20 / 100 ;
       $amal = $jumlah_pemasukan_asli * 10 / 100 ;
       $kas = $jumlah_pemasukan_asli * 50 / 100 ;

            // Saldo atm 
          $jumlah_ATM = DB::table('uang')->where('kategori','Transfer')
            ->sum('uang.jumlah');

            // Uang di bendahara
          $jumlah_uang_dibendahara = DB::table('uang')->where('kategori','Cash')
            ->sum('uang.jumlah');
          ?>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="javascript:void(0)" class="product-title">Jumlah Pemasukan</a>
            <h5>{{ "Rp " . number_format($jumlah_pemasukan,2,',','.') }}</h5>
            <p>Jumlah sadayana artos nu terkumpul ti awal sareng dugi ayeuna</p>
            <hr>
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="javascript:void(0)" class="product-title">Jumlah Pengeluaran</a>
            <h5>{{ "Rp " . number_format($jumlah_pengeluaran- $pengeluaran_pinjaman,2,',','.') }}</h5>
            <p> Jumlah sadayana pengluaran sesuai data anggaran, kecuali data pinjaman tidak termasuk pengluaran.</p>
            <hr>
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
           <b> <a href="javascript:void(0)" class="product-title">Saldo</a>
            <h4>{{"Rp" . number_format($jumlah_pemasukan-$jumlah_pengeluaran,2,',','.')}}</h4>
            <p> Jumlah Total saldo anu aya di bendahara atawa sisa tina pengeluaran termasuk data pinjaman.   </p>
            <hr /> </b>
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
           <a href="javascript:void(0)" class="product-title">Saldo ATM</a>
            <h5>{{"Rp" . number_format($jumlah_ATM-$jumlah_pengeluaran,2,',','.')}}</h5>
            <p>Saldo ATM, saldo anu aya tina tabungan kas keluarga. Jumlah <b>saldo ATM</b> di tambah artos nu masih di <b>bendahara</b> kedah <b>sami</b> sareng jumlah <b>SALDO</b> </p>
            <hr />
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="javascript:void(0)" class="product-title">Uang dibendahara nu teu acan di TF</a>
            <h5>{{"Rp" . number_format($jumlah_uang_dibendahara,2,',','.')}}</h5>
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
            <a href="javascript:void(0)" class="product-title">Jumlah Dana Darurat</a>
            <h5>{{ "Rp " . number_format($darurat-$pengeluaran_darurat ,2,',','.') }}</h5>
          </ul>
              <ul class="products-list product-list-in-card pl-1 pr-1">
                <a href="javascript:void(0)" class="product-title">Jumlah Dana Darurat nu tos ka angge </a>
                <h7>{{ "Rp " . number_format($pengeluaran_darurat ,2,',','.') }}</h7>
                <hr>
              </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="javascript:void(0)" class="product-title">Jumlah Dana Amal</a>
            <h5>{{ "Rp " . number_format($amal-$pengeluaran_amal,2,',','.') }}</h5>
          </ul>
              <ul class="products-list product-list-in-card pl-1 pr-1">
                <a href="javascript:void(0)" class="product-title">Jumlah Dana Amal nu tos ka angge </a>
                <h7>{{ "Rp " . number_format($pengeluaran_amal ,2,',','.') }}</h7>
                <hr>
              </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="javascript:void(0)" class="product-title">Jumlah dana KAS</a>
            <h5>{{"Rp" . number_format($kas-$pengeluaran_kas,2,',','.')}}</h5>
          </ul>
              <ul class="products-list product-list-in-card pl-1 pr-1">
                <a href="javascript:void(0)" class="product-title">Jumlah Dana Kas nu tos ka angge </a>
                <h7>{{ "Rp " . number_format($pengeluaran_kas ,2,',','.') }}</h7>
                <hr>
              </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="javascript:void(0)" class="product-title">Jumlah Dana Pinjam</a>
            <h5>{{"Rp" . number_format($pinjam-$pengeluaran_pinjaman,2,',','.')}}</h5>
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="javascript:void(0)" class="product-title">Uang nu di pinjem</a>
            <h7>{{"Rp" . number_format($pengeluaran_pinjaman,2,',','.')}}</h7>
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
                <img src="/adminLTE/img/user.png" alt="Product Image" class="img-size-50">
              </div>
              <div class="product-info">
                <a href="javascript:void(0)" class="product-title">{{$user_login->name}}
                  <span class="badge float-right"><i class="far fa-clock"></i> {{$user_login->created_at->diffForHumans()}}</span></a>

                <span class="product-description">
                  {{$user_login->email}}
                </span>
              </div>
            </li>
            @endforeach
            <!-- /.item -->
          </ul>
        </div>
      </div>
    </section>
  </div>
@endsection
