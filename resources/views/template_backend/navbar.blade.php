<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #0f4c81;">
<!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="brand-link" style="color: #fff;" data-widget="pushmenu" href="#">
                <img src="{{ asset('img/logo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <div class="btn-group" role="group">
                <a id="btnGroupDrop1" style="color: #fff; margin-right: 40px;" type="button" class="" >
                    <i class="nav-icon fas fa-user-circle"></i> &nbsp; {{ Auth::user()->name }}
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
