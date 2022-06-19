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
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <b><i class="fas fa-info"></i> INFO !!!</b> <br>
      - Mangga input peminjaman di handap sesuai kebutuhan <br>
      - hasil input masih tina pengajuan, kantun nagntosan konfirmasi <br>
      <b> Alasan : </b><br>
      Pami ngesian alasan, kedah detail sareng lengkap tur jelas <br>
      <br>
      Sateacan nginput kedah paham heula kana syarat & ketentuanna <br>
      <b> Supados jelas mangga klik deskripsi di handap</b>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
</div>
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        <h4><i class="nav-icon fas fa-credit-card my-1 btn-sm-1"></i> Pinjam Uang Kas</h4>
        <hr>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
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
                                    </div>
                                    <div class="form-group row">
                                        <label for="keterangan">Alasan</label>
                                        <textarea name="keterangan" class="form-control bg-light" id="keterangan" rows="3" placeholder=" Alasan ieu esian sesuai alasan minjem dana pinjam" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{old('keterangan')}}</textarea>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> PINJAM</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        
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
                    <div class="col-md-9">
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
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>
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
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
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

                    <div class="col-md-9">
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
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#darura" data-toggle="tab"><i class=""></i> Data Darurat</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#ama" data-toggle="tab"><i class=""></i> Data Amal</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#usah" data-toggle="tab"><i class=""></i> Data Usaha</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#acar" data-toggle="tab"><i class=""></i> Data Acara</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#lai" data-toggle="tab"><i class=""></i> Data Lain-Lain</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
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