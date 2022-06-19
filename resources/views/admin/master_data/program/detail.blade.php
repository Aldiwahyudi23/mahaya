@extends('template_backend.home')

@section('heading', 'Program')
@section('page')
  <li class="breadcrumb-item active">Program</li>
@endsection

@section('content')

<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        <h4><i class="nav-icon fas fa-credit-card my-1 btn-sm-1"></i> Data Program</h4>
        <hr>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        
                            <div class="card-body">
                            <table class="table" style="margin-top: -10px;">
                                <tr>
                                    <td>Program</td>
                                    <td>:</td>
                                    <td>{{$program->nama_program}}</td>
                                </tr>
                                <tr>
                                    <td>Ketua</td>
                                    <td>:</td>
                                    <td>{{ $program->pengurus->nama_pengurus }}</td>
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
                                        @if ($bulan > 6)
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
                                    <li class="nav-item"><a class="nav-link active btn-sm" href="#setor" data-toggle="tab"><i ></i> Deskripsi</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#anggota" data-toggle="tab"><i ></i> Keterangan</a></li>
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
                                                        <p> {{$program->deskripsi}}</p>
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