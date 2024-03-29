@extends('../master.master')

@section('title', 'Detail Data')

@section('sidebar')
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
@endsection

@section('profil')
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        @if (Auth::user()->foto == null)
            <img src="{{URL('./dist/img/user.png')}}" class="user-image img-circle elevation-2" alt="User Image">
        @else
            <img src="{{URL('./photo/' . Auth::user()->foto)}}"class="user-image img-circle elevation-2" alt="User Image">
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
            <a href="/profil10" class="btn btn-dark">Profil</a>
            <a href="/logout10" class="btn btn-danger float-right">Logout</a>
        </li>
    </ul>
@endsection

@section('content-header', 'Sistem Profil')

@section('content')
    @if (Session::has('success_message'))
        <div class="modal fade" id="success-message">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            <i class="fas fa-check text-info"></i>&nbsp;
                            {{ session('success_message') }}
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card card-outline card-info">
                <div class="card-header border-transparent">
                    <div class="card-title"><h3>Detail Data</h3></div>
                    <div class="card-tools">
                        @if ($data['foto'] == null)
                            <img src="{{URL('./dist/img/user.png')}}" class="img-circle elevation-2" alt="User Image" width="50" height="50">
                        @else
                            <img src="{{URL('./photo/' . $data['foto'])}}" class="img-circle elevation-2" alt="User Image" width="50" height="50">
                        @endif
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" value="{{$data['name']}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" value="{{$data['email']}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" value="{{$data['tempat_lahir']}}" disabled>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="text" class="form-control" value="{{date('j F Y', strtotime($data['tanggal_lahir']))}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="umur">Umur</label>
                                        <input type="text" class="form-control" value="{{$data['umur']}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="agama">Agama</label>
                                <input type="text" class="form-control" value="{{$data['agama']}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>&nbsp;
                                @if ($data['status'] == 1)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-secondary">NonAktif</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea class="form-control" rows="4" disabled>{{$data['alamat']}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="foto-ktp">Foto KTP</label><br>
                                <img src="{{URL('./photo/' . $data['ktp'])}}" class="img rounded" alt="Foto KTP" width="243" height="153">
                            </div>
                        </div>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    @if (Session::has('success_message'))
        <script>
            $(document).ready(function(){
                $("#success-message").modal();
            }); 
        </script>
    @endif
    <script>
        function showDelete(par) {
            document.getElementById("id2").value = par;
            $("#modal-default").modal();
        }
    </script>
@endsection
