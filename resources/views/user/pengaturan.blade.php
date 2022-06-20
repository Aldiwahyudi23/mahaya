@extends('template_backend.home')
@section('heading', 'Profile')
@section('page')
  <li class="breadcrumb-item active">User Profile</li>
@endsection
@section('content')
<div class="col-12">
    <div class="row">
        <div class="col-5">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                    @if (Auth::user()->role)
                        <a href="" data-toggle="lightbox" data-title="Foto {{ Auth::user()->name }}" data-gallery="gallery" data-footer='<a href="" id="linkFotoGuru" class="btn btn-link btn-block btn-light"><i class="nav-icon fas fa-file-upload"></i> &nbsp; Ubah Foto</a>'>
                            <img src="" width="130px" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                        </a>
                    @else
                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/male.jpg') }}" alt="User profile picture">
                    @endif
                    </div>
                    <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                    <!-- <p class="text-muted text-center">{{ Auth::user()->role }}</p> -->
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>No INduk</b> <a class="float-right">{{ Auth::user()->id }}</a>
                            </li>
                        </ul>
                    <a href="{{ route('pengaturan.profile') }}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        
        <div class="col-7">
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
                        <p class="text-muted">{{ Auth::user()->phone_number }}</p>
                
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
    <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Pengaturan Akun</h3>
                </div>
                <div class="card-body">
                    <table class="table" style="margin-top: -21px;">
                    <tr>
                        <td width="50"><i class="nav-icon fas fa-envelope"></i></td>
                        <td>Ubah Email</td>
                        <td width="50"><a href="{{ route('pengaturan.email') }}" class="btn btn-default btn-sm">Edit</a></td>
                    </tr>
                    <tr>
                        <td width="50"><i class="nav-icon fas fa-key"></i></td>
                        <td>Ubah Password</td>
                        <td width="50"><a href="{{ route('pengaturan.password') }}" class="btn btn-default btn-sm">Edit</a></td>
                    </tr>
                    </table>
                </div>
            </div>
    </div>
</div>
@endsection