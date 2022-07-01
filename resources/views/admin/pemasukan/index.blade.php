@extends('template_backend.home')

@section('heading', 'Pemasukan')
@section('page')
  <li class="breadcrumb-item active">Pemasukan</li>
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
@if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Bendahara')
<div class="alert alert-info alert-dismissible fade show col-md-12" role="alert">
    <b><i class="fas fa-info"></i> INFO !!!</b> <br>
      form ieu di input pami anggota alim nginput di web anjenna. Maka bendahara kedah ngesian form di handap sesuai pembayaran uang kas anu di bayarkeun.
      <br> <b>Pembayaran</b> Pilih metode pembayaran nu bade di lakukeun
      <br> <b>Anggota</b> Pilih anggota anu bayar
      <br> <b>tanggal</b> sesuai tanggal pembayaran
      <br> <b>keterangan</b>, esian sesuai kondisi pembayaran  !!!
      <br> <b>Contoh :</b> Uang di titipkeun ka Angga. <br>
      <br> Kanggo Bendahara Ngisi pembayaran uang kas pribadi tina halaman ieu, kantun milih nami Rifki A F

      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
</div>
@else
<div class="alert alert-info alert-dismissible fade show col-md-12" role="alert">
    <b><i class="fas fa-info"></i> INFO !!!</b> <br>
      Mangga eusian form di handap sesuai pembayaran uang kas anu di bayarkeun.
      <br> <b>Pembayaran</b> Pilih metode pembayaran nu bade di lakukeun
      <br> <b>tanggal</b> sesuai tanggal pembayaran
      <br> <b>keterangan</b>, esian sesuai kondisi pembayaran  !!!
      <br> <b>Contoh :</b> Uang di titipkeun ka Angga.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
</div>
@endif
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        <h4><i class="nav-icon fas fa-credit-card my-1 btn-sm-1"></i> Bayar Kas</h4>
        <hr>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-light p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active btn-sm" href="#ang" data-toggle="tab"> BAYAR KAS </a></li>
                                    @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Bendahara' || Auth::user()->role == 'Sekertaris' )
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#to" data-toggle="tab"> SETOR TUNAI</a></li>
                                    @endif
                                
                                </ul>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="tab-content">
                                    <!-- Awal Tabel Bayar -->
                                    <div class="tab-pane" id="to">
                                    <div class="row">
                                            <div class="row table-responsive">
                                            <h6 class="card-header bg-light p-3"><i class="fas fa-credit-card"></i> SETOR TUNAI</h6>
                                                    <div class="card-body">
                                                        <form action="/Pemasukan/setor_tunai/tambah" method="POST" enctype="multipart/form-data">
                                                            {{csrf_field()}}
     
                                                        
                                                            <div class="form-group row">
                                                                <label for="jumlah">Jumlah</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Rp.</span>
                                                                    </div>
                                                                    <input name="anggota_id" type="hidden" id="anggota_id">
                                                                    <input value="{{old('jumlah')}}" name="jumlah" type="number" class="form-control" id="jumlah" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="keterangan">Keterangan</label>
                                                                <textarea name="keterangan" class="form-control bg-light" id="keterangan" rows="3" placeholder="Eusian Keterangan ieu sesuai keterangan artos anu di bayarkeun" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{old('keterangan')}}</textarea>
                                                            </div>
                                                            <hr>
                                                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SETOR</button>
                                                        </form>
                                                    </div>
                                            </div>
                                    </div>
                                        
                                    </div>
                                    <!-- Akhir toggel 1 -->
                                    <!-- Awal table setor -->
                                    <div class="active tab-pane" id="ang">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Bendahara')
                                                
                                                        <h6 class="card-header bg-light p-3"><i class="fas fa-credit-card"></i> TAMBAH SETOR KAS</h6>
                                                        <div class="card-body table-responsive">
                                                            <form action="/Pemasukan/setor/tambah" method="POST" enctype="multipart/form-data">
                                                                {{csrf_field()}}
                                                                <div class="form-group row">
                                                                    <label for="pembayaran">Pembayaran</label>
                                                                    <select name="pembayaran" id="pembayaran" class="form-control select2bs4" required>
                                                                        <option value="Cash">Uang Tunai</option>
                                                                        <option value="Transfer">Transfer</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="anggota_id">Anggota</label>
                                                                    <select name="anggota_id" id="anggota_id" class="form-control select2bs4" required>
                                                                        <option value="">-- Pilih Anggota --</option>
                                                                        @foreach($data_anggota as $anggota)
                                                                        <option value="{{$anggota->id}}">{{$anggota->name}}</option>
                                                                        @endforeach
                                                                    </select>
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
                                                                    <textarea name="keterangan" class="form-control bg-light" id="keterangan" rows="3" placeholder="Eusian Keterangan ieu sesuai keterangan artos anu di bayarkeun" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{old('keterangan')}}</textarea>
                                                                </div>
                                                                <hr>
                                                                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPEN</button>
                                                            </form>
                                                        
                                                    
                                                </div>
                                              
                                            @else
                                                    <h6 class="card-header bg-light p-3"><i class="fas fa-credit-card"></i> TAMBAH SETOR KAS</h6>
                                                    <div class="card-body">
                                                        <form action="/Pemasukan/setor/anggota/tambah" method="POST" enctype="multipart/form-data">
                                                            {{csrf_field()}}
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
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="keterangan">Keterangan</label>
                                                                <textarea name="keterangan" class="form-control bg-light" id="keterangan" rows="3" placeholder="Eusian Keterangan ieu sesuai keterangan artos anu di bayarkeun" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{old('keterangan')}}</textarea>
                                                            </div>
                                                            <hr>
                                                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> BAYAR</button>
                                                        </form>
                                                    </div>
                                            @endif
                                            </div>
                                        </div>

                                    </div>
                                    <!--  -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        
                            <div class="card-body">
                            <p>
                                    Uang kas anu atos di input bakal lebet kana data di handap pami atos di konfirmasi ku bendahara sesuai keterangan anu tos di input.
                                </p> <br>
                                <p>
                                    Data kas anu di handap, sesuai data anu atos di bayar. makana di harapkeun di cek setiap saat, bilih aya data anu hente sesuai sareng pemasukan arurang.
                                </p> <br>

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
                                    @if (Auth::user()->role == 'Ketua' || Auth::user()->role == 'Bendahara' || Auth::user()->role == 'Sekertaris' )
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#set" data-toggle="tab"> Pemasukan</a></li>
                                    @endif
                                    <li class="nav-item"><a class="nav-link active btn-sm" href="#semua" data-toggle="tab"> Semua Pemasukan</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#anggota" data-toggle="tab">Anggota</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- Awal data pemasukan -->
                                    <div class="active tab-pane" id="semua">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>Nama</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>
                                                                <th>Keterangan</th>
                                                          
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @php
                                                                $total = 0;
                                                            @endphp
                                                            @foreach($data_semua as $setor)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>{{$setor->anggota->name}}</td>
                                                                <td>{{$setor->tanggal}}</td>
                                                                <td>{{ "Rp " . number_format($setor->jumlah,2,',','.') }}</td>
                                                                <td>{{$setor->keterangan}}</td>
                                                              
                                                                @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Sekertaris')
                                                                <td>
                                                                    <a href="/Pemasukan/setor/{{$setor->id}}/edit/" class=""><i class="nav-icon fas fa-pencil-alt"></i></a> 
                                                                </td>
                                                                @endif
                                                                @if (Auth()->user()->role == 'Admin')
                                                                <td>
                                                                    <a href="/Pemasukan/setor/{{$setor->id}}/hapus" class="" onclick="return confirm('Leres bade ngahapus data anu namina {{$setor->anggota->name}} tanggal {{$setor->tanggal}}  ?')"><i class="nav-icon fas fa-trash"></i></a>
                                                                </td>
                                                                @endif
                                                            </tr>
                                                            @php
                                                            $total += $setor->jumlah;
                                                            @endphp
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                        <tr>
                                                            <th colspan="3" class="text-center"><b>Total</b></th>
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
                                    <div class="tab-pane" id="set">
                                    <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>
                                                                <th>Keterangan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            $no = 0; 
                                                            ?>
                                                            @php
                                                                $total = 0;
                                                            @endphp
                                                            @foreach($data_setor as $setor)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>{{$setor->tanggal}}</td>
                                                                <td>{{ "Rp " . number_format($setor->jumlah,2,',','.') }}</td>
                                                                <td>{{$setor->keterangan}}</td>
                                                            </tr>
                                                        
                                                            @php
                                                            $total += $setor->jumlah;
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
                                    <!-- awal data anggota -->
                                    <div class="tab-pane" id="anggota">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaKeluar'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>Nama</th>
                                                                <th>Saldo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($data_anggota as $anggota)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>{{$anggota->name}}</td>
                                                                <?php
                                                                $id = $anggota->id;
                                                                $total_setor = DB::table('pemasukan')->where('pemasukan.anggota_id', '=', $id)
                                                                    ->sum('pemasukan.jumlah');
                                                                $total_tarik = DB::table('pengeluaran')->where('pengeluaran.anggota_id', '=', $id)
                                                                    ->sum('pengeluaran.jumlah');
                                                                    $jumlah = $total_setor-$total_tarik;
                                                                ?>
                                                                <td>{{ "Rp " . number_format( $jumlah,2,',','.') }}</td>
                                                            </tr>
                                                            @php
                                                            $total += $jumlah;
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
                                </div>
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div><!-- /.container-fluid -->
        </section>
    </div>
</section>

@endsection
@section('script')
    <script>
        $("#Pemasukan").addClass("active");
    </script>
@endsection