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
                      <label for="user_id">Nama</label>
                      <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                      <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" class="form-control @error('name') is-invalid @enderror">
                  </div>
                  <div class="form-group">
                      <label for="jk">Jenis Kelamin</label>
                      <select id="jk" name="jk" class="select2bs4 form-control @error('jk') is-invalid @enderror">
                          <option value="">-- Pilih Jenis Kelamin --</option>
                          <option value="L"> Laki</option>
                          <option value="M"> Laki</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="tmp_lahir">Tempat Lahir</label>
                      <input type="text" id="tmp_lahir" name="tmp_lahir" value="{{ Auth::user()->name }}" class="form-control @error('tmp_lahir') is-invalid @enderror">
                  </div>
                  <div class="form-group">
                      <label for="tgl_lahir">Tanggal Lahir</label>
                      <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ Auth::user()->name }}" class="form-control @error('tgl_lahir') is-invalid @enderror">
                  </div>
                  <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <input type="text" id="alamat" name="alamat" value="{{ Auth::user()->name }}" class="form-control @error('tgl_lahir') is-invalid @enderror">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label for="no_hp">Nomor Telpon/HP</label>
                      <input type="text" id="no_hp" name="no_hp" value="{{ Auth::user()->no_hp }}" onkeypress="return inputAngka(event)" class="form-control @error('telp') is-invalid @enderror">
                  </div>
                  <div class="form-group">
                      <label for="pekerjaan">Pekerjaan</label>
                      <input type="text" id="pekerjaan" name="pekerjaan" value="{{ Auth::user()->name }}" class="form-control @error('tgl_lahir') is-invalid @enderror">
                  </div>
                  <div class="form-group">
                      <label for="status">Status</label>
                      <select id="status" name="status" class="select2bs4 form-control @error('status') is-invalid @enderror">
                          <option value="">-- Pilih Jenis Kelamin --</option>
                          <option value="L"> Menikah</option>
                          <option value="M"> Belum Menikah</option>
                      </select>
                  </div>
                  <div class="form-group">
                                                        <label for="account-company">Foto Profile</label>
                                                        <input type="file" class="form-control" name="foto" id="foto"  />
                                                        <span class="text-danger" style="font-size: 10px">Kosongkan jika tidak ingin mengubah.</span>
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