@extends('template_backend.home')
@section('heading')
  Pengajuan
@endsection
@section('page')
  <li class="breadcrumb-item active"><a href="">Anggota</a></li>
  <li class="breadcrumb-item active"></li>
@endsection
@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="callout callout-success alert alert-success alert-dismissible fade show">
          <h5><i class="fas fa-info"></i> Informasi :</h5>
          - Uang kas teu acan lebet kana data ! <br>
          - Halaman ieu kanggo ningal detail data bayar, sareng ngakonfirmasi. Mangga klik tombol <b>Tarima</b> anu aya di handap halaman ! <br>
          - Konfirmasi data ieu sesuai keterangan !
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <!-- Main content -->
        <div class="invoice p-3 mb-3">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fas fa-credit-card"></i> Detail Data Pembayaran
              </h4>
            </div>
          </div>
          <!-- info row -->
          <div class="row">
            <!-- accepted payments column -->
            <div class="col-12">
              <p class="lead">Catatan :</p>
              <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                - Mohon konfirmasi heula sateuacan di tarima <br>
                - Konfirmasi sesuai keterangan, pami di titipkeun. punten chat anu ka titipanna
              </p>
              
            </div>
            <!-- /.col -->
            <div class="col-12">
              <p class="lead">Rekap data pemabyaran :</p>
              
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Metode Pembayaran</th>
                    <td>{{ $setor->pembayaran}}</td>
                  </tr>
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
                    <td>{{ $setor->jumlah}}</td>
                  </tr>
                  <tr>
                    <th>Keterangan</th>
                    <td>{{ $setor->keterangan}}</td>
                  </tr>
                </table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-12">
            <form action="/pengajuan/setor/anggota/tambah" method="post">
            @csrf
            <input type="hidden" id="id_pengajuan" name="id_pengajuan" value = "{{ $setor->id }}">
            <input type="hidden" id="anggota_id" name="anggota_id" value = "{{ $setor->anggota_id }}">
            <input type="hidden" id="jumlah" name="jumlah" value =" {{ $setor->jumlah }}">
            <input type="hidden" id="keterangan" name="keterangan" value = "{{ $setor->keterangan }}">
            <input type="hidden" id="tanggal" name="tanggal" value = "{{ $setor->tanggal }}">
            <input type="hidden" id="pembayaran" name="pembayaran" value = "{{ $setor->pembayaran }}">
        
            <button type="submit" class="btn btn-success" onclick="return confirm('Yakin bade terima ? Leres parantos ngakonfirmasi sesuai keterangan {{$setor->keterangan}} anu namina {{$setor->anggota->name}} jumlahna {{ "Rp " . number_format($setor->jumlah,2,',','.') }}  ?')">Tarima</button>
            </div>
          </div>
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
