<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta charset="UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Kas Keluarga</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar-daygrid/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar-timegrid/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar-bootstrap/main.min.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="shrotcut icon" href="{{ asset('img/logo.jpg') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <style>
        .ctr {
            text-align: center !important;
        }

        thead>tr>th,
        tbody>tr>td {
            vertical-align: middle !important;
        }

        td>input.form-control {
            width: 60px !important;
            padding: 8px !important;
            box-shadow: none !important;
        }

        input[name=predikat] {
            align-items: center;
            width: 60px !important;
            background: #fff !important;
            box-shadow: none !important;
        }

        input[disabled],
        input[disabled]:hover {
            cursor: default !important;
            border: none !important;
        }

        .textarea-rapot {
            font-size: 11px !important;
            background: #fff !important;
            border: none !important;
            font-size: 11px !important;
            cursor: default !important;
        }

        @media (min-width: 768px) {
            .img-details {
                margin-left: 40px;
            }

            .btn-details {
                margin-top: 28px !important;
            }

            .btn-details-siswa {
                margin-top: 175px !important;
            }
        }
    </style>
</head>
@if (Auth::user()->pengumuman_id == 1)
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info" style="min-height: 385px;">
                    <div class="card-header">
                        <h3 class="card-title" style="color: white;">
                            UNDANGAN
                        </h3>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="tab-content p-0">
                            <!-- isi pengumuman -->
                            {!! $pengumuman->isi !!}
                        </div>
                    </div>

                    <h6 class="card-header bg-light p-3"><i></i> KONFIRMASI KEHADIRAN</h6>
                    <div class="card-body">
                        <form action="/kehadiran/acara/tahunan/keluaraga-ma-haya" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="kehadiran">Kehadiran</label>
                                <select name="kehadiran" id="kehadiran" class="form-control select2bs4 @error('kehadiran') is-invalid @enderror">
                                    @if (old('kehadiran') == true) )
                                    <option value="{{old('kehadiran')}}">{{old('kehadiran')}}</option>
                                    @endif
                                    <option value="">-- Pilih Kehadiran --</option>
                                    <option value=" Hadir">Hadir</option>
                                    <option value="Tidak">Tidak Bisa Hadir</option>

                                </select>
                                @error('kehadiran')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="siapa">Siapa Yang akan hadir atau yang tidak bisa hadir</label>
                                <textarea name="siapa" class="form-control bg-light @error('siapa') is-invalid @enderror" id=" siapa" rows="3" placeholder="Contoh : kanggo anu tos berumah tangga ( Abi sareng caroge insya allah hadir, nagramekeun acara) pami kanggo anu lajang (Abdi siap hadir sareng orang tua)" oninput="setCustomValidity('')">{{old('siapa')}}</textarea>
                                @error('siapa')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <input type="hidden" class="form-control bg-light @error('kedah') is-invalid @enderror" id=" kedah" name="kedah" value="haha">
                            @error('kedah')
                            <div class="invalid-feedback">
                                <center> <strong>{{ $message }}</strong></center>
                            </div>
                            @enderror
                            <h6 class="card-header bg-warning p-3"><i></i> Kanggo anu teu tiasa hadir mangga esian alesan sareng tanggapan nu dihandap <br><br>
                                kanggo daging domba anu tos di sepakati bade di pencit.
                                <br>Sesuai Kesepakatan basa musyawarah anu teu tiasa hadir kudu di bahanan.
                                <br> Ningal kondisi anu seer teu tiasa ngiringan acara. Sareng pami sadayana di pasihan atawa di bahanan, daging moal picukupen kanggo nu marakan sareng nu di bahanan.
                                <br><br> Gaduh pertanyaan kanggo anu teu tiasa ngirirngan
                                <br> <br> Nyuhunkeun Tanggapanana kanggo anu teu tiasa hadir, Apakah daging bade di bahananan ningal kondisi daging sakedik , atawa bade legowo ?
                            </h6>
                            <div class="form-group row">
                                <label for="alasan">Alasan teu tiasa hadir</label>
                                <textarea value="{{old('alasan')}}" name="alasan" type="text" class="form-control bg-light @error('alasan') is-invalid @enderror" id=" alasan" rows="3" placeholder="Esian alasan sesuai kondisi naha teu tiasa hadir, sing lengkap tur detail supados teu aya kecurigaan anu lain lain "></textarea>
                                @error('alasan')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row"><label for="tanggapan">Tanggapan</label>
                                <textarea value="{{old('tanggapan')}}" name="tanggapan" type="text" class="form-control bg-light @error('tanggapan') is-invalid @enderror" id=" tanggapan" rows="4" placeholder="Kumaha tanggapan salira, tina acara ieu da dingan acara ieu teh sederhana. kahoyong keluarga mah kedah ngariung sasarengan supados ngaraosan kana ieu daharen."></textarea>
                                @error('tanggapan')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>

                            <hr>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-send"></i> kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- end of class row -->
    </div><!-- /.container-fluid -->
</section>

@else
<!-- sidebar-collapse -->

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        @include('template_backend.navbar')

        @include('template_backend.sidebar')

        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div> <!-- end of class row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <br>
        <br>
        <!-- /.content-wrapper -->

        @include('template_backend.footer')

        @endif