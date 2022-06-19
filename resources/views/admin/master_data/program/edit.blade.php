@extends('template_backend.home')

@section('heading', 'Program')
@section('page')
  <li class="breadcrumb-item active">Program</li>
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
        <h4><i class="nav-icon fas fa-credit-card my-1 btn-sm-1"></i> Data Program</h4>
        <hr>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <h6 class="card-header bg-light p-3"><i class="fas fa-credit-card"></i> EDIT DATA PROGRAM</h6>
                            <div class="card-body">
                                <form action="/program/{{$program->id}}/update" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group row">
                                        <label for="program_id">Pengurus</label>
                                        <select name="pengurus_id" id="pengurus_id" class="form-control select2bs4" required>
                                            <option value="{{$program->pengurus->id}}">{{$program->pengurus->nama_pengurus}}</option>
                                            @foreach($data_pengurus as $pengurus)
                                            <option value="{{$pengurus->id}}">{{$pengurus->nama_pengurus}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama_program">Program</label>
                                        <input value="{{$program->nama_program}}" name="nama_program" type="text" class="form-control bg-light" id="nama_program" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                    </div>
                               
                                    <div class="form-group row">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control bg-light" id="deskripsi" rows="3" placeholder="Eusian deskripsi ieu sesuai deskripsi program anu tos di sepakati " required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{$program->deskripsi}}</textarea>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPEN</button>
                                    <a class="btn btn-danger btn-sm" href="{{route('program')}}" role="button"><i class="fas fa-undo"></i>BATAL</a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header bg-light p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active btn-sm" href="#setor" data-toggle="tab"><i class="fas fa-credit-card"></i> Data Program</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#anggota" data-toggle="tab"><i class="fas fa-child"></i> Deskripsi</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- Awal data pemasukan -->
                                    <div class="active tab-pane" id="setor">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>Program</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($data_program as $program)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>{{$program->nama_program}}</td>
                                                                <td>
                                                                    <a href="/program/{{$program->id}}/detail"  class=""><i class="nav-icon fas fa-book"></i></a>
                                                                </td>
                                                                <td>
                                                                    <a href="/program/{{$program->id}}/edit/" class=""><i class="nav-icon fas fa-pencil-alt"></i></a> 
                                                                </td>
                                                                <td>
                                                                    @if (auth()->user()->role == 'Admin')
                                                                    <a href="/program/{{$program->id}}/hapus" class="" onclick="return confirm('Leres bade ngahapus data anu namina {{$program->nama_program}}  ?')"><i class="nav-icon fas fa-trash"></i></a>
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
                                    <!-- Akhir togle data pemasukan -->

                                    <!-- awal data anggota -->
                                    <div class="tab-pane" id="anggota">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaKeluar'>
                                                      
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