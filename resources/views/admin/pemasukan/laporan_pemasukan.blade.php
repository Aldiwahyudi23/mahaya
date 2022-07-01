@extends('template_backend.home')
@section('heading')
Pengajuan
@endsection
@section('page')
<li class="breadcrumb-item active"><a href="">Anggota</a></li>
<li class="breadcrumb-item active"></li>
@endsection
@section('content')
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
                                - Data ieu atos di konfirmasi ku bendahara <br>
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
                                        <td>{{ $data->pembayaran}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Tanggal di Konfirmasi</th>
                                        <td>{{ $data->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Nama Anggota</th>
                                        <td>{{ $data->anggota->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Penginputan</th>
                                        <td>{{ $data->tanggal}}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Uang</th>
                                        <td>{{ $data->jumlah}}</td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan</th>
                                        <td>{{ $data->keterangan}}</td>
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