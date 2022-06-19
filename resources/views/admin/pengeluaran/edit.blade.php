@extends('template_backend.home')

@section('heading', 'pengeluaran')
@section('page')
  <li class="breadcrumb-item active">Pengeluaran</li>
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
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        <h4><i class="nav-icon fas fa-credit-card my-1 btn-sm-1"></i> Penarikan Kas</h4>
        <hr>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <h6 class="card-header bg-light p-3"><i class="fas fa-credit-card"></i> TAMBAH TARIK KAS</h6>
                            <div class="card-body">
                                <form action="/pengeluaran/tarik/{{$tarik->id}}/update" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group row">
                                        <label for="anggaran_id">Anggaran</label>
                                        <select name="anggaran_id" id="anggaran_id" class="form-control select2bs4" >
                                            <option value="{{$tarik->anggaran->id}}">{{$tarik->anggaran->nama}}</option>
                                            @foreach($data_anggaran as $anggaran)
                                            <option value="{{$anggaran->id}}">{{$anggaran->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group row" id="noId">
                                        
                                    </div>
                                    <div class="form-group row">
                                        <label for="tanggal">Tanggal Penarikan</label>
                                        <input value="{{$tarik->tanggal}}" name="tanggal" type="date" class="form-control bg-light" id="tanggal" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                    </div>
                                    <div class="form-group row">
                                        <label for="jumlah">Jumlah</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input value="{{$tarik->jumlah}}" name="jumlah" type="number" class="form-control" id="jumlah" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea name="keterangan" class="form-control bg-light" id="keterangan" rows="3" placeholder="Eusian Keterangan ieu sesuai keterangan artos anu di tarik" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{$tarik->keterangan}}</textarea>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPEN</button>
                                    <a class="btn btn-danger btn-sm" href="{{route('pengeluaran.tarik')}}" role="button"><i class="fas fa-undo"></i>BATAL</a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header bg-light p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active btn-sm" href="#setor" data-toggle="tab"><i class="fas fa-credit-card"></i> Data Penarikan</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#darura" data-toggle="tab"><i class="fas fa-child"></i> Data Darurat</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#ama" data-toggle="tab"><i class="fas fa-child"></i> Data Amal</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#pinja" data-toggle="tab"><i class="fas fa-child"></i> Data Pinjam</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#usah" data-toggle="tab"><i class="fas fa-child"></i> Data Usaha</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#acar" data-toggle="tab"><i class="fas fa-child"></i> Data Acara</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#lai" data-toggle="tab"><i class="fas fa-child"></i> Data Lain-Lain</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- seluruh data penarikan -->
                                    <div class="active tab-pane" id="setor">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>No. Trans</th>
                                                                <th>Anggaran</th>
                                                                <th>Nama</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>
                                                                <th>Keterangan</th>
                                                                
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($data_tarik as $tarik)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>ST0{{$tarik->id}}</td>
                                                                <td>{{$tarik->anggaran->nama}}</td>
                                                                <td>{{$tarik->anggota->name}}</td>
                                                                <td>{{$tarik->tanggal}}</td>
                                                                <td>{{ "Rp " . number_format($tarik->jumlah,2,',','.') }}</td>
                                                                <td>{{$tarik->keterangan}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Akhir togle data penarikan -->


                                    <!-- awal data darurat -->
                                    <div class="tab-pane" id="darura">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>No. Trans</th>
                                                                <th>Anggaran</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>
                                                                <th>Keterangan</th>
                                                                
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($dana_darurat as $tarik)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>ST0{{$tarik->id}}</td>
                                                                <td>{{$tarik->anggaran->nama}}</td>
                                                                <td>{{$tarik->tanggal}}</td>
                                                                <td>{{ "Rp " . number_format($tarik->jumlah,2,',','.') }}</td>
                                                                <td>{{$tarik->keterangan}}</td>
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/cetakprint" target="_blank" class=""><i class="nav-icon fas fa-print"></i></a>
                                                                </td>
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/edit/" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                                                </td>
                                                                <td>
                                                                    @if (auth()->user()->role == 'Admin')
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/hapus" class="" onclick="return confirm('Leres bade ngahapus data anu namina {{$tarik->anggota->name}} tanggal {{$tarik->tanggal}}  ?')"><i class="nav-icon fas fa-trash"></i></a>
                                                                    @endif
                                                                </td>
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
                                                                <th>No. Trans</th>
                                                                <th>Anggaran</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>
                                                                <th>Keterangan</th>
                                                                
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($dana_amal as $tarik)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>ST0{{$tarik->id}}</td>
                                                                <td>{{$tarik->anggaran->nama}}</td>
                                                                <td>{{$tarik->tanggal}}</td>
                                                                <td>{{ "Rp " . number_format($tarik->jumlah,2,',','.') }}</td>
                                                                <td>{{$tarik->keterangan}}</td>
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/cetakprint" target="_blank" class=""><i class="nav-icon fas fa-print"></i></a>
                                                                </td>
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/edit/" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                                                </td>
                                                                <td>
                                                                    @if (auth()->user()->role == 'Admin')
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/hapus" class="" onclick="return confirm('Leres bade ngahapus data anu namina {{$tarik->anggota->name}} tanggal {{$tarik->tanggal}}  ?')"><i class="nav-icon fas fa-trash"></i></a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                      <!-- awal data pinjam -->
                                      <div class="tab-pane" id="pinja">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                <table class="table table-hover table-head-fixed" id='tabelAgendaAmal'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>No. Trans</th>
                                                                <th>Nama Peminjam</th>
                                                                <th>Anggaran</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>
                                                                <th>Keterangan</th>
                                                                
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($dana_pinjam as $tarik)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>ST0{{$tarik->id}}</td>
                                                                <td>{{$tarik->anggota->name}}</td>
                                                                <td>{{$tarik->anggaran->nama}}</td>
                                                                <td>{{$tarik->tanggal}}</td>
                                                                <td>{{ "Rp " . number_format($tarik->jumlah,2,',','.') }}</td>
                                                                <td>{{$tarik->keterangan}}</td>
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/cetakprint" target="_blank" class=""><i class="nav-icon fas fa-print"></i></a>
                                                                </td>
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/edit/" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                                                </td>
                                                                <td>
                                                                    @if (auth()->user()->role == 'Admin')
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/hapus" class="" onclick="return confirm('Leres bade ngahapus data anu namina {{$tarik->anggota->name}} tanggal {{$tarik->tanggal}}  ?')"><i class="nav-icon fas fa-trash"></i></a>
                                                                    @endif
                                                                </td>
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
                                                                <th>No. Trans</th>
                                                                <th>Anggaran</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>
                                                                <th>Keterangan</th>
                                                                
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($dana_usaha as $tarik)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>ST0{{$tarik->id}}</td>
                                                                <td>{{$tarik->anggaran->nama}}</td>
                                                                <td>{{$tarik->tanggal}}</td>
                                                                <td>{{ "Rp " . number_format($tarik->jumlah,2,',','.') }}</td>
                                                                <td>{{$tarik->keterangan}}</td>
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/cetakprint" target="_blank" class=""><i class="nav-icon fas fa-print"></i></a>
                                                                </td>
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/edit/" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                                                </td>
                                                                <td>
                                                                    @if (auth()->user()->role == 'Admin')
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/hapus" class="" onclick="return confirm('Leres bade ngahapus data anu namina {{$tarik->anggota->name}} tanggal {{$tarik->tanggal}}  ?')"><i class="nav-icon fas fa-trash"></i></a>
                                                                    @endif
                                                                </td>
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
                                                                <th>No. Trans</th>
                                                                <th>Anggaran</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>
                                                                <th>Keterangan</th>
                                                                
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($dana_acara as $tarik)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>ST0{{$tarik->id}}</td>
                                                                <td>{{$tarik->anggaran->nama}}</td>
                                                                <td>{{$tarik->tanggal}}</td>
                                                                <td>{{ "Rp " . number_format($tarik->jumlah,2,',','.') }}</td>
                                                                <td>{{$tarik->keterangan}}</td>
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/cetakprint" target="_blank" class=""><i class="nav-icon fas fa-print"></i></a>
                                                                </td>
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/edit/" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                                                </td>
                                                                <td>
                                                                    @if (auth()->user()->role == 'Admin')
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/hapus" class="" onclick="return confirm('Leres bade ngahapus data anu namina {{$tarik->anggota->name}} tanggal {{$tarik->tanggal}}  ?')"><i class="nav-icon fas fa-trash"></i></a>
                                                                    @endif
                                                                </td>
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
                                                                <th>No. Trans</th>
                                                                <th>Anggaran</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>
                                                                <th>Keterangan</th>
                                                                
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($dana_lain as $tarik)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>ST0{{$tarik->id}}</td>
                                                                <td>{{$tarik->anggaran->nama}}</td>
                                                                <td>{{$tarik->tanggal}}</td>
                                                                <td>{{ "Rp " . number_format($tarik->jumlah,2,',','.') }}</td>
                                                                <td>{{$tarik->keterangan}}</td>
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/cetakprint" target="_blank" class=""><i class="nav-icon fas fa-print"></i></a>
                                                                </td>
                                                                <td>
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/edit/" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                                                </td>
                                                                <td>
                                                                    @if (auth()->user()->role == 'Admin')
                                                                    <a href="/pengeluaran/tarik/{{$tarik->id}}/hapus" class="" onclick="return confirm('Leres bade ngahapus data anu namina {{$tarik->anggota->name}} tanggal {{$tarik->tanggal}}  ?')"><i class="nav-icon fas fa-trash"></i></a>
                                                                    @endif
                                                                </td>
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
            $(document).ready(function(){
        $('#anggaran_id').change(function(){
            var kel = $('#anggaran_id option:selected').val();
            if (kel == "3") {
              $("#noId").html(' <label for="anggota_id">Anggota</label> <select name="anggota_id" id="anggota_id" class="form-control select2bs4" required> <option value="{{$tarik->anggota->id}}">{{$tarik->anggota->name}}</option> @foreach($data_anggota as $anggota) <option value="{{$anggota->id}}">{{$anggota->name}}</option> @endforeach </select>');
            } else if(kel == "Siswa") {
              $("#noId").html(`<label for="nomer">Nomer Induk Siswa</label><input id="nomer" type="text" placeholder="No Induk Siswa" class="form-control" name="nomer" autocomplete="off">`);
            } else if(kel == "Admin" || kel == "Operator") {
              $("#noId").html(`<label for="name">Username</label><input id="name" type="text" placeholder="Username" class="form-control" name="name" autocomplete="off">`);
            } else {
              $("#noId").html(' <input type="hidden" name="anggota_id" value="0">')
            }
        });
    });
        $("#Pemasukan").addClass("active");
    </script>
@endsection