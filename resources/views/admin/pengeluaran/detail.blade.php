@extends('template_backend.home')
@section('heading')
  Pengeluaran
@endsection
@section('page')
  <li class="breadcrumb-item active"><a href="/pengeluaran/tarik">Pengeluaran</a></li>
  <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- Main content -->
        <div class="invoice p-3 mb-3">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fas fa-credit-card"></i> Detail Data {{$tarik->anggaran->nama}}
              </h4>
            </div>
          </div>
          <!-- info row -->
          <div class="row">
            <!-- accepted payments column -->
            <div class="col-12">
              <p class="lead">Catatan :</p>
              <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                - Tolong perhatikeun deui kana data nu di handap <br>
                - Pami aya kejanggalan mangga diskusikeun
              </p>
              
            </div>
            <!-- /.col -->
            <div class="col-12">
              <p class="lead">Rekap data Pengluaran :</p>
              
              <div class="table-responsive">
                <table class="table">

                  <tr>
                    <th>Tanggal Penginputan</th>
                    <td>{{ $tarik->tanggal}}</td>
                  </tr>
                  <tr>
                    <th>Jumlah Uang</th>
                    <td>{{ $tarik->jumlah}}</td>
                  </tr>
                  <tr>
                    <th>Keterangan</th>
                    <td>{{ $tarik->keterangan}}</td>
                  </tr>
                </table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
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
