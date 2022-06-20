@extends('layouts.app')
@section('page', 'Keluarga Alm. MA HAYA')
@section('content')
<div class="card-body login-card-body">
  <p class="login-box-msg">Kasadayana anggota keluarga Alm. Ma Haya <br> Mangga lebet sesuai email anu tos di daftarkeun</p>

  <form action="{{ route('login') }}" method="post">
    @csrf
    <div class="input-group mb-3">
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('E-Mail') }}" name="email" value="{{ old('email') }}" autocomplete="off" autofocus>
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
      @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="input-group mb-3">
      <input id="password" type="password" placeholder="{{ __('Kata Sandi') }}" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" >
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
      @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="row mb-1">
      <div class="col-7">
        <div class="icheck-primary">
          <input type="checkbox" id="remember" class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} >
          <label for="remember">
            {{ __('Tetep Masuk') }}
          </label>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-5">
        <button type="submit" id="btn-login"class="btn btn-primary btn-block" >{{ __('Masuk') }} &nbsp; <i class="nav-icon fas fa-sign-in-alt"></i></button>
      </div>
      <!-- /.col -->
    </div>
  </form>

  <p class="mb-1">
      Pami Kata sandi na hilap, kontak ka sekertaris. 
  </p>
  <p class="mb-0">
    <a class="text-center" href="{{ route('register') }}">Buat Akun Baru</a>
  </p>
</div>
@endsection