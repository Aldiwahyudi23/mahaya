@extends('template_backend.home')
@section('heading')
Pengajuan
@endsection
@section('page')
<li class="breadcrumb-item active"><a href="">Anggota</a></li>
<li class="breadcrumb-item active"></li>
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
<div class="callout callout-danger alert alert-primary alert-dismissible fade show">
  <h5><i class="fas fa-info"></i> Informasi :</h5>
  - Halaman ieu kanggo mayar pinjaman mangga klik esian wae kolom di handap ! <br>
  - Pembayaran Tiasa di cicil, masuken wae nominal nu bade di bayarkeun! <br>
  - Pami pembayaran atos sami sareng jumlah anu di pinjam (lunas) kolom pembayarn bakal teu aya !
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<section class="content card col-12" style="padding: 10px 10px 10px 10px ">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- Main content -->
        <div class="invoice p-3 mb-3">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fas fa-credit-card"></i> Detail Data Pinjaman
              </h4>
            </div>
          </div>
          <!-- info row -->
          <div class="row">
            <!-- accepted payments column -->
            <div class="col-12">
              <p class="lead">Catatan :</p>
              <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                - Pemabayaran pinjaman tiasa di cicil, salami 3 bulan lunas <br>
                - Di usahakeun lunas salami 3 bulan sesuai ketentuan nu tos di tangtoskeun
                - Bayar tiasa lewat transfer atawa langsung bayar tunai
              </p>

            </div>

            <!-- /.col -->
            <div class="col-12">
              <p class="lead">Rekap data pinjaman :</p>

              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Nama Anggota</th>
                    <td>{{ $setor->anggota->name}}</td>
                  </tr>
                  <tr>
                    <th>Tanggal Penginputan</th>
                    <td>{{ $setor->tanggal}}</td>
                  </tr>
                  <tr>
                    <th>Jumlah Uang</th>
                    <td>{{ "Rp " . number_format($setor->jumlah,2,',','.') }}</td>
                  </tr>
                  <tr>
                    <th>Alasan</th>
                    <td>{{ $setor->keterangan}}</td>
                  </tr>
                  <!--  -->

                  <tr>
                    <th>
                      <center>Pembayaran</center>
                    </th>

                  </tr>
                  <?php
                  $no = 0;
                  $total = 0;
                  $jumlah = $setor->jumlah;
                  ?>

                  @foreach($bayar_pinjam as $bayar)
                  <?php
                  $no++;
                  $total += $bayar->jumlah_bayar;
                  $jumlah = $setor->jumlah - $total;
                  $proses = $setor->jumlah <= $total;
                  ?>
                  <tr>
                    <th>bayar {{$no}} </th>
                    <td>{{ "Rp " . number_format($bayar->jumlah_bayar,2,',','.') }}</td>
                  </tr>
                  @endforeach
                </table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          @if ( $setor->jumlah <= $total) <div class="callout callout-danger alert alert-success alert-dismissible fade show">
            <h5><i class="fas fa-info"></i> LUNAS :</h5>
            - Pelunasan salami {{$no}} kali ! <br>
            - Hatur nuhun atos bertanggung jawab kana syarat & ketentuan anu tos di sepakati, hapunten bilih artos peminjaman ieu kurang mencukupi. soal na anggran ieu kedah di bagi rata sareng nu sanes !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @else
        <div class="callout callout-danger alert alert-warning alert-dismissible fade show">
          <h5><i class="fas fa-info"></i> Nunggak :</h5>
          - Pembayaran nembe ka {{$no}} ! <br>
          - Jumlah Pemasukan bayar pinjaman nembe ka tampi <b>{{ "Rp " . number_format($total,2,',','.') }}</b> ! <br>
          - Sisa Tagihan <b>{{ "Rp " . number_format($jumlah,2,',','.') }}</b> !
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
          <div class="col-12">
            <form action="/pemasukan/bayar/pinjaman" method="post">
              @csrf
              <div class="form-group row">
                <label for="pembayaran">Pembayaran</label>
                <select name="pembayaran" id="pembayaran" class="form-control select2bs4" required>
                  <option value="Cash">Uang Tunai</option>
                  <option value="Transfer">Transfer</option>
                </select>
              </div>
              <div class="form-group row">
                <label for="jumlah">Jumlah</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input value="{{old('jumlah')}}" name="jumlah" type="number" class="form-control" id="jumlah" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <input type="hidden" id="proses" name="proses" value="{{$total}}">
                   
                    <input type="hidden" id="lama" name="lama" value="{{$no}}">
                    <input type="hidden" id="pengeluaran_id" name="pengeluaran_id" value="{{ $setor->id }}">
                    <div class="input-group-append">
                      <span class="input-group-text">.00</span>
                    </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" class="form-control bg-light" id="keterangan" rows="3" placeholder="Eusian Keterangan ieu sesuai keterangan artos anu di bayarkeun" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{old('keterangan')}}</textarea>
              </div>
              <button type="submit" class="btn btn-success">Bayar</button>
          </div>
        </div>
        @endif
      </div>
      <!-- /.invoice -->
    </div><!-- /.col -->
  </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection
@section('script')
<script>
  $("#pengajuan").addClass("active");
  $("#likas").addClass("menu-open");
  $("#pemasukan").addClass("active");
</script>
@endsection