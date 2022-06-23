@extends('template_backend.home')
@section('heading', 'Profile')
@section('page')
  <li class="breadcrumb-item active">User Profile</li>
@endsection
@section('content')
<div class="col-12">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <a href=""  data-footer='<input type="file" class="form-control" name="foto_profile"  /><i class="nav-icon fas fa-file-upload"></i> &nbsp; Ubah Foto</a>'>
                            <img src="{{ asset('img/male.jpg') }}" width="130px" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                        </a>
                    </div>
                    <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                    <!-- <p class="text-muted text-center">{{ Auth::user()->role }}</p> -->
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>No INduk</b> <a class="float-right">{{ Auth::user()->id }}</a>
                            </li>
                        </ul>
                    <a href="/pengaturan/profile" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
<div class="col-12">
    <div class="row">
        <div class="col-6 table-responsive">
            <!-- About Me Box -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Profil</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="far fa-envelope mr-1"></i> Email</strong>
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                    <hr>

                        <strong><i class="fas fa-home mr-1"></i>Program</strong>
                        <p class="text-muted"></p>
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Tempat Lahir</strong>
                        <p class="text-muted"></p>
                        <hr>
                        <strong><i class="far fa-calendar mr-1"></i> Tanggal Lahir</strong>
                        <p class="text-muted"></p>
                        <hr>
                        <strong><i class="fas fa-phone mr-1"></i> No Telepon</strong>
                        <p class="text-muted">{{ Auth::user()->no_hp }}</p>
                
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-6 table-responsive">
            <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Pengaturan Akun</h3>
                        </div>
                        <div class="card-body">
                            <table class="table" style="margin-top: -21px;">
                            <tr>
                                <td width="50"><i class="nav-icon fas fa-envelope"></i></td>
                                <td> <a href="{{ route('pengaturan.email') }}">Ubah Email<a></td>
                            </tr>
                            <tr>
                                <td width="50"><i class="nav-icon fas fa-key"></i></td>
                                <td><a href="{{ route('pengaturan.password') }}">Ubah Password</a></td>
                            </tr>
                            </table>
                        </div>
                    </div>
            </div>
    </div>
</div>
@endsection
