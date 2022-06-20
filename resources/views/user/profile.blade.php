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
            <div class="row" name="role" value="{{ Auth::user()->role }}">
              <input type="hidden">
              <div class="col-md-6">
                  <div class="form-group">
                      <label for="name">Nama</label>
                      <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" class="form-control @error('name') is-invalid @enderror">
                  </div>
                  <div class="form-group">
                      <label for="jk">Jenis Kelamin</label>
                      <select id="jk" name="jk" class="select2bs4 form-control @error('jk') is-invalid @enderror">
                          <option value="">-- Pilih Jenis Kelamin --</option>
                          <option value="L"
                              @if (Auth::user()->Profile(Auth::user()->id)->jk == 'L')
                                  selected
                              @endif
                          >Laki-Laki</option>
                          <option value="P"
                              @if (Auth::user()->Profile(Auth::user()->id)->jk == 'P')
                                  selected
                              @endif
                          >Perempuan</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="tmp_lahir">Tempat Lahir</label>
                      <input type="text" id="tmp_lahir" name="tmp_lahir" value="{{ Auth::user()->name }}" class="form-control @error('tmp_lahir') is-invalid @enderror">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label for="telp">Nomor Telpon/HP</label>
                      <input type="text" id="telp" name="telp" value="{{ Auth::user()->phone_number }}" onkeypress="return inputAngka(event)" class="form-control @error('telp') is-invalid @enderror">
                  </div>
                  <div class="form-group">
                      <label for="tgl_lahir">Tanggal Lahir</label>
                      <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ Auth::user()->name }}" class="form-control @error('tgl_lahir') is-invalid @enderror">
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