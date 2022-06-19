@extends('template_backend.home')
@section('heading', 'Edit Profile')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('profile') }}">Pengaturan</a></li>
  <li class="breadcrumb-item active">Edit Profile</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title text-capitalize">Edit Profile {{ Auth::user()->name }}</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('pengaturan.ubah-profile') }}" method="post">
        @csrf
        <div class="card-body table-responsive">
            <div class="row" name="role" value="{{ Auth::user()->siswa(Auth::user()->no_induk)->role }}">
              <input type="hidden">
              <div class="col-md-6">
                  <div class="form-group">
                      <label for="no_induk">Nomor Induk</label>
                      <input type="text" id="no_induk" name="no_induk" value="{{ Auth::user()->siswa(Auth::user()->no_induk)->no_induk }}" class="form-control" disabled>
                  </div>
                  <div class="form-group">
                      <label for="name">Nama Siswa</label>
                      <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" class="form-control @error('name') is-invalid @enderror">
                  </div>
                  <div class="form-group">
                      <label for="jk">Jenis Kelamin</label>
                      <select id="jk" name="jk" class="select2bs4 form-control @error('jk') is-invalid @enderror">
                          <option value="">-- Pilih Jenis Kelamin --</option>
                          <option value="L"
                              @if (Auth::user()->siswa(Auth::user()->no_induk)->jk == 'L')
                                  selected
                              @endif
                          >Laki-Laki</option>
                          <option value="P"
                              @if (Auth::user()->siswa(Auth::user()->no_induk)->jk == 'P')
                                  selected
                              @endif
                          >Perempuan</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="tmp_lahir">Tempat Lahir</label>
                      <input type="text" id="tmp_lahir" name="tmp_lahir" value="{{ Auth::user()->siswa(Auth::user()->no_induk)->tmp_lahir }}" class="form-control @error('tmp_lahir') is-invalid @enderror">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label for="kelas_id">Kelas</label>
                      <select id="kelas_id" name="kelas_id" class="select2bs4 form-control @error('kelas_id') is-invalid @enderror">
                          <option value="">-- Pilih Kelas --</option>
                          @foreach ($kelas as $data)
                              <option value="{{ $data->id }}"
                                  @if (Auth::user()->siswa(Auth::user()->no_induk)->kelas_id == $data->id)
                                      selected
                                  @endif
                              >{{ $data->nama_kelas }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="telp">Nomor Telpon/HP</label>
                      <input type="text" id="telp" name="telp" value="{{ Auth::user()->siswa(Auth::user()->no_induk)->telp }}" onkeypress="return inputAngka(event)" class="form-control @error('telp') is-invalid @enderror">
                  </div>
                  <div class="form-group">
                      <label for="tgl_lahir">Tanggal Lahir</label>
                      <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ Auth::user()->siswa(Auth::user()->no_induk)->tgl_lahir }}" class="form-control @error('tgl_lahir') is-invalid @enderror">
                  </div>
              </div>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <a href="#" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
          <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#back').click(function() {
            window.location="{{ route('profile') }}";
        });
    });
</script>
@endsection