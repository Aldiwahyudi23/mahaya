@extends('template_backend.home')
@section('heading', 'Dashboard')
@section('page')
  <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')



<div class="col-lg-4 col-6">
  <div class="small-box bg-info">
    <div class="">

    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ "Rp " . number_format(800,2,',','.') }}</div>
          <p>Saldo</p>
        </div>
        <div class="icon">
          <i class="fas fa-calendar-alt nav-icon"></i>
        </div>
        <a href="" class="small-box-footer">Total sisa uang yang ada <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
<div class="col-lg-4 col-6">
  <div class="small-box bg-success">
    <div class="">

    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ "Rp " . number_format(800,2,',','.') }}</div>
          <p>Pemasukan</p>
        </div>
        <div class="icon">
          <i class="fas fa-calendar-alt nav-icon"></i>
        </div>
        <a href="" class="small-box-footer">Jumlah Uang yang terkumpul semuanya<i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
<div class="col-lg-4 col-6">
  <div class="small-box bg-secondary">
    <div class="">
    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ "Rp " . number_format(800,2,',','.') }}</div>
          <p>Pengluaran</p>
        </div>
        <div class="icon">
          <i class="fas fa-calendar-alt nav-icon"></i>
        </div>
        <a href="" class="small-box-footer">Jumlah Uang dari berbagai pengluaran <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
<div class="col-lg-4 col-6">
  <div class="small-box bg-warning">
    <div class="">
    <div class="h5 mb-0 font-weight-bold text-gray-800">as</div>
          <p>Pengurus</p>
        </div>
        <div class="icon">
          <i class="fas fa-calendar-alt nav-icon"></i>
        </div>
        <a href="" class="small-box-footer"> Pengurus <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-md-6">
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
          $jumlah_pengeluaran = DB::table('pengeluaran')
            ->sum('pengeluaran.jumlah');
          $jumlah_pemasukan = DB::table('pemasukan')
            ->sum('pemasukan.jumlah');
          ?>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="javascript:void(0)" class="product-title">Jumlah Pemasukan</a>
            <h5>{{ "Rp " . number_format($jumlah_pemasukan,2,',','.') }}</h5>
            <hr>
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="javascript:void(0)" class="product-title">Jumlah Pengeluaran</a>
            <h5>{{ "Rp " . number_format($jumlah_pengeluaran,2,',','.') }}</h5>
            <hr>
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="javascript:void(0)" class="product-title">Saldo</a>
            <h5>{{"Rp" . number_format($jumlah_pemasukan-$jumlah_pengeluaran,2,',','.')}}</h5>
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
