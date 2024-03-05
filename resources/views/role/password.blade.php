@extends('../master.master')

@section('title', 'Ubah Password')

@section('sidebar-content')
    @if (Auth::user()->role == 'Admin')
        <li class="nav-item">
            <a href="/" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/agama10" class="nav-link">
                <i class="nav-icon fas fa-pray"></i>
                <p>Agama</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/status10" class="nav-link">
                <i class="nav-icon fas fa-user-check"></i>
                <p>Status User</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/admindetail10" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Detail User</p>
            </a>
        </li>
    @else
        <li class="nav-item">
            <a href="/" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/detail10" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>Detail Data</p>
            </a>
        </li>
    @endif
@endsection

@section('profil')
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        @if (Auth::user()->foto == null)
            <img src="{{URL('./dist/img/user.png')}}" class="user-image img-circle elevation-2" alt="User Image">
        @else
            <img src="{{URL('./photo/' . Auth::user()->photo)}}"class="user-image img-circle elevation-2" alt="User Image">
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-dark">
            @if (Auth::user()->foto == null)
                <img src="{{URL('./dist/img/user.png')}}" class="img-circle elevation-2" alt="User Image">
            @else
                <img src="{{URL('./photo/' . Auth::user()->foto)}}" class="img-circle elevation-2" alt="User Image">
            @endif
            <p>
                {{(Auth::user()->name)}}
                <small>{{Auth::user()->role}}</small>
            </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <a href="/profil0" class="btn btn-dark">Profil</a>
            <a href="/logout10" class="btn btn-danger float-right">Logout</a>
        </li>
    </ul>
@endsection

@section('content-header', 'Sistem Profil')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary d-flex flex-fill">
                <div class="card-header">
                    <h3 class="card-title">Ubah Password</h3>
                </div>
                <div class="card-body">
                    <form action="/password10" method="post" id="inputForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="form-group">
                                <label for="pass_baru">Password Baru</label>
                                <input type="password" id="pass_baru" name="pass_baru" class="form-control" placeholder="Password Baru" value="{{old('pass_baru')}}" required>
                                @error('pass_baru')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pass_confirm">Konfirmasi Password</label>
                                <input type="password" id="pass_confirm" name="pass_confirm" class="form-control" placeholder="Konfirmasi Password Baru" value="{{old('pass_confirm')}}" required>
                                @error('pass_confirm')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="/profil10" class="btn btn-secondary">Batal</a>
                                <input type="submit" name="submit" value="Edit" class="btn btn-success float-right">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
