@extends('template_backend.home')

@section('heading', 'Anggaran')
@section('page')
  <li class="breadcrumb-item active">Anggaran</li>
@endsection

@section('content')

<section class="content card col-12" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        <h4><i class="nav-icon fas fa-credit-card my-1 btn-sm-1"></i> Data Anggaran</h4>
        <hr>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
           
                            <div class="card-body">
                            <table class="table" style="margin-top: -10px;">
                                <tr>
                                    <td>Anggaran</td>
                                    <td>:</td>
                                    <td>{{$anggaran->nama_anggaran}}</td>
                                </tr>
                                <tr>
                                    <td>Program</td>
                                    <td>:</td>
                                    <td>{{ $anggaran->program->nama_program }}</td>
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
                            <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                                                        <p> {!! $anggaran->deskripsi !!}</p>
                                                    </table>
                            
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