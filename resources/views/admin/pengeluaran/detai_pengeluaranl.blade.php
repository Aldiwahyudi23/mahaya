@extends('template_backend.home')

@section('content')

<div class="alert alert-info alert-dismissible fade show col-12" role="alert">
    <b><i class="fas fa-info"></i> INFORMASI !!!</b> <br>
      Data nu di handap, data sadaya pengeluaran.
      <br> 
      Kanggo ninggal antar anggaran mangga ketik wae nama anggaranna tina kolom <b>Search</b>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
</div>
<section class="content card col-md-12" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        <h4><i class="nav-icon fas fa-credit-card my-1 btn-sm-1"></i> Pengajuan Bayar Kas</h4>
        <hr>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Nama Anggaran</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengeluaran_detail as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->tanggal }}</td>
                                        <td>{{ $data->anggaran->nama_anggaran }}</td>
                                        <td>{{ $data->jumlah }}</td>
                                        <td>{{ $data->keterangan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                </div><!-- /.container-fluid -->
        </section>
    </div>
</section>
@endsection

